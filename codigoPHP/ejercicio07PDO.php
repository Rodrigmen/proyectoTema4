<!DOCTYPE html>
<html>
    <head>
        <title>ejercicio07PDO - DWES</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/jpg" href="../webroot/css/images/favicon.jpg" /> 
        <style>
            body{
                background-color: #A9C6FF;
            }

        </style>

    </head>
    <body>
        <?php
        /**
         * Página web que toma datos (código y descripción) de un fichero xml y los añade a la tabla 
         * Departamento de nuestra base de datos. (IMPORTAR) [PDO]
         * 
         * @version 1.0.0
         * @since 03-11-2020
         * @author Rodrigo Robles <rodrigo.robmin@educa.jcyl.es>
         */
        require_once '../config/confDBPDOOne.php';
        try {
            $oConexionPDO = new PDO(DSN, USER, PASSWORD, CHARSET); //creo el objeto PDO con las constantes iniciadas en el archivo confDBPDO.php
            $oConexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //le damos este atributo a la conexión (la configuramos) para poder utilizar las excepciones


            $nombreArchivo = "../tmp/departamentos.xml";
            $doc_XML = new DOMDocument;
            $carga_archivo = $doc_XML->load($nombreArchivo);

            echo '<h2>Importación de la copia de seguridad guardada en el servidor (departamentos.xml)</h2>';
            if ($carga_archivo) {
                
                $oConexionPDO->beginTransaction(); //empezamos la transacción
                //PASO PREVIO: BORRAR LA TABLA DEPARTAMENTOS (esto para que se realice siempre la importación)
                $consultaBorrarDepartamento = "DROP TABLE IF EXISTS Departamento";
                $borrarDepartamento = $oConexionPDO->prepare($consultaBorrarDepartamento);
                $borrarDepartamento->execute();
                $borrarDepartamento->closeCursor();

                
                $consultaCrearTabla = "CREATE TABLE IF NOT EXISTS Departamento (
                                                CodDepartamento CHAR(3) PRIMARY KEY,
                                                DescDepartamento VARCHAR(255) NOT NULL,
                                                VolumenNegocio FLOAT NOT NULL,
                                                FechaBaja DATE 
                                            )  ENGINE=INNODB;";
                $crearTabla = $oConexionPDO->prepare($consultaCrearTabla);
                $crearTabla->execute(); //creamos la tabla de la copia de seguridad
                $crearTabla->closeCursor();

                //Sacamos todos los elementos del documento que contienen datos de cada departamento
                $codigos = $doc_XML->getElementsByTagName("CodDepartamento");
                $ncodigos = $codigos->length;
                $descripciones = $doc_XML->getElementsByTagName("DescDepartamento");
                $volumenes = $doc_XML->getElementsByTagName("VolumenNegocio");
                $fechas = $doc_XML->getElementsByTagName("FechaBaja");

                $consultaInsertar = "INSERT INTO Departamento VALUES (:codigo, :descripcion, :volumen, :fecha)";
                $insertarDepartamento = $oConexionPDO->prepare($consultaInsertar);
                for ($i = 0; $i < $ncodigos; $i++) { //recorremos los elementos
                    //Sacamos el valor 
                    $codigo = $codigos->item($i);
                    $valorCodigo = $codigo->nodeValue;

                    $descripcion = $descripciones->item($i);
                    $valorDescripcion = $descripcion->nodeValue;

                    $volumen = $volumenes->item($i);
                    $valorVolumen = $volumen->nodeValue;

                    $fecha = $fechas->item($i);
                    $valorFecha = $fecha->nodeValue;
                    if (empty($valorFecha)) { //si no tiene fecha de baja, su valor es null (esto es necesario para la correcta importación)
                        $valorFecha = null;
                    } else {
                        $valorFecha = $fecha->nodeValue;
                    }

                    $insertarDepartamento->bindParam('codigo', $valorCodigo);
                    $insertarDepartamento->bindParam(':descripcion', $valorDescripcion);
                    $insertarDepartamento->bindParam(':volumen', $valorVolumen);
                    $insertarDepartamento->bindParam(':fecha', $valorFecha);

                    $insertarDepartamento->execute(); //insertamos los valores a su respectiva posición en la tabla
                }
                $insertarDepartamento->closeCursor();

                $oConexionPDO->commit(); //se ejecuta la transacción
                echo '<a href="ejercicio02PDO.php">¡Comprobar importación!</a>'; //link para comprobar la importación
            } else {
                exit('Error abriendo departamentos.xml.');
            }
        } catch (PDOException $excepcionPDO) {
            $oConexionPDO->rollBack();
            echo "<p style='color:red;'>Mensaje de error: " . $excepcionPDO->getMessage() . "</p>"; //Muestra el mesaje de error
            echo "<p style='color:red;'>Código de error: " . $excepcionPDO->getCode() . "</p>"; // Muestra el codigo del error
        } finally {
            unset($oConexionPDO); //destruimos el objeto
        }
        ?>

    </body>

</html>       

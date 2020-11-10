<!DOCTYPE html>
<html>
    <head>
        <title>ejercicio07PDOCSV - DWES</title>
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
         * Página web que toma datos (código y descripción) de un fichero json y los añade a la tabla 
         * Departamento de nuestra base de datos. (IMPORTAR) [PDO]
         * 
         * @version 1.0.0
         * @since 10-11-2020
         * @author Rodrigo Robles <rodrigo.robmin@educa.jcyl.es>
         */
        require_once '../config/confDBPDO.php';
        try {
            $oConexionPDO = new PDO(DSN, USER, PASSWORD, CHARSET); //creo el objeto PDO con las constantes iniciadas en el archivo confDBPDO.php
            $oConexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //le damos este atributo a la conexión (la configuramos) para poder utilizar las excepciones


            $nombreArchivo = "../tmp/departamentosCSV.csv";
            $doc_CSV = fopen($nombreArchivo, "r");
            if ($doc_CSV) {


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



                $consultaInsertar = "INSERT INTO Departamento VALUES (:codigo, :descripcion, :volumen, :fecha)";
                $insertarDepartamento = $oConexionPDO->prepare($consultaInsertar);
                while ($datos = fgetcsv($doc_CSV)) {
                    $insertarDepartamento->bindParam('codigo', $datos[0]);
                    $insertarDepartamento->bindParam(':descripcion', $datos[1]);
                    $insertarDepartamento->bindParam(':volumen', $datos[2]);
                    if (empty($datos[3])) {
                        $datos[3] = null;
                    }
                    $insertarDepartamento->bindParam(':fecha', $datos[3]);

                    $insertarDepartamento->execute();
                }
                fclose($doc_CSV);
                $insertarDepartamento->closeCursor();

                $oConexionPDO->commit(); //se ejecuta la transacción
                echo '<a href="ejercicio02PDO.php">¡Comprobar importación de CSV!</a>';
            } else {
                exit('Error abriendo departamentosCSV.csv');
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

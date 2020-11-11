<!DOCTYPE html>
<html>
    <head>
        <title>ejercicio08PDOJSON - DWES</title>
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
         *  Página web que toma datos (código y descripción) de la tabla Departamento y guarda en un fichero departamento.json. 
         * (COPIA DE SEGURIDAD / EXPORTAR). El fichero exportado se encuentra en el directorio .../tmp/ del servidor [PDO]
         * @version 1.0.0
         * @since 09-11-2020
         * @author Rodrigo Robles <rodrigo.robmin@educa.jcyl.es>
         */
        require_once '../config/confDBPDOOne.php';


        try {
            $oConexionPDO = new PDO(DSN, USER, PASSWORD, CHARSET); //creo el objeto PDO con las constantes iniciadas en el archivo confDBPDO.php
            $oConexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //le damos este atributo a la conexión (la configuramos) para poder utilizar las excepciones
            //Sacamos las tablas de la base de datos
            $consultaMostrarTablas = "SHOW TABLES";
            $sacarTablas = $oConexionPDO->prepare($consultaMostrarTablas);
            $sacarTablas->execute();

            $aDatos = [];
            $archivoJSON = fopen('../tmp/departamentosJSON.json', 'w');
            $contador = 0; //este contador nos ayudara a numerar los diferentes departamentos
            while ($tabla = $sacarTablas->fetch()) { //se recorren todas las tablas
                $consultarTablas = "SELECT * FROM " . $tabla[$contador]; //sacamos todos los registros de la tabla
                $sacarDatosTablas = $oConexionPDO->prepare($consultarTablas);
                $sacarDatosTablas->execute();

                while ($registroTabla = $sacarDatosTablas->fetch(PDO::FETCH_ASSOC)) { //recorremos cada registro
                    $oJsonRegistro = json_encode($registroTabla, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                    array_push($aDatos, $registroTabla);
                }

                $contador++;
            }
            $aJSON = json_encode($aDatos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            fwrite($archivoJSON, $aJSON);
            $sacarTablas->closeCursor();


            if (fclose($archivoJSON)) {
                echo "<h2>Exportación completa</h2>";
                echo '<a href="../tmp/departamentosJSON.json">¡Comprobar JSON!</a><br>';

                if (isset($_POST['descargar'])) {
                    $fichero = '../tmp/departamentosJSON.json';
                    if (file_exists($fichero)) {
                        header('Content-Type: application/octet-stream');
                        header('Content-Disposition: attachment; filename="' . basename($fichero) . '"');
                        header('Content-Length: ' . filesize($fichero));
                        readfile($fichero);
                        exit;
                    } else {
                        echo "<p style='color:red;'>Error al obtener el archivo JSON</p>"; //Muestra el mesaje de error
                    }
                } else {
                    ?>
                    <form name="buscar" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <input type="submit" name="descargar" value="Descargar" />
                    </form>
                    <?php
                }
            } else {
                echo "<p style='color:red;'>Error al guardar el archivo JSON</p>"; //Muestra el mesaje de error
            }
        } catch (PDOException $errorConexion) {
            echo "<p style='color:red;'>Mensaje de error: " . $excepcionPDO->getMessage() . "</p>"; //Muestra el mesaje de error
            echo "<p style='color:red;'>Código de error: " . $excepcionPDO->getCode() . "</p>"; // Muestra el codigo del error
        } finally {
            unset($oConexionPDO); //destruimos el objeto
        }
        ?>

    </body>

</html>    


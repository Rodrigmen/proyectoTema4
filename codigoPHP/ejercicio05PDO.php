<!DOCTYPE html>
<html>
    <head>
        <title>ejercicio05PDO - DWES</title>
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
         * Pagina web que añade tres registros a nuestra tabla Departamento utilizando tres instrucciones insert y una transacción, de tal forma que se añadan los tres registros o no se añada ninguno. [PDO]
         * 
         * @version 1.0.0
         * @since 26-11-2020
         * @author Rodrigo Robles <rodrigo.robmin@educa.jcyl.es>
         */
        require_once '../config/confDBPDO.php';

        try {
            $oConexionPDO = new PDO(DSN, USER, PASSWORD, CHARSET); //creo el objeto PDO con las constantes iniciadas en el archivo confDBPDO.php
            $oConexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //le damos este atributo a la conexión (la configuramos) para poder utilizar las excepciones
            $oConexionPDO->beginTransaction();
            //ARRAY ASOCIATIVO POR QUE SABEMOS LOS DATOS
            $aDepartamentos = [
                ["CodDepartamento" => "AAT",
                    "DescDepartamento" => "Departamento de Transaccion",
                    "VolumenNegocio" => 1],
                ["CodDepartamento" => "ABT",
                    "DescDepartamento" => "Departamento de Transaccion",
                    "VolumenNegocio" => 2],
                ["CodDepartamento" => "ACT",
                    "DescDepartamento" => "Departamento de Transaccion",
                    "VolumenNegocio" => 3]
            ];

            //Creación de la consulta preparada
            $consultaInsertar = "INSERT INTO Departamento (CodDepartamento, DescDepartamento, VolumenNegocio) VALUES (:codigo, :descripcion, :volumen)";

            //Preparación de la consulta preparada
            $insertarDepartamentos = $oConexionPDO->prepare($consultaInsertar);
            //Recorremos cada departamento mediante un foreach
            foreach ($aDepartamentos as $departamento) {
                $insertarDepartamentos->bindParam(':codigo', $departamento["CodDepartamento"]); //sacamos los respectivos valores de cada departamento y se los introducimos en la consulta
                $insertarDepartamentos->bindParam(':descripcion', $departamento["DescDepartamento"]);
                $insertarDepartamentos->bindParam(':volumen', $departamento["VolumenNegocio"]);
                $insertarDepartamentos->execute(); //ejecutamos la consulta de insercion por cada departamento en el array
            }

            $oConexionPDO->commit();
            echo "<h2>¡Se han incluido los 3 departamentos!</h2>"; //se notifica al usuario de la inserción de los tres departamentos
            echo '<a href="ejercicio04PDO.php">¡Comprobar en PDO (busca "transaccion")!</a>'; //se le muestra un enlace al usuario para ver todos los departamentos (ejercicio4)
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

<!DOCTYPE html>
<html>
    <head>
        <title>ejercicio05MYSQLi- DWES</title>
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
         * Mostrar el contenido de la tabla Departamento y el número de registros. [MYSQLi]
         * 
         * @version 1.0.0
         * @since 28-10-2020
         * @author Rodrigo Robles <rodrigo.robmin@educa.jcyl.es>
         */
        require_once '../config/confDBMYSQLi.php';
        $controlador = new mysqli_driver();
        $controlador->report_mode = MYSQLI_REPORT_STRICT; // funcion alias de mysqli_driver->report_mode. Habilita la funcion interna que lanza una mysqli_sql_exception para errors en lugar de advertencias

        try {
            @$oConexionMYSQLi = new mysqli(HOST, USER, PASSWORD, DB); //el @ para ignorar los warnings 
            $oConexionMYSQLi->set_charset("utf8");
            $oConexionMYSQLi->autocommit(false);
            $seleccionTodosDep = $oConexionMYSQLi->stmt_init();
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

            $insertarDepartamentos = $oConexionMYSQLi->stmt_init();
            //Creación de la consulta preparada
            $consultaInsertar = "INSERT INTO Departamento (CodDepartamento, DescDepartamento, VolumenNegocio) VALUES (?, ?, ?)";

            //Preparación de la consulta preparada
            $insertarDepartamentos->prepare($consultaInsertar);
            //Recorremos cada departamento mediante un foreach
            foreach ($aDepartamentos as $departamento) {
                $insertarDepartamentos->bind_param('ssi', $departamento["CodDepartamento"], $departamento["DescDepartamento"], $departamento["VolumenNegocio"]); //sacamos los respectivos valores de cada departamento y se los introducimos en la consulta
                $insertarDepartamentos->execute(); //ejecutamos la consulta de insercion por cada departamento en el array
            }
            $insertarDepartamentos->close();
            $oConexionMYSQLi->commit();
            echo "<h2>¡Se han incluido los 3 departamentos!</h2>"; //se notifica al usuario de la inserción de los tres departamentos
            echo '<a href="ejercicio04MYSQLi.php">¡Comprobar en MySQLi (busca "transaccion")!</a>'; //se le muestra un enlace al usuario para ver todos los departamentos (ejercicio4)
        } catch (mysqli_sql_exception $excepcionMySQLi) {
            $oConexionMYSQLi->rollback();
            echo "<p style='color:red;'>Mensaje de error: " . $excepcionMySQLi->getMessage() . "</p>"; //Muestra el mesaje de error
            echo "<p style='color:red;'>Código de error: " . $excepcionMySQLi->getCode() . "</p>"; // Muestra el codigo del error
            exit(); //Termina el script
        } finally {
            $oConexionMYSQLi->close(); //cerramos la conexión 
        }
        ?>

    </body>

</html>       

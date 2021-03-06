<!DOCTYPE html>
<html>
    <head>
        <title>ejercicio06MYSQLi- DWES</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/jpg" href="../webroot/css/images/favicon.jpg" /> 
        <style>
            body{
                background-color: #A9C6FF;
            }
            h3{
                margin-bottom: 100px;
            }
            table{
                margin: auto;
                padding: auto;
            }
            th{
                font-weight: bold;
            }
            td{
                padding: 15px;
                border-bottom: 3px solid black;
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
                ["CodDepartamento" => "OOA",
                    "DescDepartamento" => "Departamento Array",
                    "VolumenNegocio" => 1],
                ["CodDepartamento" => "OOB",
                    "DescDepartamento" => "Departamento Array",
                    "VolumenNegocio" => 2],
                ["CodDepartamento" => "OOC",
                    "DescDepartamento" => "Departamento Array",
                    "VolumenNegocio" => 3],
                ["CodDepartamento" => "OOD",
                    "DescDepartamento" => "Departamento Array",
                    "VolumenNegocio" => 4],
                ["CodDepartamento" => "OOE",
                    "DescDepartamento" => "Departamento Array",
                    "VolumenNegocio" => 5]
            ];

            $insertarDepartamentos = $oConexionMYSQLi->stmt_init();
            //Creación de la consulta preparada
            $consultaInsertar = "INSERT INTO Departamento (CodDepartamento, DescDepartamento, VolumenNegocio) VALUES (?, ?, ?)";

            $contadorExec = 0;
            //Preparación de la consulta preparada
            $insertarDepartamentos->prepare($consultaInsertar);

            //Recorremos cada departamento mediante un foreach
            foreach ($aDepartamentos as $departamento) {
                $insertarDepartamentos->bind_param('ssi', $departamento["CodDepartamento"], $departamento["DescDepartamento"], $departamento["VolumenNegocio"]); //sacamos los respectivos valores de cada departamento y se los introducimos en la consulta
                $insertarDepartamentos->execute(); //ejecutamos la consulta de insercion por cada departamento en el array
            }
            $insertarDepartamentos->close();

            $oConexionMYSQLi->commit();
            echo "<h2>¡Se ha incluido el array de 5 departamentos!</h2>"; //se notifica al usuario de la inserción de los tres departamentos
            echo '<a href="ejercicio04MYSQLi.php">¡Comprobar en MySQLi (busca "array")!</a>'; //se le muestra un enlace al usuario para ver todos los departamentos (ejercicio4)
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

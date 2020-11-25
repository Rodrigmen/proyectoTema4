<!DOCTYPE html>
<html>
    <head>
        <title>ejercicio02MYSQLi- DWES</title>
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
            echo "<h3>Contenido de la tabla 'Departamento' de la base de datos 'DAW218DBDepartamentos' <span style='color:yellow;'>[MYSQLi]</span></h3>";
            @$oConexionMYSQLi = new mysqli(HOST, USER, PASSWORD, DB); //el @ para ignorar los warnings 
            $oConexionMYSQLi->set_charset("utf8");

            $seleccionTodosDep = $oConexionMYSQLi->stmt_init();
            $consultaTodos = "SELECT * FROM Departamento ORDER BY CodDepartamento";
            $seleccionTodosDep->prepare($consultaTodos);
            $seleccionTodosDep->execute();
            $seleccionTodosDep->store_result(); //alamacenamos el resultado, con el objetivo de poder utilizar num_rows
            $seleccionTodosDep->bind_result($codigo, $descripcion, $volumen, $fecha); //obtenemos el resultado y lo metemos enn variables

            $numeroDepartamentos = $seleccionTodosDep->num_rows;
            if ($numeroDepartamentos !== 0) {
                echo "<table>"
                . "<tr>"
                . "<th>Código</th>"
                . "<th>Descripción</th>"
                . "<th>Volumen de negocio</th>"
                . "<th>Fecha de baja</th>"
                . "</tr>";
                while ($seleccionTodosDep->fetch()) {
                    echo "<tr>"
                    . "<td>$codigo</td>"
                    . "<td> $descripcion</td>"
                    . "<td> $volumen</td>"
                    . "<td> $fecha</td>"
                    . "</tr>";
                }
                echo "</table>";

                echo "<h4>Número de registros (departamentos): $numeroDepartamentos </h4>";
            } else {

                echo "<h4>¡No hay ningún departamento!</h4>";
            }
            $seleccionTodosDep->close();

            $seleccionTodosDep2 = $oConexionMYSQLi->query("SELECT * FROM Departamento ORDER BY CodDepartamento");

            $numeroDepartamentos2 = $seleccionTodosDep2->num_rows; //num_rows tiene el valor del número de registros(departamentos)
            if ($numeroDepartamentos2 !== 0) {
                //Creamos una tabla, en la cual va a aparecer la respuesta de la consulta (los departamentos)
                echo "<table>"
                . "<tr>"
                . "<th>Código</th>"
                . "<th>Descripción</th>"
                . "<th>Volumen de negocio</th>"
                . "<th>Fecha de baja</th>"
                . "</tr>";
                while ($departamento2 = $seleccionTodosDep2->fetch_object()) {
                    echo "<tr>"
                    . "<td>$departamento2->CodDepartamento</td>"
                    . "<td> $departamento2->DescDepartamento</td>"
                    . "<td> $departamento2->VolumenNegocio</td>"
                    . "<td> $departamento2->FechaBaja</td>"
                    . "</tr>";
                }

                echo "</table>";

                echo "<h4>Número de registros (departamentos): $numeroDepartamentos2 </h4>";
            } else {

                echo "<h4>¡No hay ningún departamento!</h4>";
            }
        } catch (mysqli_sql_exception $excepcionMySQLi) {
            echo "<p style='color:red;'>Mensaje de error: " . $excepcionMySQLi->getMessage() . "</p>"; //Muestra el mesaje de error
            echo "<p style='color:red;'>Código de error: " . $excepcionMySQLi->getCode() . "</p>"; // Muestra el codigo del error
            exit(); //Termina el script
        } finally {
            $oConexionMYSQLi->close(); //cerramos la conexión 
        }
        ?>

    </body>

</html>       

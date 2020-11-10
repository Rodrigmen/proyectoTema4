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
        require_once '../config/confDBMySQLiOne.php';
        mysqli_report(MYSQLI_REPORT_STRICT); // funcion alias de mysqli_driver->report_mode. Habilita la funcion interna que lanza una mysqli_sql_exception para errors en lugar de advertencias

        try {
            @$oConexionMYSQLi = new mysqli(HOST, USER, PASSWORD, DB); //el @ para ignorar los warnings 
            $oConexionMYSQLi->set_charset("utf8");


            //PASO PREVIO: COMPROBAMOS SI YA SE HA REALIZADO ESTA TRANSACCIÓN CON ANTERIORIDAD
            //comprobamos si existen los tres departamentos que vamos a incluir, si existen los borramos para posteriormente incluirlos de nuevo

            $aCodigos = ['AAT', 'ABT', 'ACT'];
            $seleccionTodosDep = $oConexionMYSQLi->stmt_init();
            $consultaTodos = "SELECT * FROM Departamento ORDER BY CodDepartamento";
            $seleccionTodosDep->prepare($consultaTodos);
            $seleccionTodosDep->execute();
            $seleccionTodosDep->store_result(); //alamacenamos el resultado, con el objetivo de poder utilizar num_rows
            $seleccionTodosDep->bind_result($codigo); //obtenemos el resultado y lo metemos enn variables

            $yaIncluidos = false; //variable booleana que indica que a priori es falso que se haya realizado previamente la transacción


            while ($seleccionTodosDep->fetch()) { //convertimos a objetos todos los departamentos
                foreach ($aCodigos as $codigo) {
                    if ($codigo === $codigo) { //si en la base de datos existe alguno de estos codigos
                        $yaIncluidos = true; //es que ya se realizo la transacción previamente
                    }
                }
            }
            $seleccionTodosDep->close();
            if ($yaIncluidos === true) {//si se realizo la transaccion previamente
                $borramosDepartamentos = $oConexionMYSQLi->stmt_init();
                $borramosDepartamentos->prepare('DELETE FROM Departamento WHERE CodDepartamento LIKE ?'); //se borran, dando paso a una nueva transacción
                foreach ($aCodigos as $codigo) {
                    $borramosDepartamentos->bind_param('s', $codigo);
                    $borramosDepartamentos->execute();
                }
            }
            $borramosDepartamentos->close();
            $aDepartamentos = [
                1 => ['AAT', 'Departamento de Transaccion', 1],
                2 => ['ABT', 'Departamento de Transaccion', 2],
                3 => ['ACT', 'Departamento de Transaccion', 3],
            ];

            $insertarDepartamentos = $oConexionMYSQLi->stmt_init();
            //Creación de la consulta preparada
            $consultaInsertar = "INSERT INTO Departamento (CodDepartamento, DescDepartamento, VolumenNegocio) VALUES (?, ?, ?)";

            $contadorExec = 0;
            //Preparación de la consulta preparada
            $insertarDepartamentos->prepare($consultaInsertar);

            foreach ($aDepartamentos as $departamento) {
                for ($i = 0; $i < count($departamento); $i++) {
                    $insertarDepartamentos->bind_param('ssi', $departamento[0], $departamento[1], $departamento[2]);
                }
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

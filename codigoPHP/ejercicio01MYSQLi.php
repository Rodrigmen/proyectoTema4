<!DOCTYPE html>
<html>
    <head>
        <title>ejercicio01MYSQLi- DWES</title>
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
         * Conexión a la base de datos con la cuenta usuario y tratamiento de errores. [MYSQLi]
         * 
         * @version 1.0.0
         * @since 27-10-2020
         * @author Rodrigo Robles <rodrigo.robmin@educa.jcyl.es>
         */
        require_once '../config/confDBMYSQLiOne.php';
        $controlador = new mysqli_driver();
        $controlador->report_mode = MYSQLI_REPORT_STRICT; // funcion alias de mysqli_driver->report_mode. Habilita la funcion interna que lanza una mysqli_sql_exception para errors en lugar de advertencias

        try {
            echo "<h1 style='color:green;'>ATRIBUTOS DE LA CONEXIÓN CON LA BASE DE DATOS DAW218DBDepartamentos mediante <span style='color:yellow;'>MYSQLi</span></h1>";
            @$oConexionMYSQLi = new mysqli(HOST, USER, PASSWORD, DB); //creamos la conexión a traves de las constantes definidas en confMYSQLi.php
            $oConexionMYSQLi->set_charset("utf8"); //Establecemos el conjunto de caracteres predeterminado del cliente

            echo 'SERVER_INFO: <span style="color:blue;">' . $oConexionMYSQLi->server_info . "</span> <br>" .
            'HOST_INFO: <span style="color:blue;">' . $oConexionMYSQLi->host_info . "</span><br>" .
            'CLIENT_INFO: <span style="color:blue;">' . $oConexionMYSQLi->client_info . "</span><br>" .
            'CLIENT_VERSION: <span style="color:blue;">' . $oConexionMYSQLi->client_version . "</span><br>" .
            'PROTOCOL_VERSION: <span style="color:blue;">' . $oConexionMYSQLi->protocol_version . "</span><br>" .
            'SEVER_VERSION: <span style="color:blue;">' . $oConexionMYSQLi->server_version . "</span><br>" .
            'THREAD_ID: <span style="color:blue;">' . $oConexionMYSQLi->thread_id . "</span><br>";
        } catch (mysqli_sql_exception $excepcionMySQLi) {
            echo "<p style='color:red;'>Código de error: " . $excepcionMySQLi->getCode() . "</p>"; // Muestra el codigo del error
            echo "<p style='color:red;'>Código de error: " . $excepcionMySQLi->getMessage() . "</p>"; //Muestra el mesaje de error
            exit(); //Termina el script
        } finally {
            $oConexionMYSQLi->close(); //cerramos la conexión 
        }

        try {
            echo "<h1 style='color:red;'>CONEXIÓN ERRÓNEA</h1>"; //Creamos una conexion erronea para mostrar al usuario el error que salta
            @$oConexionMYSQLim = new mysqli(HOST, USER, "NO ES LA CONTRASEÑA", DB); //el @ ignora el error en el servidor(no muestra warning a el usuario), esto para que solo muestres el error como quieras
            $oConexionMYSQLim->set_charset("utf8"); //Establecemos el conjunto de caracteres predeterminado del cliente
        } catch (mysqli_sql_exception $excepcionMySQLi) {
            echo "<p style='color:red;'>Mensaje de error: " . $excepcionMySQLi->getMessage() . "</p>"; //Muestra el mesaje de error
            echo "<p style='color:red;'>Código de error: " . $excepcionMySQLi->getCode() . "</p>"; // Muestra el codigo del error
            exit(); //Termina el script
        } finally {
            $oConexionMYSQLim->close(); //cerramos la conexión 
        }
        ?>

    </body>

</html>       

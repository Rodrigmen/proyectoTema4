<!DOCTYPE html>
<html>
    <head>
        <title>ejercicio01PDO - DWES</title>
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
         * Conexión a la base de datos con la cuenta usuario y tratamiento de errores. [PDO]
         * 
         * @version 1.0.0
         * @since 29-10-2020
         * @author Rodrigo Robles <rodrigo.robmin@educa.jcyl.es>
         */
        require_once '../config/confDBPDO.php';


        echo "<h1 style='color:green;'>ATRIBUTOS DE LA CONEXIÓN CON LA BASE DE DATOS DAW218DBDepartamentos mediante <span style='color:yellow;'>PDO</span></h1>";
        try {
            $oConexionPDO = new PDO(DSN, USER, PASSWORD, CHARSET); //creo el objeto PDO con las constantes iniciadas en el archivo confDBPDO.php
            $oConexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //le damos este atributo a la conexión (la configuramos) para poder utilizar las excepciones
            $aAtributos = ["AUTOCOMMIT", "ERRMODE", "CASE", "CLIENT_VERSION", "CONNECTION_STATUS",
                "ORACLE_NULLS", "SERVER_INFO", "SERVER_VERSION"]; //Mysql on version  "5.6.29" not support "PDO::ATTR_PREFETCH"  and "PDO::ATTR_TIMEOUT"
            //AUTOCOMMIT = Para confirmar automaticamente cada declaración
            //0=automático
            //1=no automático 
            //ERRMODE = Reporte de errores
            //0 (SILENT=no muetra errores a no ser que tu los establezcas)
            //1 (WARNING=muestra warnings)
            //2(EXCEPTION=lanza excepciones)
            //CASE = nombre de las columnas en una capitalizacion(mayus, minus...) especifica
            //0 (NATURAL=Deja los nombres de columnas como son devueltas por el driver de la base de datos)
            //1 (UPPER = Deja los nombres de las columnas en mayúsculas)
            //2 (LOWER = Deja los nombres de las columnas en minúsculas)
            //CLIENT_VERSION = Devuelve la versión clientes de MySQL como valor de tipo integer
            //CONNECTION_STATUS = Devuelve el campo de bits de status de conexión
            //ORACLE_NULLS = Conversión de NULL y cadenas vacías.
            //0 (NATURAL=Sin conversión.)
            //1 (NULL_EMPTY_STRING = Las cadenas vacías son convertidas a NULL.)
            //2 (NULL_TO_STRING = NULL se convierte a cadenas vacías)
            //SERVER_INFO = Obtiene información del servidor MySQL
            //SERVER_VERSION = Devuelve la versión del servidor MySQL

            foreach ($aAtributos as $atributo) { //recorremos el array de atributos y los mostramos uno a uno
                echo "PDO::ATTR_$atributo: "
                . '<span style="color:blue;">' . $oConexionPDO->getAttribute(constant("PDO::ATTR_$atributo")) . "</span><br>"; //los atributos son constantes, de ahi la necesidad de 'constant()'                   
            }
        } catch (PDOException $errorConexion) {
            echo "Mensaje de error: " . $errorConexion->getMessage();
            echo "<br>Código de error: " . $errorConexion->getCode();
        } finally {
            unset($oConexionPDO); //destruimos el objeto
        }


        echo "<h1 style='color:red;'>CONEXIÓN ERRÓNEA</h1>"; //Creamos una conexion erronea para mostrar al usuario al excepción que salta
        try {
            $oConexionPDOM = new PDO(DSN, USER, 'NO ES LA CONTRASEÑA ADECUADA', CHARSET);
            $oConexionPDOM->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $excepcionPDO) {
            echo "<p style='color:red;'>Mensaje de error: " . $excepcionPDO->getMessage() . "</p>"; //Muestra el mesaje de error
            echo "<p style='color:red;'>Código de error: " . $excepcionPDO->getCode() . "</p>"; // Muestra el codigo del error
        } finally { //al final, ya sea conexión correcta o error
            unset($oConexionPDOM);  //se cierra la conexión (se destruye el objeto)
        }
        ?>

    </body>

</html>       

<!DOCTYPE html>
<html>
    <head>
       <title>mostrarScripts - DWES</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <link rel="icon" type="image/jpg" href="../webroot/css/images/favicon.jpg" /> 
    </head>
    <body>
        <?php
            /**
             * Mostrar los scripts de la base de datos
             * 
             * @version 1.0.0
             * @since 14-10-2020
             * @author Rodrigo Robles <rodrigo.robmin@educa.jcyl.es>
             */
            
            echo '<h1>Servidores Propios - Configuraciones PDO</h1>'
            . '<h2>Entorno Desarrollo</h2>';
            $filename = "../config/confDBPDO.php";
            highlight_file($filename);
            echo '<h2>Entorno Explotación</h2>';
            $filename2 = "../config/confDBPDOExplotacion.php";
            highlight_file($filename2);
            echo '<h2>Entorno Local</h2>';
            $filename3 = "../config/confDBPDOCasa.php";
            highlight_file($filename3);
            
            echo '<h1>Servidores Propios - Configuraciones MySQLi</h1>'
            . '<h2>Entorno Desarrollo</h2>';
            $filenameM = "../config/confDBMYSQLi.php";
            highlight_file($filenameM);
            echo '<h2>Entorno Explotación</h2>';
            $filenameM2 = "../config/confDBMYSQLiExplotacion.php";
            highlight_file($filenameM2);
            echo '<h2>Entorno Local</h2>';
            $filenameM3 = "../config/confDBMYSQLiCasa.php";
            highlight_file($filenameM3);
            
            echo '<h1>Servidor 1&1</h1>'
            . '<h2>Configuración PDO</h2>';
            $filenameOnePDO = "../config/confDBPDOOne.php";
            highlight_file($filenameOnePDO);
            echo '<h2>Configuración MySQLi</h2>';
            $filenameOneM = "../config/confDBMYSQLiOne.php";
            highlight_file($filenameOneM);
            
            

        ?>
        
    </body>
    
</html>


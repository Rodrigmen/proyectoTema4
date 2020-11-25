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
            
            echo '<h1>Configuraciones PDO</h1>';
            $filename = "../config/confDBPDO.php";
            highlight_file($filename);

            echo '<h1>Configuraciones MySQLi</h1>';
            $filenameM = "../config/confDBMYSQLi.php";
            highlight_file($filenameM);

        ?>
        
    </body>
    
</html>


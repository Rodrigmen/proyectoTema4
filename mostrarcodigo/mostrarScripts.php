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
            
            echo '<h1>SCRIPT DE CREACIÓN</h1>';
            $filename = "../scriptDB/CreaDAW218DBDepartamentos.sql";
            highlight_file($filename);
            
            echo '<h1>SCRIPT DE CARGA INICIAL</h1>';
            $filename2 = "../scriptDB/CargaInicialDAW218DBDepartamentos.sql";
            highlight_file($filename2);
            
            echo '<h1>SCRIPT DE BORRADO</h1>';
            $filename3 = "../scriptDB/BorraDAW218DBDepartamentos.sql";
            highlight_file($filename3);
            
            echo '<h1>SCRIPT DE CREACIÓN - SERVIDORES 1&1</h1>';
            $filename4 = "../scriptDB/crear.sql";
            highlight_file($filename4);
            
            echo '<h1>SCRIPT DE CARGA INICIAL - SERVIDORES 1&1</h1>';
            $filename5 = "../scriptDB/cargar.sql";
            highlight_file($filename5);
            
            echo '<h1>SCRIPT DE BORRADO - SERVIDORES 1&1</h1>';
            $filename6 = "../scriptDB/borrar.sql";
            highlight_file($filename6);

        ?>
        
    </body>
    
</html>


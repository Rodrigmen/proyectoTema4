<!DOCTYPE html>
<html>
    <head>
        <title>cargaInicial - DWES</title>
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
         * Cargar unos datos inciales en la tabla Departamento [PDO]
         * 
         * @version 1.0.0
         * @since 03-11-2020
         * @author Rodrigo Robles <rodrigo.robmin@educa.jcyl.es>
         */
        require_once '../config/confDBPDO.php';


        try {
            $oConexionPDO = new PDO(DSN, USER, PASSWORD, CHARSET); //creo el objeto PDO con las constantes iniciadas en el archivo confDBPDO.php
            $oConexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //le damos este atributo a la conexión (la configuramos) para poder utilizar las excepciones
            
            
            $insertar = $oConexionPDO->query("INSERT INTO Departamento(CodDepartamento,DescDepartamento, VolumenNegocio, FechaBaja) VALUES
                ('VEN', 'Departamento de ventas', 1500, '2008-11-11'),
                ('CON', 'Departamento de contabilidad', 1700, '2008-11-13'),
                ('ELE', 'Departamento de electrónica', 2000, '2008-11-15'),
                ('TAA', 'Departamento de tarifas', 1500, null);");
            
            if($insertar){
                echo '<h2>Se ha insertado correctamente los datos en la tabla Departamento</h2>';
            }
        } catch (PDOException $errorConexion) {
            echo "Mensaje de error: " . $errorConexion->getMessage();
            echo "<br>Código de error: " . $errorConexion->getCode();
        } finally {
            unset($oConexionPDO); //destruimos el objeto
        }


        ?>

    </body>

</html>       

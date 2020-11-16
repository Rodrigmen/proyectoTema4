<!DOCTYPE html>
<html>
    <head>
        <title>ejercicio06PDO - DWES</title>
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
         * Pagina web que cargue registros en la tabla Departamento desde un array departamentosnuevos utilizando una consulta preparada[PDO]
         * 
         * @version 1.0.0
         * @since 31-10-2020
         * @author Rodrigo Robles <rodrigo.robmin@educa.jcyl.es>
         */
        require_once '../config/confDBPDO.php';


        try {
            $oConexionPDO = new PDO(DSN, USER, PASSWORD, CHARSET); //creo el objeto PDO con las constantes iniciadas en el archivo confDBPDO.php
            $oConexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //le damos este atributo a la conexión (la configuramos) para poder utilizar las excepciones
            $oConexionPDO->beginTransaction();
            $aDepartamentos = [
                1 => ['OOA', 'Departamento Array', 1],
                2 => ['OOB', 'Departamento Array', 2],
                3 => ['OOC', 'Departamento Array', 3],
                4 => ['OOD', 'Departamento Array', 4],
                5 => ['OOE', 'Departamento Array', 5],
            ];
            //Creación de la consulta preparada
            $consultaInsertar = "INSERT INTO Departamento (CodDepartamento, DescDepartamento, VolumenNegocio) VALUES (:codigo, :descripcion, :volumen)";

            //Preparación de la consulta preparada
            $insertarDepartamentos = $oConexionPDO->prepare($consultaInsertar);
            foreach ($aDepartamentos as $departamento) {
                for ($i = 0; $i < count($departamento); $i++) {
                    $insertarDepartamentos->bindParam(':codigo', $departamento[0]);
                    $insertarDepartamentos->bindParam(':descripcion', $departamento[1]);
                    $insertarDepartamentos->bindParam(':volumen', $departamento[2]);
                }
                $insertarDepartamentos->execute();
            }

            $insertarDepartamentos->closeCursor();
            $oConexionPDO->commit();
            echo "<h2>¡Se ha incluido el array de 5 departamentos!</h2>"; //se notifica al usuario de la inserción de los tres departamentos
            echo '<a href="ejercicio04PDO.php">¡Comprobar en PDO (busca "array")!</a>'; //se le muestra un enlace al usuario para ver todos los departamentos (ejercicio4)
        } catch (PDOException $errorConexion) {
            $oConexionPDO->rollBack();
            echo "Mensaje de error: " . $errorConexion->getMessage();
            echo "<br>Código de error: " . $errorConexion->getCode();
        } finally {
            
            unset($oConexionPDO); //destruimos el objeto
        }
        ?>

    </body>

</html>       

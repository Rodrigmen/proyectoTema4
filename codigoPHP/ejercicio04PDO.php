<!DOCTYPE html>
<html>
    <head>
        <title>ejercicio04PDO - DWES</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/jpg" href="../webroot/css/images/favicon.jpg" /> 
        <link href="../webroot/css/styleForm.css" rel="stylesheet" type="text/css"/>
        <style>
            body{
                background-color: #A9C6FF;
            }
            h3{
                margin-bottom: 100px;
            }
            table{
                padding-top: 30px;
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
         * Formulario de búsqueda de departamentos por descripción (por una parte del campo DescDepartamento, si el usuario no pone nada deben aparecer todos los departamentos) [PDO]
         * 
         * @version 1.0.0
         * @since 29-10-2020
         * @author Rodrigo Robles <rodrigo.robmin@educa.jcyl.es>
         */
        require_once '../config/confDBPDOOne.php';

        try {
            $oConexionPDO = new PDO(DSN, USER, PASSWORD, CHARSET); //creo el objeto PDO con las constantes iniciadas en el archivo datosBD.php
            $oConexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //le damos este atributo a la conexión (la configuramos) para poder utilizar las excepciones
            //Requerimos una vez la libreria de validaciones
            require_once '../core/201020libreriaValidacion.php';
            ?>
            <form id="formulario" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <fieldset>
                    <legend>Buscar Departamento <span style='color:yellow;'>[PDO]</span></legend>
                    <!-----------------DESCRIPCIÓN----------------->
                    <div class="required">
                        <label for="codigo">Descripción: </label>
                        <input type="text" name="descripcion" placeholder="Departamento de..." value="<?php
                        //si no hay error y se ha insertado un valor en el campo con anterioridad
                        if (isset($_POST['descripcion'])) {
                            echo $_POST['descripcion'];
                        }
                        ?>"/>
                    </div>
                    <input type="submit" name="enviar" value="Enviar" />
                </fieldset>
            </form>
            <?php
            $descripcionBuscada = "";
            if (isset($_POST['enviar'])) { //si se pulsa 'enviar' (input name="enviar")
                $descripcionBuscada = $_POST['descripcion'];
            }

            $consultaBuscar = "SELECT * FROM Departamento WHERE DescDepartamento LIKE CONCAT('%', :descripcion, '%')";

            $buscarDepartamento = $oConexionPDO->prepare($consultaBuscar);

            //Inserción de datos en al consulta
            $buscarDepartamento->bindParam(':descripcion', $descripcionBuscada);

            //Ejecución
            $buscarDepartamento->execute();

            $numeroDepartamentos = $buscarDepartamento->rowCount(); //número de departamentos encontrados

            if ($numeroDepartamentos !== 0) { //si si se encuentran departamentos, se muestran
                echo "<table>"
                . "<tr>"
                . "<th>Código</th>"
                . "<th>Descripción</th>"
                . "<th>Volumen de negocio</th>"
                . "<th>Fecha de baja</th>"
                . "</tr>";
                while ($departamento = $buscarDepartamento->fetch(PDO::FETCH_OBJ)) {
                    echo "<tr>"
                    . "<td>$departamento->CodDepartamento</td>"
                    . "<td> $departamento->DescDepartamento</td>"
                    . "<td> $departamento->VolumenNegocio</td>"
                    . "<td> $departamento->FechaBaja</td>"
                    . "</tr>";
                }

                echo "</table>";

                echo "<h4>Departamentos encontrados: " . $numeroDepartamentos . "</h4>"; //y mostramos el nº de departamentos encontrados
            } else {  //si no encontramos ningún departamento, lo notificamos al usuario
                echo "<h4>¡No hay ningún departamento con esa descripción!</h4>";
            }
        } catch (PDOException $excepcionPDO) {
            echo "<p style='color:red;'>Mensaje de error: " . $excepcionPDO->getMessage() . "</p>"; //Muestra el mesaje de error
            echo "<p style='color:red;'>Código de error: " . $excepcionPDO->getCode() . "</p>"; // Muestra el codigo del error
        } finally {

            unset($oConexionPDO); //destruimos el objeto  
        }
        ?>

    </body>

</html>       

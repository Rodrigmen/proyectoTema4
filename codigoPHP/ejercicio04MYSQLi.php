<!DOCTYPE html>
<html>
    <head>
        <title>ejercicio04MYSQLi- DWES</title>
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
            @$oConexionMYSQLi = new mysqli(HOST, USER, PASSWORD, DB); //el @ para ignorar los warnings 
            $oConexionMYSQLi->set_charset("utf8");

            //Requerimos una vez la libreria de validaciones
            require_once '../core/201020libreriaValidacion.php';
            ?>
            <form id="formulario" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <fieldset>
                    <legend>Buscar Departamento <span style='color:yellow;'>[MySQLi]</span></legend>
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
            //Consulta preparada = búsqueda de departamento
            //Preparación
            $buscarDepartamento = $oConexionMYSQLi->stmt_init();
            $consultaBuscar = "SELECT * FROM Departamento WHERE DescDepartamento LIKE CONCAT('%', ?, '%')";
            $buscarDepartamento->prepare($consultaBuscar);
            $buscarDepartamento->bind_param('s', $descripcionBuscada);
            $buscarDepartamento->execute();
            $buscarDepartamento->store_result(); //alamacenamos el resultado, con el objetivo de poder utilizar num_rows
            $buscarDepartamento->bind_result($codigo, $descripcion, $volumen, $fecha); //obtenemos el resultado y lo metemos enn variables

            $numeroDepartamentos1 = $buscarDepartamento->num_rows;
            if ($numeroDepartamentos1 !== 0) {
                echo "<table>"
                . "<tr>"
                . "<th>Código</th>"
                . "<th>Descripción</th>"
                . "<th>Volumen de negocio</th>"
                . "<th>Fecha de baja</th>"
                . "</tr>";
                while ($buscarDepartamento->fetch()) {
                    echo "<tr>"
                    . "<td>$codigo</td>"
                    . "<td> $descripcion</td>"
                    . "<td> $volumen</td>"
                    . "<td> $fecha</td>"
                    . "</tr>";
                }
                echo "</table>";

                echo "<h4>Número de registros (departamentos): $numeroDepartamentos1 </h4>";
            } else {
                echo "<h4>¡No hay ningún departamento con esa descripción!</h4>";
            }
            $buscarDepartamento->close();
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

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
        require_once '../config/confDBMYSQLiOne.php';
        mysqli_report(MYSQLI_REPORT_STRICT); // funcion alias de mysqli_driver->report_mode. Habilita la funcion interna que lanza una mysqli_sql_exception para errors en lugar de advertencias

        try {
            @$oConexionMYSQLi = new mysqli(HOST, USER, PASSWORD, DB); //el @ para ignorar los warnings 
            $oConexionMYSQLi->set_charset("utf8");

            //Requerimos una vez la libreria de validaciones
            require_once '../core/201020libreriaValidacion.php';

            //Creamos una variable boleana para definir cuando esta bien o mal rellenado el formulario
            $entradaOK = true;

            //Creamos dos constantes: 'REQUIRED' indica si un campo es obligatorio (tiene que tener algun valor); 'OPTIONAL' indica que un campo no es obligatorio
            define('REQUIRED', 1);
            define('OPTIONAL', 0);

            //Array que contiene los posibles errores de los campos del formulario
            $aErrores = [
                'eDescripcion' => null,
            ];

            //Array que contiene los valores correctos de los campos del formulario
            $aFormulario = [
                'fDescripcion' => null
            ];

            if (isset($_POST['enviar'])) { //si se pulsa 'enviar' (input name="enviar")
                //Validación de los campos (el resultado de la validación se mete en el array aErrores para comprobar posteriormente si da error)
                //DESCRIPCIÓN (input type="text") [OBLIGATORIO {texto alfabetico}] 
                $aErrores['eDescripcion'] = validacionFormularios::comprobarAlfabetico($_POST['descripcion'], 35, 1, REQUIRED);



                //recorremos el array de posibles errores (aErrores), si hay alguno, el campo se limpia y entradaOK es falsa (se vuelve a cargar el formulario)
                foreach ($aErrores as $campo => $validacion) {
                    if ($validacion != null) {
                        $entradaOK = false;
                    }
                }
            } else { // sino se pulsa 'enviar'
                $entradaOK = false;
            }

            if ($entradaOK) { //si el formulario esta bien rellenado
                //Metemos en el array aFormulario los valores introducidos en el formulario ya que son correctos
                $aFormulario['fDescripcion'] = $_POST['descripcion'];

                //formulario, se vuelve a mostrar (es el buscador), por si el usuario quiere seguir buscando (buscador constante)
                ?>
                <form id="formulario" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <fieldset>
                        <legend>Buscar Departamento <span style='color:yellow;'>[MySQLi]</span></legend>
                        <!-----------------DESCRIPCIÓN----------------->
                        <div class="required">
                            <label for="codigo">Descripción: </label>
                            <input type="text" name="descripcion" placeholder="Departamento de..." value="<?php
                            //si no hay error y se ha insertado un valor en el campo con anterioridad
                            if ($aErrores['eDescripcion'] == null && isset($_POST['descripcion'])) {

                                //se muestra dicho valor (el campo no aparece vacío si se relleno correctamente 
                                //[en el caso de que haya que se recarge el formulario por un campo mal rellenado, asi no hay que rellenarlo desde 0])
                                echo $_POST['descripcion'];
                            }
                            ?>"/>

                            <?php
                            //si hay error en este campo
                            if ($aErrores['eDescripcion'] != NULL) {
                                echo "<div class='errores'>" .
                                //se muestra dicho error
                                $aErrores['eDescripcion'] .
                                '</div>';
                            }
                            ?>
                        </div>
                        <input type="submit" name="enviar" value="Enviar" />
                    </fieldset>
                </form>
                <?php
                //Consulta preparada = búsqueda de departamento
                //Preparación
                $buscarDepartamento = $oConexionMYSQLi->stmt_init();
                $consultaBuscar = "SELECT * FROM Departamento WHERE DescDepartamento LIKE CONCAT('%', ?, '%')";
                $buscarDepartamento->prepare($consultaBuscar);
                $buscarDepartamento->bind_param('s', $aFormulario['fDescripcion']);
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
            } else { // si el formulario no esta correctamente rellenado (campos vacios o valores introducidos incorrectos) o no se ha rellenado nunca
                //formulario inicial (es el que aparece según accedes a la práctica)
                ?>
                <form id="formulario" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <fieldset>
                        <legend>Buscar Departamento <span style='color:yellow;'>[MySQLi]</span></legend>
                        <!-----------------DESCRIPCIÓN----------------->
                        <div class="required">
                            <label for="codigo">Descripción: </label>
                            <input type="text" name="descripcion" placeholder="Departamento de..." value="<?php
                            //si no hay error y se ha insertado un valor en el campo con anterioridad
                            if ($aErrores['eDescripcion'] == null && isset($_POST['descripcion'])) {

                                //se muestra dicho valor (el campo no aparece vacío si se relleno correctamente 
                                //[en el caso de que haya que se recarge el formulario por un campo mal rellenado, asi no hay que rellenarlo desde 0])
                                echo $_POST['descripcion'];
                            }
                            ?>"/>

                            <?php
                            //si hay error en este campo
                            if ($aErrores['eDescripcion'] != NULL) {
                                echo "<div class='errores'>" .
                                //se muestra dicho error
                                $aErrores['eDescripcion'] .
                                '</div>';
                            }
                            ?>
                        </div>
                        <input type="submit" name="enviar" value="Enviar" />
                    </fieldset>
                </form>
                <?php
                //MOSTRAMOS TODOS LOS DEPARTAMENTOS EN UNA TABLA, SITUADA POR DEBAJO DEL BUSCADOR
                $seleccionTodosDep = $oConexionMYSQLi->stmt_init();
                $consultaTodos = "SELECT * FROM Departamento ORDER BY CodDepartamento";
                $seleccionTodosDep->prepare($consultaTodos);
                $seleccionTodosDep->execute();
                $seleccionTodosDep->store_result(); //alamacenamos el resultado, con el objetivo de poder utilizar num_rows
                $seleccionTodosDep->bind_result($codigo, $descripcion, $volumen, $fecha); //obtenemos el resultado y lo metemos enn variables

                $numeroDepartamentos2 = $seleccionTodosDep->num_rows;
                if ($numeroDepartamentos2 !== 0) {
                    echo "<table>"
                    . "<tr>"
                    . "<th>Código</th>"
                    . "<th>Descripción</th>"
                    . "<th>Volumen de negocio</th>"
                    . "<th>Fecha de baja</th>"
                    . "</tr>";
                    while ($seleccionTodosDep->fetch()) {
                        echo "<tr>"
                        . "<td>$codigo</td>"
                        . "<td> $descripcion</td>"
                        . "<td> $volumen</td>"
                        . "<td> $fecha</td>"
                        . "</tr>";
                    }
                    echo "</table>";

                    echo "<h4>Número de registros (departamentos): $numeroDepartamentos2 </h4>";
                } else {
                    echo "<h4>¡No hay ningún departamento!</h4>";
                }
                $seleccionTodosDep->close();
            }
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

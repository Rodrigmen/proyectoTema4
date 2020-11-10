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
        require_once '../config/confDBPDO.php';

        try {
            $oConexionPDO = new PDO(DSN, USER, PASSWORD, CHARSET); //creo el objeto PDO con las constantes iniciadas en el archivo datosBD.php
            $oConexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //le damos este atributo a la conexión (la configuramos) para poder utilizar las excepciones
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
                //formulario, se vuelve a mostrar (es el buscador), por si el usuario quiere seguir buscando (buscador constante)
                ?>
                <form id="formulario" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <fieldset>
                        <legend>Buscar Departamento <span style='color:yellow;'>[PDO]</span></legend>
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
                $consultaBuscar = "SELECT * FROM Departamento WHERE DescDepartamento LIKE CONCAT('%', :descripcion, '%')";

                $buscarDepartamento = $oConexionPDO->prepare($consultaBuscar);

                //Inserción de datos en al consulta
                $buscarDepartamento->bindParam(':descripcion', $_POST['descripcion']);

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
            } else { // si el formulario no esta correctamente rellenado (campos vacios o valores introducidos incorrectos) o no se ha rellenado nunca
                //formulario inicial (es el que aparece según accedes a la práctica)
                ?>
                <form id="formulario" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <fieldset>
                        <legend>Buscar Departamento <span style='color:yellow;'>[PDO]</span></legend>
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
        //Preparamos la consulta
        $consultaTodos = "SELECT * FROM Departamento ORDER BY CodDepartamento";
        $seleccionTodosDep = $oConexionPDO->prepare($consultaTodos);

        //Ejecutamos la consulta
        $seleccionTodosDep->execute();

        $numeroDepartamentos = $seleccionTodosDep->rowCount();
        if ($numeroDepartamentos !== 0) { //comprobamos si hay departamentos
            echo "<table>"
            . "<tr>"
            . "<th>Código</th>"
            . "<th>Descripción</th>"
            . "<th>Volumen de negocio</th>"
            . "<th>Fecha de baja</th>"
            . "</tr>";
            while ($departamento = $seleccionTodosDep->fetch(PDO::FETCH_OBJ)) {
                echo "<tr>"
                . "<td>$departamento->CodDepartamento</td>"
                . "<td> $departamento->DescDepartamento</td>"
                . "<td> $departamento->VolumenNegocio</td>"
                . "<td> $departamento->FechaBaja</td>"
                . "</tr>";
            }

            echo "</table>";
            echo "<h4>Número de departamentos: " . $numeroDepartamentos . "</h4>";
        } else {
            echo "<h4>¡No hay ningún departamento!</h4>";
        }
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

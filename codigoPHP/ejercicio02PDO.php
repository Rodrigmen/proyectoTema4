<!DOCTYPE html>
<html>
    <head>
        <title>ejercicio02PDO - DWES</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/jpg" href="../webroot/css/images/favicon.jpg" /> 
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
         * Mostrar el contenido de la tabla Departamento y el número de registros. [PDO]
         * 
         * @version 1.0.0
         * @since 29-10-2020
         * @author Rodrigo Robles <rodrigo.robmin@educa.jcyl.es>
         */
        require_once '../config/confDBPDOOne.php';
        echo "<h3>Contenido de la tabla 'Departamento' de la base de datos 'DAW218DBDepartamentos' <span style='color:yellow;'>[PDO]</span></h3>";
        try {
            $oConexionPDO = new PDO(DSN, USER, PASSWORD, CHARSET); //creo el objeto PDO con las constantes iniciadas en el archivo confDBPDO.php
            $oConexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //le damos este atributo a la conexión (la configuramos) para poder utilizar las excepciones
            //CONSULTA PREPARADA
            //Preparamos la consulta
            $consultaTodos = "SELECT * FROM Departamento ORDER BY CodDepartamento";
            $seleccionTodosDep = $oConexionPDO->prepare($consultaTodos);

            //Ejecutamos la consulta
            $seleccionTodosDep->execute();

            $numeroDepartamentos = $seleccionTodosDep->rowCount(); //rowCount() te devuelve el número de filas afectadas por el query 
            if ($numeroDepartamentos !== 0) {
                //Creamos una tabla, en la cual va a aparecer la respuesta de la consulta (los departamentos)
                echo "<table>"
                . "<tr>"
                . "<th>Código</th>"
                . "<th>Descripción</th>"
                . "<th>Volumen de negocio</th>"
                . "<th>Fecha de baja</th>"
                . "</tr>";
                while ($departamento = $seleccionTodosDep->fetch(PDO::FETCH_OBJ)) { //convertimos a objetos todos los departamentos, y mientras no sean nulos, se recorren
                    echo "<tr>"
                    . "<td>$departamento->CodDepartamento</td>"
                    . "<td> $departamento->DescDepartamento</td>"
                    . "<td> $departamento->VolumenNegocio</td>"
                    . "<td> $departamento->FechaBaja</td>"
                    . "</tr>";
                }

                echo "</table>";
                echo "<h4>Número de registros (departamentos): $numeroDepartamentos </h4>";
            } else {
                echo "<h4>¡No hay ningún departamento!</h4>";
            }
            $seleccionTodosDep->closeCursor(); // Cierra un cursor, inhabilitando a la sentencia para que sea ejecutada otra vez
            //CONSULTA SIMPLE
            $seleccionTodosDep2 = $oConexionPDO->query("SELECT * FROM Departamento ORDER BY CodDepartamento");

            $numeroDepartamentos2 = $seleccionTodosDep2->rowCount(); //rowCount() te devuelve el número de filas afectadas por el query 
            if ($numeroDepartamentos2 !== 0) {
                //Creamos una tabla, en la cual va a aparecer la respuesta de la consulta (los departamentos)
                echo "<table>"
                . "<tr>"
                . "<th>Código</th>"
                . "<th>Descripción</th>"
                . "<th>Volumen de negocio</th>"
                . "<th>Fecha de baja</th>"
                . "</tr>";
                while ($departamento2 = $seleccionTodosDep2->fetch(PDO::FETCH_OBJ)) { //convertimos a objetos todos los departamentos, y mientras no sean nulos, se recorren
                    echo "<tr>"
                    . "<td>$departamento2->CodDepartamento</td>"
                    . "<td> $departamento2->DescDepartamento</td>"
                    . "<td> $departamento2->VolumenNegocio</td>"
                    . "<td> $departamento2->FechaBaja</td>"
                    . "</tr>";
                }

                echo "</table>";
                echo "<h4>Número de registros (departamentos): $numeroDepartamentos2 </h4>";
            } else {

                echo "<h4>¡No hay ningún departamento!</h4>";
            }
            $seleccionTodosDep2->closeCursor();
        } catch (PDOException $excepcionPDO) {
            echo "<p style='color:red;'>Mensaje de error: " . $excepcionPDO->getMessage() . "</p>"; //Muestra el mesaje de error
            echo "<p style='color:red;'>Código de error: " . $excepcionPDO->getCode() . "</p>"; // Muestra el codigo del error
        } finally {

            unset($oConexionPDO); //destruimos el objeto
        }
        ?>

    </body>

</html>       

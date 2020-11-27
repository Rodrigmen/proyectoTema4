<?php
/**
 * Script de borrado
 * 
 * @version 1.0.0
 * @since 26-11-2020
 * @author Rodrigo Robles <rodrigo.robmin@educa.jcyl.es>
 */
require_once "../config/confDBPDO.php"; //Incluimos el archivo confDBPDO.php para poder acceder al valor de las constantes de los distintos valores de la conexión 

try {
    $miDB = new PDO(DSN, USER, PASSWORD); //Instanciamos un objeto PDO y establecemos la conexión
    $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Configuramos las excepciones

    $sql = ("TRUNCATE TABLE Departamento;");
    $miDB->exec($sql);

    echo "<h3> <span style='color: green;'>" . "Tabla borrada correctamente</span></h3>"; //Si no se ha producido ningún error nos mostrará "Conexión establecida con éxito"
} catch (PDOException $excepcion) {//Código que se ejecutará si se produce alguna excepción
    $errorExcepcion = $excepcion->getCode(); //Almacenamos el código del error de la excepción en la variable $errorExcepcion
    $mensajeExcepcion = $excepcion->getMessage(); //Almacenamos el mensaje de la excepción en la variable $mensajeExcepcion

    echo "<span style='color: red;'>Error: </span>" . $mensajeExcepcion . "<br>"; //Mostramos el mensaje de la excepción
    echo "<span style='color: red;'>Código del error: </span>" . $errorExcepcion; //Mostramos el código de la excepción
} finally {
    unset($miDB);
}
?>
<?php
//DATOS COMUNES EN LAS CONEXIONES
//PDO Y MYSQLi
define('USER', 'usuarioDAW218DBDepartamentos');
define('PASSWORD', 'P@ssw0rd');
define('CHARSET', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")); //codificación UTF-8 para los datos que se transmitan en el servidor MySQL 

//PDO CLASE DESARROLLO
define('DSN', 'mysql:host=192.168.20.19;dbname=DAW218DBDepartamentos');
/*
//PDO CLASE EXPLOTACION
define('DSN', 'mysql:host=192.168.20.19;dbname=DAW218DBDepartamentos');

//PDO CASA
define('DSN', 'mysql:host=192.168.1.240;dbname=DAW218DBDepartamentos');

//PDO Y MYSQLi 1&1
define('USER', 'dbu1120028');
define('PASSWORD', 'Covid1234$');
//PDO 1&1
define('DSN', 'mysql:host=db5001094469.hosting-data.io;dbname=dbs939491');
 * 
 */
?>
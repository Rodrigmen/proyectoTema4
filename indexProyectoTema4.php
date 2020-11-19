<!DOCTYPE html>
<html>
    <head>
        <title>DWES - Rodrigo Robles</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="webroot/css/styleDWESTema4.css" rel="stylesheet" type="text/css"/>
        <link rel="icon" type="image/jpg" href="webroot/css/images/favicon.jpg" />
    </head>
    <body>
        <header>
            <h1 id="titulo">DWES - Tema 4</h1>
            <nav class="navegacion">
                <ul class="menu">
                    <li><a href="../../index.html"><img id="inicio"  src="webroot/css/images/inicio.png"  alt="Inicio"></a></li>
                    <li><a href="../indexProyectoDWES.php">DWES</a>
                        <ul class="submenu">
                            <li><a href="../doc/EstudioTema1.pdf" target="_blank">Tema 1</a></li>
                            <li><a href="../doc/EstudioTema2.pdf" target="_blank">Tema 2</a></li>
                            <li><a href="../proyectoTema3/indexProyectoTema3.php">Tema 3</a></li>
                        </ul>
                    </li>
                    <li><a href="../../proyectoDAW/indexProyectoDAW.php">DAW</a>
                        <ul class="submenu">
                            <li><a href="../../proyectoDAW/doc/RRM_Ud1_Tarea2.pdf" target="_blank">Tema 1</a></li>
                        </ul>
                    </li>
                    <li><a href="../../proyectoDWEC/indexProyectoDWEC.php">DWEC</a>
                        <ul class="submenu">
                            <li><a href="../../proyectoDWEC/Tema1DWEC/indexTema1DWEC.php">Tema 1</a></li>
                            <li><a href="../../proyectoDWEC/Tema2DWEC/indexTema2DWEC.php">Tema 2</a></li>
                        </ul>
                    </li>
                    <li><a id="ghost">Ghost</a>

                    </li>
                </ul>
            </nav>
            <div id="ctabla">
                <table id="ejercicios">
                    <!--MANTENIMIENTO DEPARTAMENTOS-->
                    <tr>
                        <td class="enunciado">MANTENIMIENTO DEPARTAMENTOS.</td>
                        <td class="iconos">
                            <a href="MtoDepartamentosTema4/codigoPHP/MtoDepartamentos.php">
                                <img class="imgejer" src="webroot/css/images/ejecutar.png" alt="Ejecutar" title="Ejecutar"/>
                            </a>
                        </td>
                        <td>
                            <p class="casper">         </p>
                        </td>
                    </tr>
                    <!--EJERCICIO 00 - SCRIPTS-->
                    <tr>
                        <td class="enunciado">[Ejercicio 00] - SCRIPTS DE LA BASE DE DATOS</td>
                        <td class="iconos">
                            <a href="mostrarcodigo/mostrarScripts.php">
                                <img class="imgejer" src="webroot/css/images/mostrar.png" alt="Mostrar" title="Mostrar"/>
                            </a>
                        </td>
                        <td>
                            <p class="casper">         </p>
                        </td>
                    </tr>

                    <!--CONFIGURACIONES-->
                    <tr>
                        <td class="enunciado">DISTINTAS CONFIGURACIONES PARA LAS CONEXIONES</td>
                        <td class="iconos">
                            <a href="mostrarcodigo/mostrarConfig.php">
                                <img class="imgejer" src="webroot/css/images/mostrar.png" alt="Mostrar" title="Mostrar"/>
                            </a>
                        </td>
                        <td>
                            <p class="casper">         </p>
                        </td>
                    </tr>


                    <!--VACIAR TABLA DEPARTAMENTOS-->
                    <tr>
                        <td class="enunciado">VACIAR TABLA DEPARTAMENTOS</td>
                        <td class="iconos">
                            <a href="codigoPHP/vaciarDepartamentos.php">
                                <img class="imgejer" src="webroot/css/images/ejecutar.png" alt="VACIAR" title="VACIAR"/>
                            </a>
                        </td>
                        <td class="iconos">
                            <a href="mostrarcodigo/mostrarVaciar.php">
                                <img class="imgejer" src="webroot/css/images/mostrar.png" alt="MostrarPDO" title="MostrarPDO"/>
                            </a>
                        </td>
                        <td>
                            <p class="casper">         </p>
                        </td>
                    </tr>

                    <!--SEPARACIÓN PDO Y MYSQLi-->
                    <tr id="marcatabla">
                        <th></th>
                        <th colspan="2">PDO</th>
                        <th colspan="2">MYSQLi</th>
                        <td>
                            <p class="casper"></p>
                        </td>
                    </tr>

                    <!--EJERCICIO 01 - CONEXIÓN INICIAL-->
                    <tr>
                        <td class="enunciado">[Ejercicio 01] - Conexión inicial con la base de datos.</td>
                        <td class="iconos">
                            <a href="codigoPHP/ejercicio01PDO.php">
                                <img class="imgejer" src="webroot/css/images/ejecutar.png" alt="EjecutarPDO" title="EjecutarPDO"/>
                            </a>
                        </td>
                        <td class="iconos">
                            <a href="mostrarcodigo/mostrarEjercicio01PDO.php">
                                <img class="imgejer" src="webroot/css/images/mostrar.png" alt="MostrarPDO" title="MostrarPDO"/>
                            </a>
                        </td>
                        <td class="iconos">
                            <a href="codigoPHP/ejercicio01MYSQLi.php">
                                <img class="imgejer" src="webroot/css/images/ejecutar.png" alt="EjecutarMYSQLi" title="EjecutarMYSQLi"/>
                            </a>
                        </td>
                        <td class="iconos">
                            <a href="mostrarcodigo/mostrarEjercicio01MYSQLi.php">
                                <img class="imgejer" src="webroot/css/images/mostrar.png" alt="MostrarMYSQLI" title="MostrarMYSQLi"/>
                            </a>
                        </td>
                        <td>
                            <p class="casper">         </p>
                        </td>
                    </tr>

                    <!--EJERCICIO 02 - MOSTRAR CONTENIDO DE LA TABLA DEPARTAMENTO-->
                    <tr>
                        <td class="enunciado">[Ejercicio 02] - Mostrar el contenido de la tabla Departamento y el número de registros.</td>
                        <td class="iconos">
                            <a href="codigoPHP/ejercicio02PDO.php">
                                <img class="imgejer" src="webroot/css/images/ejecutar.png" alt="EjecutarPDO" title="EjecutarPDO"/>
                            </a>
                        </td>
                        <td class="iconos">
                            <a href="mostrarcodigo/mostrarEjercicio02PDO.php">
                                <img class="imgejer" src="webroot/css/images/mostrar.png" alt="MostrarPDO" title="MostrarPDO"/>
                            </a>
                        </td>
                        <td class="iconos">
                            <a href="codigoPHP/ejercicio02MYSQLi.php">
                                <img class="imgejer" src="webroot/css/images/ejecutar.png" alt="EjecutarMYSQLi" title="EjecutarMYSQLi"/>
                            </a>
                        </td>
                        <td class="iconos">
                            <a href="mostrarcodigo/mostrarEjercicio02MYSQLi.php">
                                <img class="imgejer" src="webroot/css/images/mostrar.png" alt="MostrarMYSQLI" title="MostrarMYSQLi"/>
                            </a>
                        </td>
                        <td>
                            <p class="casper">         </p>
                        </td>
                    </tr>

                    <!--EJERCICIO 03 - INSERTAR UN NUEVO DEPARTAMENTO-->
                    <tr>
                        <td class="enunciado">[Ejercicio 03] - Insertar un nuevo departamento.</td>
                        <td class="iconos">
                            <a href="codigoPHP/ejercicio03PDO.php">
                                <img class="imgejer" src="webroot/css/images/ejecutar.png" alt="EjecutarPDO" title="EjecutarPDO"/>
                            </a>
                        </td>
                        <td class="iconos">
                            <a href="mostrarcodigo/mostrarEjercicio03PDO.php">
                                <img class="imgejer" src="webroot/css/images/mostrar.png" alt="MostrarPDO" title="MostrarPDO"/>
                            </a>
                        </td>
                        <td class="iconos">
                            <a href="codigoPHP/ejercicio03MYSQLi.php">
                                <img class="imgejer" src="webroot/css/images/ejecutar.png" alt="EjecutarMYSQLi" title="EjecutarMYSQLi"/>
                            </a>
                        </td>
                        <td class="iconos">
                            <a href="mostrarcodigo/mostrarEjercicio03MYSQLi.php">
                                <img class="imgejer" src="webroot/css/images/mostrar.png" alt="MostrarMYSQLI" title="MostrarMYSQLi"/>
                            </a>
                        </td>
                        <td>
                            <p class="casper">         </p>
                        </td>
                    </tr>

                    <!--EJERCICIO 04 - BUSCAR UN DEPARTAMENTO-->
                    <tr>
                        <td class="enunciado">[Ejercicio 04] - Buscador de departamentos.</td>
                        <td class="iconos">
                            <a href="codigoPHP/ejercicio04PDO.php">
                                <img class="imgejer" src="webroot/css/images/ejecutar.png" alt="EjecutarPDO" title="EjecutarPDO"/>
                            </a>
                        </td>
                        <td class="iconos">
                            <a href="mostrarcodigo/mostrarEjercicio04PDO.php">
                                <img class="imgejer" src="webroot/css/images/mostrar.png" alt="MostrarPDO" title="MostrarPDO"/>
                            </a>
                        </td>

                        <td class="iconos">
                            <a href="codigoPHP/ejercicio04MYSQLi.php">
                                <img class="imgejer" src="webroot/css/images/ejecutar.png" alt="EjecutarMYSQLi" title="EjecutarMYSQLi"/>
                            </a>
                        </td>
                        <td class="iconos">
                            <a href="mostrarcodigo/mostrarEjercicio04MYSQLi.php">
                                <img class="imgejer" src="webroot/css/images/mostrar.png" alt="MostrarMYSQLI" title="MostrarMYSQLi"/>
                            </a>
                        </td>
                        <td>
                            <p class="casper">         </p>
                        </td>
                    </tr>

                    <!--EJERCICIO 05 - TRANSACCIÓN DE 3 DEPARTAMENTOS-->
                    <tr>
                        <td class="enunciado">[Ejercicio 05] - Transacción de 3 departamentos.</td>
                        <td class="iconos">
                            <a href="codigoPHP/ejercicio05PDO.php">
                                <img class="imgejer" src="webroot/css/images/ejecutar.png" alt="EjecutarPDO" title="EjecutarPDO"/>
                            </a>
                        </td>
                        <td class="iconos">
                            <a href="mostrarcodigo/mostrarEjercicio05PDO.php">
                                <img class="imgejer" src="webroot/css/images/mostrar.png" alt="MostrarPDO" title="MostrarPDO"/>
                            </a>
                        </td>
                        <td class="iconos">
                            <a href="codigoPHP/ejercicio05MYSQLi.php">
                                <img class="imgejer" src="webroot/css/images/ejecutar.png" alt="EjecutarMYSQLi" title="EjecutarMYSQLi"/>
                            </a>
                        </td>
                        <td class="iconos">
                            <a href="mostrarcodigo/mostrarEjercicio05MYSQLi.php">
                                <img class="imgejer" src="webroot/css/images/mostrar.png" alt="MostrarMYSQLI" title="MostrarMYSQLi"/>
                            </a>
                        </td>
                        <td>
                            <p class="casper">         </p>
                        </td>
                    </tr>

                    <!--EJERCICIO 06 - TRANSACCIÓN DE UN ARRAY DE DEPARTAMENTOS-->
                    <tr>
                        <td class="enunciado">[Ejercicio 06] - Transacción de un array de departamentos.</td>
                        <td class="iconos">
                            <a href="codigoPHP/ejercicio06PDO.php">
                                <img class="imgejer" src="webroot/css/images/ejecutar.png" alt="EjecutarPDO" title="EjecutarPDO"/>
                            </a>
                        </td>
                        <td class="iconos">
                            <a href="mostrarcodigo/mostrarEjercicio06PDO.php">
                                <img class="imgejer" src="webroot/css/images/mostrar.png" alt="MostrarPDO" title="MostrarPDO"/>
                            </a>
                        </td>
                        <td class="iconos">
                            <a href="codigoPHP/ejercicio06MYSQLi.php">
                                <img class="imgejer" src="webroot/css/images/ejecutar.png" alt="EjecutarMYSQLi" title="EjecutarMYSQLi"/>
                            </a>
                        </td>
                        <td class="iconos">
                            <a href="mostrarcodigo/mostrarEjercicio06MYSQLi.php">
                                <img class="imgejer" src="webroot/css/images/mostrar.png" alt="MostrarMYSQLI" title="MostrarMYSQLi"/>
                            </a>
                        </td>
                        <td>
                            <p class="casper">         </p>
                        </td>
                    </tr>

                    <!--SEPARACIÓN SEGÚN TIPO DE ARCHIVOS-->
                    <tr id="marcatabla">
                        <th></th>
                        <th colspan="2">XML</th>
                        <th colspan="2">JSON</th>
                        <th colspan="2">CSV</th>
                        <td>
                            <p class="casper"></p>
                        </td>
                    </tr>

                    <!--EJERCICIO 07 - IMPORTAR BASE DE DATOS -->
                    <tr>
                        <td class="enunciado">[Ejercicio 07] - Importación de la base de datos.</td>
                        <td class="iconos">

                            <a href="codigoPHP/ejercicio07PDO.php">
                                <img class="imgejer" src="webroot/css/images/ejecutar.png" alt="EjecutarPDO" title="EjecutarPDO"/>
                            </a>
                        </td>
                        <td class="iconos">
                            <a href="mostrarcodigo/mostrarEjercicio07PDO.php">
                                <img class="imgejer" src="webroot/css/images/mostrar.png" alt="MostrarPDO" title="MostrarPDO"/>
                            </a>
                        </td>
                        <td class="iconos">

                            <a href="codigoPHP/ejercicio07PDOJSON.php">
                                <img class="imgejer" src="webroot/css/images/ejecutar.png" alt="EjecutarPDO" title="EjecutarPDO"/>
                            </a>
                        </td>
                        <td class="iconos">
                            <a href="mostrarcodigo/mostrarEjercicio07PDOJSON.php">
                                <img class="imgejer" src="webroot/css/images/mostrar.png" alt="MostrarPDO" title="MostrarPDO"/>
                            </a>
                        </td>
                        <td class="iconos">

                            <a href="codigoPHP/ejercicio07PDOCSV.php">
                                <img class="imgejer" src="webroot/css/images/ejecutar.png" alt="EjecutarPDO" title="EjecutarPDO"/>
                            </a>
                        </td>
                        <td class="iconos">
                            <a href="mostrarcodigo/mostrarEjercicio07PDOCSV.php">
                                <img class="imgejer" src="webroot/css/images/mostrar.png" alt="MostrarPDO" title="MostrarPDO"/>
                            </a>
                        </td>
                        <td>

                            <p class="casper">         </p>
                        </td>
                    </tr>




                    <!--EJERCICIO 08 - EXPORTAR BASE DE DATOS -->
                    <tr>
                        <td class="enunciado">[Ejercicio 08] - Exportación de la base de datos.</td>
                        <td class="iconos">
                            <a href="codigoPHP/ejercicio08PDO.php">
                                <img class="imgejer" src="webroot/css/images/ejecutar.png" alt="EjecutarPDO" title="EjecutarPDO"/>
                            </a>
                        </td>
                        <td class="iconos">
                            <a href="mostrarcodigo/mostrarEjercicio08PDO.php">
                                <img class="imgejer" src="webroot/css/images/mostrar.png" alt="MostrarPDO" title="MostrarPDO"/>
                            </a>
                        </td>
                        <td class="iconos">
                            <a href="codigoPHP/ejercicio08PDOJSON.php">
                                <img class="imgejer" src="webroot/css/images/ejecutar.png" alt="EjecutarPDO" title="EjecutarPDO"/>
                            </a>
                        </td>
                        <td class="iconos">
                            <a href="mostrarcodigo/mostrarEjercicio08PDOJSON.php">
                                <img class="imgejer" src="webroot/css/images/mostrar.png" alt="MostrarPDO" title="MostrarPDO"/>
                            </a>
                        </td>
                        <td class="iconos">
                            <a href="codigoPHP/ejercicio08PDOCSV.php">
                                <img class="imgejer" src="webroot/css/images/ejecutar.png" alt="EjecutarPDO" title="EjecutarPDO"/>
                            </a>
                        </td>
                        <td class="iconos">
                            <a href="mostrarcodigo/mostrarEjercicio08PDOCSV.php">
                                <img class="imgejer" src="webroot/css/images/mostrar.png" alt="MostrarPDO" title="MostrarPDO"/>
                            </a>
                        </td>

                        <td>
                            <p class="casper">         </p>
                        </td>
                    </tr>


                </table>
            </div>


        </header>
    </body>
    <footer>
        <ul>
            <li>&copy2020-2021 | Rodrigo Robles Miñambres</li>
            <li>
                <a target="_blank" href="https://github.com/Rodrigmen">
                    <img id="imggit" title="GitHub" src="webroot/css/images/github.png"  alt="GITHUB">
                </a>
            </li>
        </ul>            
    </footer>
</html>

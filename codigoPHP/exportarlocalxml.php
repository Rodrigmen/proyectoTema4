<?php

$fichero = '../tmp/departamentos.xml';

if (file_exists($fichero)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($fichero) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($fichero));
    readfile($fichero);
    exit;
} else {
    echo "<p style='color:red;'>Error al obtener el archivo XML</p>"; //Muestra el mesaje de error
}
?>

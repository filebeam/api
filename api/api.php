<?php
require "../config/config.php";
require "../lib/ConvertUnit.php";
require "submit.php";

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo "Solo se admiten peticiones POST";
    http_response_code(405);
    return;
}

if (!isset($_FILES['file']) || $_FILES['file']['name'] === "") {
    echo "No se ha enviado ningun archivo";
    http_response_code(400);
    return;
}

$fileSize = byteToMB($_FILES['file']['size']);

if ($fileSize >= 200) {
    echo "El archivo ha excedido el máximo permitido";
    http_response_code(413);
    return;
}

$fileName = $_FILES['file']['name'];
$fileNameCmps = explode('.', $fileName);
$fileExtension = strtolower(end($fileNameCmps));

if (!isValidExtension($fileExtension)) {
    echo "Tipo de archivo no admitido";
    http_response_code(400);
    return;
}

if (needsSanitize($fileExtension)) {
    submit(true, 0);
    return;
}

submit(false, 0);

# Funciones de validación
function isValidExtension($extension)
{
    $blacklist = ['jsp', 'exe', 'jar', 'scr', 'cpl', 'doc', 'docx', 'sh'];
    return !in_array($extension, $blacklist);
}

function needsSanitize($extension)
{
    $required = ['html', 'xhtml', 'php', 'phtml', 'cgi', 'xml', 'js'];
    return in_array($extension, $required);
}

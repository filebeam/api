<?php
require "config/config.php";
require "config/connection.php";
require "lib/ConvertUnit.php";
require "submit.php";

# Validaciones de cualquier archivo

if ($maintenance) {
    echo "Servicio no disponible temporalmente";
    http_response_code(503);
    return;
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo "Solo se admiten peticiones POST \n";
    http_response_code(405);
    return;
}

if (!isset($_FILES['file']) || $_FILES['file']['name'] === "") {
    echo "No se ha enviado ningun archivo \n";
    http_response_code(400);
    return;
}

$fileSize = byteToMB($_FILES['file']['size']);

if (!isset($_POST['time'])) {
    $time = 0;
} else {
    $time = htmlspecialchars($_POST['time']);
}

if ($time == 0 && $fileSize >= 200) {
    echo "El archivo ha excedido el máximo permitido \n";
    http_response_code(413);
    return;
}

if ($fileSize >= 1024) {
    echo "El archivo ha excedido el máximo permitido \n";
    http_response_code(413);
    return;
}

$fileName = $_FILES['file']['name'];
$fileNameCmps = explode('.', $fileName);
$fileExtension = strtolower(end($fileNameCmps));

if (!isValidExtension($fileExtension)) {
    echo "Tipo de archivo no admitido \n";
    http_response_code(400);
    return;
}

$fileHash = hash_file('sha256', $_FILES['file']['tmp_name']);
$stmt = $conn->prepare("SELECT * FROM blacklist WHERE hash = :hash");
$stmt->bindParam(":hash", $fileHash);
$stmt->execute();

if($stmt->rowCount() != 0){
    echo "Archivo bloqueado \n";
    http_response_code(400);
    return;
}

if (needsSanitize($fileExtension)) {
    submit(true, $time, $fileHash);
    return;
}

submit(false, $time, $fileHash);

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

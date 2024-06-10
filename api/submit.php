<?php

function submit($needSanitize, $time)
{
    require "../config/config.php";
    require "../lib/rename.php";

    # Obtiene datos del archivo subido
    $fileTmpPath = $_FILES['file']['tmp_name'];
    $fileName = $_FILES['file']['name'];
    $fileSize = $_FILES['file']['size'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    # Generacion de nombre de archivo
    $newFileName = randomize(6) . "." . $fileExtension;

    # Comprueba si hay un archivo con el mismo nombre en el servidor
    while(file_exists($uploadFileDir . $newFileName)){
        $newFileName = randomize(6) . "." . $fileExtension;
    }

    # Mueve el archivo subido al directorio final (file/)
    move_uploaded_file($fileTmpPath, $uploadFileDir . $newFileName);

    # Comprueba si require sanitizado el archivo
    if ($needSanitize) {
       $sanitiziedContent = file_get_contents($uploadFileDir . $newFileName);
       $sanitiziedContent = htmlspecialchars($sanitiziedContent, ENT_QUOTES | ENT_HTML5);
       file_put_contents($uploadFileDir . $newFileName, $sanitiziedContent);
    }

    $port = $_SERVER['SERVER_PORT'];

    if($port === 443){
        $fileUrl = "https://$uri/file/" . $newFileName;
    } else {
        $fileUrl = "http://$uri/file/" . $newFileName;
    }

    echo $fileUrl;
}

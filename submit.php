<?php

function submit($needSanitize, $time, $hash)
{
    require "config/config.php";
    require "lib/rename.php";
    require "lib/time.php";
    require "log.php";
    require "submit-time.php";

    # Obtiene datos del archivo subido
    $fileTmpPath = $_FILES['file']['tmp_name'];
    $fileName = $_FILES['file']['name'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    # Generacion de nombre de archivo
    $newFileName = randomize(6) . "." . $fileExtension;

    # Comprueba si hay un archivo con el mismo nombre en el servidor
    while(file_exists($uploadFileDir . $newFileName)){
        $newFileName = randomize(6) . "." . $fileExtension;
    }

    if (!is_dir('file/')) {
        mkdir('file/');
    }

    # Mueve el archivo subido al directorio final (file/)
    move_uploaded_file($fileTmpPath, $uploadFileDir . $newFileName);

    # Comprueba si require sanitizado el archivo
    if ($needSanitize) {
       $sanitiziedContent = file_get_contents($uploadFileDir . $newFileName);
       $sanitiziedContent = htmlspecialchars($sanitiziedContent, ENT_QUOTES | ENT_HTML5);
       file_put_contents($uploadFileDir . $newFileName, $sanitiziedContent);
    }

    $sent_time = getUnixTime();
    $file_dir = $uploadFileDir . $newFileName;

    switch($time) {
        case null:
            addLog($newFileName, $hash);
            break;
        case '5m':
            addLog($newFileName, $hash);
            addTime(300, $newFileName, $sent_time);
            break;
        case '30m':
            addLog($newFileName, $hash);
            addTime(1800, $newFileName, $sent_time);
            break;
        case '1h':
            addLog($newFileName, $hash);
            addTime(3600, $newFileName, $sent_time);
            break;
        case '6h':
            addLog($newFileName, $hash);
            addTime(21600, $newFileName, $sent_time);
            break;
        case '12h':
            addLog($newFileName, $hash);
            addTime(43200, $newFileName, $sent_time);
            break;
        case '24h':
            addLog($newFileName, $hash);
            addTime(86400, $newFileName, $sent_time);
            break;
        default:
            echo "Variable tiempo inválida. Subida cancelada." . "\n";
            http_response_code(400);
            $target_dir = $uploadFileDir . $newFileName;
            unlink($target_dir);
            die;
    }

    if ($_SERVER['SERVER_PORT'] != 443) {
        $fileUrl = "http://$uri". $newFileName . "\n";
    } else {
        $fileUrl = "https://$uri" . $newFileName . "\n";
    }

    echo $fileUrl;
}

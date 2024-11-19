<?php

# Encabezados CORS

header("Access-Control-Allow-Origin: https://yourfrontenddomain.com"); 

header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE"); 

header("Access-Control-Allow-Headers: Content-Type, Authorization"); 

# API que permite ver la cantidad de archivos subidos en total

try {
    
$directory = 'file/';

$total = count(scandir($directory));

echo $total;
} catch (Exception $e) {
    echo $e->getMessage();
}
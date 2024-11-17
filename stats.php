<?php 

# API que permite ver la cantidad de archivos subidos en total

try {
    
$directory = 'file/';

$total = count(scandir($directory));

echo $total;
} catch (Exception $e) {
    echo $e->getMessage();
}
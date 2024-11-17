<?php 

# API que permite ver la cantidad de archivos subidos en total

$directory = 'file/';

$total = count(scandir($directory));

echo $total;
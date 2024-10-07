<?php
require_once "fixurl.php";

# Variables de configuracion de FileBeam. Pronto habrán mas funciones y variables de configuracion

$uri = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; # URI generado automaticamente para el funcionamiento de la pagina.
$uri = sanitize($uri);
$uploadFileDir = 'file/'; # Directorio donde va a ser alojado el archivo
$maintenance = false; # Modo mantenimiento
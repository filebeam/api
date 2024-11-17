<?php
require_once "fixurl.php";

# Variables de configuracion de FileBeam. Pronto habrán mas funciones y variables de configuracion

$type = "dev"; # prod / dev
$uri = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; # URI generado automaticamente para el funcionamiento de la pagina.
$uri = sanitize($uri, $type);
$uploadFileDir = 'file/'; # Directorio donde va a ser alojado el archivo
$maintenance = false; # Modo mantenimiento
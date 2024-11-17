<?php

function sanitize($uri){

    include "config.php";

    $uri = htmlspecialchars($uri, ENT_QUOTES, 'UTF-8'); # Sanitizado de la URI
    if ($type == "dev") {
        $uri = str_replace("//", "", $uri); # Ajuste de la URI para evitar problemas con la generacion de URL. 
    } else {
        $uri = str_replace("/api/", "", $uri);
    }
    $uri = strtok($uri, '?'); # Mas ajustes a la URI

    return $uri;
}
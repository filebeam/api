<?php

function sanitize($uri){

    $uri = htmlspecialchars($uri, ENT_QUOTES, 'UTF-8'); # Sanitizado de la URI
    $uri = str_replace("/api/", "", $uri); # Ajuste de la URI para evitar problemas con la generacion de URL. 
    $uri = strtok($uri, '?'); # Mas ajustes a la URI

    return $uri;
}
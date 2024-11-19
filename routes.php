<?php

require_once __DIR__.'/router.php';

# Encabezados CORS

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");

# Manejar solicitudes OPTIONS (preflight)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Responde a la solicitud preflight con un 200 OK y finaliza
    http_response_code(200);
    exit;
}

# RUTEADOR PHP
# CREDITOS: https://github.com/phprouter/main

any('/','validator.php');

get('/anuncios', 'announcements.php');

get('/totalFiles', 'stats.php');
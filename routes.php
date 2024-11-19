<?php

require_once __DIR__.'/router.php';

# Encabezados CORS

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");

# RUTEADOR PHP
# CREDITOS: https://github.com/phprouter/main

any('/','validator.php');

get('/anuncios', 'announcements.php');

get('/totalFiles', 'stats.php');
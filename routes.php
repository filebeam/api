<?php

require_once __DIR__.'/router.php';

# RUTEADOR PHP
# CREDITOS: https://github.com/phprouter/main

any('/','validator.php');

get('/anuncios', 'announcements.php');

get('/totalFiles', 'stats.php');
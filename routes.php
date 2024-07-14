<?php

require_once __DIR__.'/router.php';

# RUTEADOR PHP
# CREDITOS: https://github.com/phprouter/main

any('/','api.php');

get('/anuncios', 'announcements.php');
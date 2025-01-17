<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ValidateFile;

Route::any('/', function () {
   echo "Hola";
})->middleware(ValidateFile::class);
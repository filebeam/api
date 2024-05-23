<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubmitController;
use App\Http\Controllers\AnunciosController;
use App\Http\Middleware\ValidateFile;
use App\Http\Middleware\AnnouncementRequests;

Route::get('/', function(){
    return view('index');
});

Route::get('/disclaimer', function(){
    return view('disclaimer');
});

Route::any('/api/anuncios', [AnunciosController::class, 'getContent'])->middleware(AnnouncementRequests::class);

Route::any('/api', [SubmitController::class, 'submit'])->middleware(ValidateFile::class);
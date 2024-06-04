<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubmitController;
use App\Http\Controllers\AnunciosController;
use App\Http\Middleware\ValidateFile;
use App\Http\Middleware\AnnouncementRequests;

Route::get('/', function(){ # Raiz de la pagina
    return redirect()->away('https://filebeam.xyz/app');
});

# Ruta /api, controlado por SubmitController y a su vez respaldado por el middleware ValidateFile
Route::any('/api', [SubmitController::class, 'submit'])->middleware(ValidateFile::class);

# Ruta /api/anuncios, controlado por AnunciosController y a su vez respaldado por el middleware AnnouncementRequests
Route::any('/api/anuncios', [AnunciosController::class, 'getContent'])->middleware(AnnouncementRequests::class);

# Ruta /github, solo redirige al github de filebeam
Route::get('/github', function(){
    return redirect()->away('https://github.com/filebeam');
});
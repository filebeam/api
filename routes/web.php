<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubmitController;

Route::get('/', function(){
    return view('index');
});

Route::get('/disclaimer', function(){
    return view('disclaimer');
});

Route::any('/api', [SubmitController::class, 'submit']);
<?php

use App\Http\Controllers\SubmitController;
use App\Http\Middleware\ValidateFile;
use Illuminate\Support\Facades\Route;

Route::any('/', [SubmitController::class, 'submit'])->middleware(ValidateFile::class);

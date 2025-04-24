<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubmitController;
use App\Http\Middleware\ValidateFile;

Route::any('/', [SubmitController::class, 'submit'])->middleware(ValidateFile::class);
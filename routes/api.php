<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubmitController;
use App\Http\Controllers\AnnouncementsController;
use App\Http\Middleware\AnnouncementRequests;
use App\Http\Middleware\ValidateFile;
use App\Http\Controllers\FilesStatsController;
use App\Http\Middleware\GetFileStatsRequests;

Route::any('/', [SubmitController::class, 'submit'])->middleware(ValidateFile::class);

Route::any('/anuncios', [AnnouncementsController::class, 'getContent'])->middleware(AnnouncementRequests::class);

Route::any('/totalFiles', [FilesStatsController::class, 'getFiles'])->middleware(GetFileStatsRequests::class);
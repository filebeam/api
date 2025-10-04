<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FilesStatsController extends Controller
{
    public function getFiles(Request $request){

    try {

    $files = Storage::disk('public')->files();
    $count = count($files);

    echo $count;

    } catch (Exception $e) {

        echo $e->getMessage();
    }

    }
}

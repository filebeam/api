<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FilesStatsController extends Controller
{
    public function getFiles(Request $request){

    try {

    $total = count(scandir(env('FILES_PATH')));
    
    echo $total;

    } catch (Exception $e) {

        echo "0";
    }

    }
}

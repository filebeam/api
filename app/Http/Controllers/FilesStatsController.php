<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FilesStatsController extends Controller
{
    public function getFiles(Request $request){

    try {

    $total = count(scandir(storage_path('public')));
    
    echo $total;
    } catch (Exception $e) {

        echo "0";
    }

    }
}

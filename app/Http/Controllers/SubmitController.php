<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lib\RandomString;
use Illuminate\Container\Attributes\Storage;

class SubmitController extends Controller
{
    public function submit(Request $request){

        $fileExtension = $request->file('file')->getClientOriginalExtension();
        $newFileName = new RandomString();
        $newFileName = $newFileName->randomize(6) . '.' . $fileExtension;

        while (file_exists(public_path() . '/file/' . $newFileName)) {
            $newFileName = new RandomString();
            $newFileName = $newFileName->randomize(6) . '.' . $fileExtension;
        }

        
    }
}

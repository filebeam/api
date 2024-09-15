<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubmitController extends Controller
{
    public function submit (Request $request){

        if($this->needsSanitize($request->file('file'))){

        }

        
    }

    private function needsSanitize($extension)
    {
        $required = ['html', 'xhtml', 'php', 'phtml', 'cgi', 'xml', 'js'];
        return in_array($extension, $required);
    }
}

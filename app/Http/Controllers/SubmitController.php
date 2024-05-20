<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lib\RandomString;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SubmitController extends Controller
{
    public function submit(Request $request)
    {

        if (!$request->isMethod('post')) { // Cualquier peticion que no sea POST

            $maxrand = 100;
            $res = rand(0, $maxrand);

            if ($res != 1) {

                return response('Solo se admiten peticiones POST (405)', 405);
            } else {

                return view('noelia');
            }
        } elseif ($request->isMethod('post')) { // Peticion POST  

            if (null != $request->file('file')) {

                $fileTmpName = $request->file('file')->getClientOriginalName();
                $fileName = pathinfo($fileTmpName, PATHINFO_FILENAME);
                $fileExtension = $request->file('file')->getClientOriginalExtension();
                $newFileName = new RandomString();
                $newFileName = $newFileName->randomize(6) . '.' . $fileExtension;

                while (file_exists(public_path() . '/file/' . $newFileName)) {
                    $newFileName = new RandomString();
                    $newFileName = $newFileName->randomize(6) . '.' . $fileExtension;
                }

                $validator = Validator::make($request->all(), [
                    'file' => 'max:100000',
                ]);

                if ($validator->fails()) {
                    return response('El archivo supera el máximo permitido', 413);
                } else {

                    if ($this->isValidExtension($fileExtension)) { // Si es una extension valida

                        if ($this->needsSanitize($fileExtension)) { // Si el archivo requiere ser sanitizado

                            $file = $request->file('file');

                            $purifiedContent = file_get_contents($file->getPathname());
                            $purifiedContent = htmlspecialchars($purifiedContent, ENT_QUOTES | ENT_HTML5);
                            
                            Storage::put('public/' . $newFileName, $purifiedContent);
                            
                            $url = env('APP_URL') . ':8000' . '/file/' . $newFileName;

                            return response($url, 200);
                        } else {

                            $request->file('file')->storeAs('public', $newFileName);

                            $url = env('APP_URL') . ':8000' . '/file/' . $newFileName;

                            return response($url, 200);

                        }
                    } else {

                        return response('Extension de archivo no permitida (400)', 400);
                    }
                }
            } else {
                return response('No se ha enviado ningun archivo (400)', 400);
            }
        }
    }

    private function isValidExtension($extension)
    {

        $blacklist = ['jsp', 'exe', 'jar', 'scr', 'cpl', 'doc', 'docx', 'sh'];

        return !in_array($extension, $blacklist);
    }

    private function needsSanitize($extension)
    {

        $required = ['html', 'xhtml', 'php', 'phtml', 'cgi', 'xml', 'js'];

        return in_array($extension, $required);
    }
}

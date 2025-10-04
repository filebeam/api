<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Lib\ConvertUnit;

class ValidateFile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next): Response
    {

        if(!$request->isMethod('post')){
            return response('Solo se admiten peticiones POST', 405);
        }

        if (!$request->file('file')) {
            return response('No se ha enviado ningun archivo', 400);
        }

        $fileSize = new ConvertUnit();
        $fileSize = $fileSize->byteToMB($request->file('file')->getSize());

        if (!$request->input('time')) {
            $time = 0;
        } else {
            $time = $request->input('time');
        }

        if ($time == 0 && $fileSize > 200) {
            return response('El archivo excede el máximo permitido', 413);
        }

        if ($fileSize > 1024) {
            return response('El archivo excede el máximo permitido', );
        }

        $extension = $request->file('file')->getClientOriginalExtension();

        if (!$this->isValidExtension($extension)){
            return response('Tipo de archivo no admitido', 400);
        }

        if ($request->input('needsSanitize')) {
            $request->request->remove('needsSanitize');
        }

        if ($this->needsSanitize($extension)) {
            $request->merge(['needsSanitize' => true]);
            return next($request);
        }

        $request->merge(['needsSanitize' => false]);
        return $next($request);
    }

    private function isValidExtension($extension)
    {
        $blacklist = ['jsp', 'exe', 'jar', 'scr', 'cpl', 'doc', 'docx', 'sh'];
        return !in_array($extension, $blacklist);
    }

    private function needsSanitize($extension)
    {
        $required = ['html', 'xhtml', 'php', 'phtml', 'cgi', 'xml', 'js', 'json'];
        return in_array($extension, $required);
    }
}

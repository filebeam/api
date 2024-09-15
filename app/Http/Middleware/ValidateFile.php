<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class ValidateFile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!$request->isMethod('POST')) {
            return response("Solo se admiten peticiones POST \n", 405);
        }

        if (!$request->file('file')) {
            return response("No se ha enviado ningun archivo \n", 400);
        }

        $extension = $request->file('file')->getClientOriginalExtension();

        if (!$this->isValidExtension($extension)) {
            return response("Tipo de archivo no admitido \n", 400);
        }

        $fileHash = hash_file('sha256', $request->file('file'));
        $isFileBlocked = DB::select('select * from blacklist where hash = ?', [$fileHash]);

        if ($isFileBlocked) {
            return response("Archivo bloqueado \n", 400);
        }

        $fileSize = $this->byteToMB($request->file('file')->getSize());

        if ($fileSize > 200) {
            return response('El tamaño del archivo excede el maximo permitido', 400);
        }

        return $next($request);
    }

    private function isValidExtension($extension)
    {
        $blacklist = ['jsp', 'exe', 'jar', 'scr', 'cpl', 'doc', 'docx', 'sh'];
        return !in_array($extension, $blacklist);
    }

    private function byteToMB($byte)
    {
        $megabyte = $byte / 1048576;
        return $megabyte;
    }

    private function megabyteToByte($megabyte)
    {
        $byte = $megabyte * 1048576;
        return $byte;
    }
}

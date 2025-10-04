<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lib\RandomString;
use App\Lib\Time;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class SubmitController extends Controller
{
    public function submit(Request $request)
    {

        $fileExtension = $request->file('file')->getClientOriginalExtension();
        $newFileName = new RandomString();
        $newFileName = $newFileName->randomize(6) . '.' . $fileExtension;

        while (file_exists(public_path('public') . '/' . $newFileName)) {
            $newFileName = new RandomString();
            $newFileName = $newFileName->randomize(6) . '.' . $fileExtension;
        }

        if ($request['needsSanitize']) { // Si el archivo requiere ser sanitizado
            $file = $request->file('file');
            $purifiedContent = file_get_contents($file->getPathname());
            $purifiedContent = htmlspecialchars($purifiedContent, ENT_QUOTES | ENT_HTML5);
            Storage::put('.' . $newFileName, $purifiedContent);
            $url = 'https://' . env('APP_URI_BASE') . "/" . $newFileName;
            return response($url, 200);
        }

        $request->file('file')->storeAs('.', $newFileName);
        $fileHash = hash_file('sha256', $request->file('file'));

        $timestamp = new Time();
        $timestamp = $timestamp->getUnixTime();
        $dateTime = new Time();


        # TIEMPOS ADMITIDOS: null (osea tiempo ilimitado), 5m, 30m, 1h, 6h, 12h, 24h
        switch ($request->input('time')) {
            case null:
                # EN CASO DE QUE NO SE ENVÍE NINGUN PARÁMETRO DE TIEMPO (TIEMPO ILIMITADO)
                # SUBIR LOGS
                DB::table('file_logs')->insert([
                    'timestamp' => $timestamp,
                    'date_time' => $dateTime->getDateTime(),
                    'user_agent' => $request->userAgent(),
                    'ip_addr' => $request->ip(),
                    'file_name' => $newFileName,
                    'hash' => $fileHash
                ]);
                break;
            case '5m':
                # SUBIDA DE LOG
                DB::table('file_logs')->insert([
                    'timestamp' => $timestamp,
                    'date_time' => $dateTime->getDateTime(),
                    'user_agent' => $request->userAgent(),
                    'ip_addr' => $request->ip(),
                    'file_name' => $newFileName,
                    'hash' => $fileHash
                ]);

                # SUBIDA DE PARÁMETRO DE TIEMPO
                DB::table('tmp_files')->insert([
                    'file_name' => $newFileName,
                    'sent_time' => $timestamp,
                    'expire_time' => $timestamp + 300,
                ]);
                break;
            case '30m':
                # SUBIDA DE LOG
                DB::table('file_logs')->insert([
                    'timestamp' => $timestamp,
                    'date_time' => $dateTime->getDateTime(),
                    'user_agent' => $request->userAgent(),
                    'ip_addr' => $request->ip(),
                    'file_name' => $newFileName,
                    'hash' => $fileHash
                ]);

                # SUBIDA DE PARÁMETRO DE TIEMPO
                DB::table('tmp_files')->insert([
                    'file_name' => $newFileName,
                    'sent_time' => $timestamp,
                    'expire_time' => $timestamp + 1800,
                ]);

                break;
            case '1h':

                # SUBIDA DE LOG
                DB::table('file_logs')->insert([
                    'timestamp' => $timestamp,
                    'date_time' => $dateTime->getDateTime(),
                    'user_agent' => $request->userAgent(),
                    'ip_addr' => $request->ip(),
                    'file_name' => $newFileName,
                    'hash' => $fileHash
                ]);

                # SUBIDA DE PARÁMETRO DE TIEMPO
                DB::table('tmp_files')->insert([
                    'file_name' => $newFileName,
                    'sent_time' => $timestamp,
                    'expire_time' => $timestamp + 3600,
                ]);

                break;
            case '6h':

                # SUBIDA DE LOG
                DB::table('file_logs')->insert([
                    'timestamp' => $timestamp,
                    'date_time' => $dateTime->getDateTime(),
                    'user_agent' => $request->userAgent(),
                    'ip_addr' => $request->ip(),
                    'file_name' => $newFileName,
                    'hash' => $fileHash
                ]);

                # SUBIDA DE PARÁMETRO DE TIEMPO
                DB::table('tmp_files')->insert([
                    'file_name' => $newFileName,
                    'sent_time' => $timestamp,
                    'expire_time' => $timestamp + 21600,
                ]);

                break;
            case '12h':
                # SUBIDA DE LOG
                DB::table('file_logs')->insert([
                    'timestamp' => $timestamp,
                    'date_time' => $dateTime->getDateTime(),
                    'user_agent' => $request->userAgent(),
                    'ip_addr' => $request->ip(),
                    'file_name' => $newFileName,
                    'hash' => $fileHash
                ]);

                # SUBIDA DE PARÁMETRO DE TIEMPO
                DB::table('tmp_files')->insert([
                    'file_name' => $newFileName,
                    'sent_time' => $timestamp,
                    'expire_time' => $timestamp + 43200,
                ]);
                break;
            case '24h':
                # SUBIDA DE LOG
                DB::table('file_logs')->insert([
                    'timestamp' => $timestamp,
                    'date_time' => $dateTime->getDateTime(),
                    'user_agent' => $request->userAgent(),
                    'ip_addr' => $request->ip(),
                    'file_name' => $newFileName,
                    'hash' => $fileHash
                ]);

                # SUBIDA DE PARÁMETRO DE TIEMPO
                DB::table('tmp_files')->insert([
                    'file_name' => $newFileName,
                    'sent_time' => $timestamp,
                    'expire_time' => $timestamp + 86400,
                ]);
                break;
            default:
                return response('Parámetro tiempo inválido. Subida cancelada.', 400);
        }

        if (!$request->isSecure()) {
            $url = 'http://' . env('APP_URI_BASE') . "/" . $newFileName;
            return response($url, 200);
        }
        $url = 'https://' . env('APP_URI_BASE') . "/" . $newFileName;
        return response($url, 200);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lib\RandomString;
use App\Lib\Time;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SubmitController extends Controller
{
    public function submit(Request $request){

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
        $dateTime = $dateTime->getDateTime();
        $userAgent = $request->userAgent();

        DB::table('file_logs')->insert([
            'timestamp' => $timestamp,
            'date_time' => $dateTime,
            'user_agent' => $request->userAgent(),
            'ip_addr' => $request->ip(),
            'file_name' => $newFileName,
            'hash' => $fileHash
        ]);

        if (!$request->isSecure()) {
        $url = 'http://' . env('APP_URI_BASE') . "/" . $newFileName;
        return response($url, 200);
        }
        $url = 'https://' . env('APP_URI_BASE') . "/" . $newFileName;
        return response($url, 200);

    }
}

<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Storage;
use App\Lib\Time;

Schedule::call(function () {
    //Llamada y velidación de expiración de archivos cada 5 segundos.

    $timestamp = new Time();
    $timestamp = $timestamp->getUnixTime();
    $files = DB::select('select * from tmp_files where expire_time <= ?', [$timestamp]);
    foreach ($files as $file) {
        Storage::delete($file->file_name);
        DB::delete('delete from tmp_files where id_file = ?', [$file->id_file]);
    }
})->everyTenSeconds();

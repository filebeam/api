<?php

namespace App\Lib;

class ConvertUnit
{
    function byteToMB($byte)
    { 
        $megabyte = $byte / 1048576;
        return $megabyte;
    }

    function megabyteToByte($megabyte)
    { 
        $byte = $megabyte * 1048576;
        return $byte;
    }

    // Añadir mas metodos de conversion cuando sean necesarios
}

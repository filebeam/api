<?php

namespace App\Lib;

class ConvertUnit {

    function byteToMB($byte){ // De Byte a MegaByte
        $megabyte = $byte / 1048576; // Formula de conversion: Byte / 1,048,576
        return $megabyte;
    }

    function megabyteToByte($megabyte){ // De MegaByte a Byte
        $byte = $megabyte * 1048576; // Formula de conversion: MByte * 1,048,576
        return $byte;
    }

    // Añadir mas metodos de conversion cuando sean necesarios

}
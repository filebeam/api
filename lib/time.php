<?php 

# Forma mas organizada para obtener el tiempo en todo el proyecto

function getTimestamp(){
    $timestamp = new DateTime();
    $timestamp = $timestamp->getTimestamp(); # Obtiene el timestamp actual (Unix)
    return $timestamp;
}

function getDateTime(){
    $time = date("H:i"); # Formato 24hrs
    $date = date("d/m/Y"); # Formato dia/mes/año
    $dateTime = $time . ", " . $date; # Concatena time + date
    return $dateTime;
}

function getTime($format){ # 12 o 24hrs
    switch($format){
        case 12:
            $time = date("h:i:sa"); # Formato 24 hrs
            break;
        case 24:
            $time = date("H:i");
            break;
        dafault:
            $time = 0;
    }
    return $time;
}
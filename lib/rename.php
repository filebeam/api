<?php

    # Mejorado del randomizado de los nombres aleatorios
    function randomize($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        $maxIndex = strlen($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $maxIndex)];
        }
        return $randomString;
    }
    
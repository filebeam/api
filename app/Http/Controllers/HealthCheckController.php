<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HealthCheckController extends Controller
{
    public function response(Request $request){
        return response("El servidor está funcionando bien", 200);
    }
}

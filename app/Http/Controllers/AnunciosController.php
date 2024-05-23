<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AnunciosController extends Controller
{
    public function getContent(Request $request)
    {
        if ($request->isMethod('GET')) { // Método GET
            $announcements = DB::select('SELECT * FROM announcements ORDER BY id DESC');
            return response()->json($announcements);
        } else {
            return response('Solo se admiten peticiones GET', 400);
        }
    }
}

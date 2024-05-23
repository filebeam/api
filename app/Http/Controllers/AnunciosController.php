<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AnunciosController extends Controller
{
    public function getContent(Request $request)
    {
        $announcements = DB::select('SELECT * FROM announcements ORDER BY id DESC');
        return response()->json($announcements);
    }
}

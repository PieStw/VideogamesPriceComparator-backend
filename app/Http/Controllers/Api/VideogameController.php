<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Videogame;

class VideogameController extends Controller
{
    public function index()
    {
        $videogames = Videogame::all();
        return response()->json([
            "success" => true,
            "data" => $videogames
        ]);
    }


    public function show(Videogame $videogame)
    {
        $videogame->load(['genres', 'platforms']);
        return response()->json([
            "success" => true,
            "data" => $videogame
        ]);
    }

    public function getByName($name)
    {
        $videogames = Videogame::where('title', 'like', '%' . $name . '%')->get();

        return response()->json([
            "success" => true,
            "data" => $videogames
        ]);
    }
}

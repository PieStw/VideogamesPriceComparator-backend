<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Videogame;
use Illuminate\Http\Request;

class VideogameController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->all();

        if (isset($data['name'])) {
            $videogames = Videogame::where('title', 'like', '%' . $data["name"] . '%');
        } else {
            $videogames = Videogame::query();
        }

        $pageSize = $request->input('page_size', 20);

        $videogames = $videogames->paginate($pageSize);

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
}

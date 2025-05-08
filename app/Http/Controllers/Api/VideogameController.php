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

        $pageSize = $request->input('page_size', 21);

        $videogames = $videogames->paginate($pageSize);

        return response()->json([
            "success" => true,
            "data" => $videogames->items(),
            "pagination" => [
                "total" => $videogames->total(),
                "per_page" => $videogames->perPage(),
                "current_page" => $videogames->currentPage(),
                "last_page" => $videogames->lastPage(),
                "next_page_url" => $videogames->nextPageUrl(),
                "prev_page_url" => $videogames->previousPageUrl(),
            ]
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


    public function bestseller()
    {
        $videogames = Videogame::orderBy('rating', 'desc')->take(20)->get();
        return response()->json([
            "success" => true,
            "data" => $videogames
        ]);
    }
}

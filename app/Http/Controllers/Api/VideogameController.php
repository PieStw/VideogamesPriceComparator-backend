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
        $pageSize = $request->input('page_size', 21);

        $query = Videogame::with(['genres', 'platforms']);

        if (!empty($data['name'])) {
            $query->where('title', 'like', '%' . $data["name"] . '%');
        }

        if (!empty($data['genre'])) {
            $query->whereHas('genres', function ($q) use ($data) {
                $q->where('genres.id', '=', $data['genre']);
            });
        }

        if (!empty($data['platform'])) {
            $query->whereHas('platforms', function ($q) use ($data) {
                $q->where('platforms.id', '=', $data['platform']);
            });
        }

        $videogames = $query->paginate($pageSize);

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

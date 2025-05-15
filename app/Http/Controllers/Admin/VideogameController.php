<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Platform;
use App\Models\Videogame;
use Illuminate\Http\Request;

class VideogameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videogames = Videogame::all();
        return view('videogames.index', compact('videogames'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all();
        $platforms = Platform::all();
        return view('videogames.create', compact('genres', 'platforms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $videogame = new Videogame();
        $videogame->title = $data['title'];
        $videogame->description = $data['description'];
        $videogame->release_date = $data['release_date'];
        $videogame->image_url = "https://placehold.co/600x400";
        $videogame->rating = $data['rating'];
        $videogame->save();

        if (isset($data['genres'])) {
            $videogame->genres()->attach($data['genres']);
        }
        if (isset($data['platforms'])) {
            $videogame->platforms()->attach($data['platforms']);
        }
        return redirect()->route('videogames.index')->with('success', 'Videogame created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Videogame $videogame)
    {
        $videogame->load('genres', 'platforms');
        return view('videogames.show', compact('videogame'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Videogame $videogame)
    {
        $genres = Genre::all();
        $platforms = Platform::all();
        return view('videogames.edit', compact('videogame', 'genres', 'platforms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Videogame $videogame)
    {
        $data = $request->all();

        $videogame->title = $data['title'];
        $videogame->description = $data['description'];
        $videogame->release_date = $data['release_date'];
        $videogame->rating = $data['rating'];
        $videogame->image_url = $data['image_url'] ?? "https://placehold.co/600x400";
        $videogame->save();

        if ($request->has('genres')) {
            $videogame->genres()->sync($data['genres']);
        } else {
            $videogame->genres()->detach();
        }

        if ($request->has('platforms')) {
            $videogame->platforms()->sync($data['platforms']);
        } else {
            $videogame->platforms()->detach();
        }

        return redirect()->route('videogames.index')->with('success', 'Videogame edit successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $videogame = Videogame::findOrFail($id);
        $videogame->delete();

        return redirect()->route('videogames.index')->with('success', 'Videogame deleted successfully.');
    }

    public function searchVideogames(Request $request)
    {
        $query = $request->input('search');
        $videogames = Videogame::where('title', 'LIKE', "%$query%")->get();

        return view('videogames.index', compact('videogames'));
    }
}

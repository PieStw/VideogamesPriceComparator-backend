<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class GenreSeeder extends Seeder
{

    public function getGenres()
    {

        $response = Http::get('https://api.rawg.io/api/genres', [
            'key' => env('API_KEY'),
            'page_size' => 30,
            'page' => 1,
        ]);

        return $response->json()['results'];
    }

    public function run(): void
    {
        $genres = $this->getGenres();

        foreach ($genres as $genre) {
            $newGenre = new Genre();
            $newGenre->id = $genre['id'];
            $newGenre->name = $genre['name'];
            $newGenre->save();
        }
    }
}

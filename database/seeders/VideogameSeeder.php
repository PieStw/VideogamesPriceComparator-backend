<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Videogame;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class VideogameSeeder extends Seeder
{

    public function getGames()
    {

        $response = Http::get('https://api.rawg.io/api/games', [
            'key' => env('API_KEY'),
            'page_size' => 40,
            'page' => 2,
        ]);

        return $response->json()['results'];
    }


    public function run(): void
    {

        $games = $this->getGames();

        foreach ($games as $game) {

            $data = Http::get('https://api.rawg.io/api/games/' . $game['id'], [
                'key' => env('API_KEY'),
            ])->json();

            $game = new Videogame();
            $game->title = $data['name'];
            $game->release_date = $data['released'];
            $game->description = $data['description_raw'];
            $game->image_url = $data['background_image'];
            $game->rating = $data['rating'];


            $game->save();

            if (isset($data['genres'])) {
                $genreIds = collect($data['genres'])->pluck('id')->toArray();

                $game->genres()->attach($genreIds);
            }

            if (isset($data['platforms'])) {
                $platformIds = collect($data['platforms'])->pluck('platform.id')->toArray();

                $game->platforms()->attach($platformIds);
            }
        }
    }
}

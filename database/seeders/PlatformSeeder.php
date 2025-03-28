<?php

namespace Database\Seeders;

use App\Models\Platform;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class PlatformSeeder extends Seeder
{
    public function getGenres()
    {

        $response = Http::get('https://api.rawg.io/api/platforms', [
            'key' => env('API_KEY'),
            'page_size' => 30,
            'page' => 2,
        ]);

        return $response->json()['results'];
    }

    public function run(): void
    {
        $platforms = $this->getGenres();

        foreach ($platforms as $platform) {
            $newPlatform = new Platform();
            $newPlatform->id = $platform['id'];
            $newPlatform->name = $platform['name'];
            $newPlatform->image_background = $platform['image_background'];
            $newPlatform->save();
        }
    }
}

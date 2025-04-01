<?php

use App\Http\Controllers\Api\VideogameController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('/api/videogames', VideogameController::class);

Route::get('/api/videogames/bestseller', [VideogameController::class, 'bestseller']);

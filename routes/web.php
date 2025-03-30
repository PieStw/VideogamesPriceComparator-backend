<?php

use App\Http\Controllers\Admin\VideogameController;
use App\Http\Controllers\Api\VideogameController as ApiVideogameController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/videogames/search', [VideogameController::class, 'searchVideogames'])
    ->middleware(['auth', 'verified'])
    ->middleware(Admin::class)
    ->name('videogames.searchVideogames');

Route::resource("/videogames", VideogameController::class)
    ->middleware(['auth', 'verified'])
    ->middleware(Admin::class);


Route::resource('/api/videogames', ApiVideogameController::class);


require __DIR__ . '/auth.php';

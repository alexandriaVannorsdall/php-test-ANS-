<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;

Route::get('/', [PokemonController::class, 'index'])
    ->middleware(['auth'])
    ->name('pokemon.index');

Route::get('/pokemon/{name}', [PokemonController::class, 'show'])
    ->middleware(['auth'])
    ->name('pokemon.show');
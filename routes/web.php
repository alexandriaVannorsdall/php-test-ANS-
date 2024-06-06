<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;

Route::get('/', [PokemonController::class, 'index'])->name('pokemon.index');
Route::get('/pokemon/{name}', [PokemonController::class, 'show'])->name('pokemon.show');
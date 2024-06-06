<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PokemonController extends Controller
{
    public function index(Request $request)
    {
        // Fetch entire list of Pokemon
        $pokemons = collect(Http::get('https://pokeapi.co/api/v2/pokemon?limit=151')->json()['results']);

        if ($search = $request->query('search')) {
            // Filter the collection based on the search term.
            $pokemons = $pokemons->filter(function ($pokemon) use ($search) {
                // Use 'stripos' for case-insensitive search.
                return false !== stripos($pokemon['name'], $search);
            });
        }
        // Pass collection to the view
        return view('pokemon.index', compact('pokemons'));
    }

    public function show($name)
    {
        // Fetch a specific Pokemon
        $pokemon = Http::get("https://pokeapi.co/api/v2/pokemon/{$name}")->json();

        // Pass specific Pokemon to view
        return view('pokemon.show', compact('pokemon'));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PokemonController extends Controller
{
    /**
     * Retrive and display a list of Pokemon
     * 
     * Fetches a list of Pokemon from an external API with a specific limit. 
     * Optionally filters the list by a search term provided in the request query. 
     * If the API request fails, it aborts with a 404 HTTP response. 
     *
     * @param Request $request
     * @return view
     */
    public function index(Request $request) 
    {
    // Fetch entire list of Pokemon with a certain limit
    $response = Http::get('https://pokeapi.co/api/v2/pokemon', [
        'limit' => 151,
    ]);
   
    if ($response->failed()) {
        abort(404);
    }

    $pokemons = collect($response->json()['results']);

    if ($search = $request->query('search')) {
        $pokemons = $pokemons->filter(function ($pokemon) use ($search) {
            // Check if the name starts with the search term using strpos.
            return strpos(strtolower($pokemon['name']), strtolower($search)) === 0;
        });
    }

    return view('pokemon.index', compact('pokemons'));
}


    /**
     * Display the detials of a specific Pokemon
     * 
     * Fetches the data for a single Pokemon identified by name from the external API
     * and passes it to the view. If the requested Pokemon is not found or if the API
     * request fails, a 404 HTTP response will be triggered.
     *
     * @param string $name
     * @return view
     */
    public function show($name)
    {
        // Fetch a specific Pokemon
        $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$name}");

        if ($response->failed()) {
            abort(404);
        }
        
        $pokemon = $response->json();

        // Pass specific Pokemon to view
        return view('pokemon.show', compact('pokemon'));
    }
}
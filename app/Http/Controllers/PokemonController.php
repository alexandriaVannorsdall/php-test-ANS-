<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PokemonService;

class PokemonController extends Controller
{
    protected $pokemonService;

    public function __construct(PokemonService $pokemonService)
    {
        $this->pokemonService = $pokemonService;
    }

    /**
     * Retrieve and display a list of Pokemon.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $pokemons = $this->pokemonService->fetchAllPokemons();

        if ($search = $request->query('search')) {
            $pokemons = $this->pokemonService->searchPokemons($pokemons, $search);
        }

        return view('pokemon.index', compact('pokemons'));
    }

    /**
     * Display the details of a specific Pokemon.
     *
     * @param string $name
     * @return \Illuminate\View\View
     */
    public function show($name)
    {
        $pokemon = $this->pokemonService->fetchPokemonByName($name);

        return view('pokemon.show', compact('pokemon'));
    }
}
<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;

class PokemonService
{
    /**
     * @var string
     */
    private $baseUrl = 'https://pokeapi.co/api/v2/pokemon';

    /**
     * Fetch a list of Pokemon with their names and URLS from the API.
     * 
     * This method sends a GET request to the Pokemon API to fetch a list 
     * of Pokemon and limits the number to 1025.
     *
     * @param integer $limit
     * @return Collection
     */
    public function fetchAllPokemons($limit = 1025): Collection
    {
        $response = Http::get($this->baseUrl, [
            'limit' => $limit,
        ]);
    
        if ($response->failed()) {
            abort(404, 'Failed to fetch Pokémon data.');
        }
    
        $pokemons = collect($response->json()['results'])->map(function ($pokemon) {
            return [
                'name' => $pokemon['name'],
                'url' => $pokemon['url'],
            ];
        });
    
        return $pokemons;
    }

    /**
     * Search for a Pokemone in a given collection by name. 
     * 
     * Filters the provided Pokemon collection, returning only those whose names start
     * with the specified search string.
     *
     * @param Collection $pokemons
     * @param string $search
     * @return Collection
     */
    public function searchPokemons(Collection $pokemons, string $search): Collection
    {
        return $pokemons->filter(function ($pokemon) use ($search) {
            return strpos(strtolower($pokemon['name']), strtolower($search)) === 0;
        });
    }

    /**
     * Fetch details of a specific Pokémon by its name.
     * 
     * This method sends a GET request to the Pokémon API to fetch detailed information 
     * about a particular Pokémon identified by its name. 
     * If the request fails, it will abort the operation and return a 404 error.
     *
     * @param string $name
     * @return void
     */
    public function fetchPokemonByName(string $name)
    {
        $response = Http::get("{$this->baseUrl}/{$name}");

        if ($response->failed()) {
            abort(404, 'Failed to fetch specific Pokémon.');
        }
    
        $pokemonData = $response->json();
    
        // Check if abilities exist and are an array
        $abilities = [];
        if (isset($pokemonData['abilities']) && is_array($pokemonData['abilities'])) {
            $abilities = array_map(function ($abilityInfo) {
                return $abilityInfo['ability']['name'];
            }, $pokemonData['abilities']);
        }
    
        return [
            'sprites' => $pokemonData['sprites'],
            'species' => $pokemonData['species'],
            'name' => $pokemonData['name'],
            'height' => $pokemonData['height'],
            'weight' => $pokemonData['weight'],
            'types' => array_map(function ($typeInfo) {
                return $typeInfo['type']['name'];
            }, $pokemonData['types']),
            'abilities' => $abilities,
        ];
    }
}
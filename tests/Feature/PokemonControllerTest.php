<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class PokemonControllerTest extends TestCase
{
    /** @test */
    public function index_returns_successful_response_with_all_pokemons()
    {
        Http::fake([
            'https://pokeapi.co/api/v2/pokemon*' => Http::response(['results' => [
                ['name' => 'bulbasaur', 'url' => 'http://example.com/pokemon/1'],
                ['name' => 'ivysaur', 'url' => 'http://example.com/pokemon/2'],
                ['name' => 'venusaur', 'url' => 'http://example.com/pokemon/3'],
                ['name' => 'charmander', 'url' => 'http://example.com/pokemon/4'],
                ['name' => 'charmeleon', 'url' => 'http://example.com/pokemon/5'],
            ]], 200),
        ]);

        $response = $this->get(route('pokemon.index'));

        $response->assertStatus(200);
        $response->assertViewIs('pokemon.index');
        $response->assertViewHas('pokemons');
    }

      /** @test */
      public function index_returns_filtered_pokemons_based_on_search_query()
      {
          Http::fake([
              'https://pokeapi.co/api/v2/pokemon*' => Http::response(['results' => [
                  ['name' => 'bulbasaur', 'url' => 'http://example.com/pokemon/1'],
                  ['name' => 'ivysaur', 'url' => 'http://example.com/pokemon/2'],
              ]], 200),
          ]);
  
          $searchTerm = 'bulb';
          $response = $this->get(route('pokemon.index', ['search' => $searchTerm]));
  
          $response->assertStatus(200);
          $response->assertViewHas('pokemons', function ($viewPokemons) use ($searchTerm) {
              // Assert that the collection has been filtered based on search term
              return $viewPokemons->contains(function ($pokemon) use ($searchTerm) {
                  return stripos($pokemon['name'], $searchTerm) !== false;
              });
          });
      }
  
      /** @test */
      public function show_it_returns_successful_response_with_specific_pokemon()
      {
          $pokemonName = 'pikachu'; 
       
          // Prepare mock Pokemon data based on the structure used in the Blade view
          $mockPokemonData = [
              'name' => $pokemonName,
              'sprites' => [
                  'front_default' => 'http://example.com/sprite.png',
              ],
              'species' => [
                  'name' => 'pikachu-species',
              ],
              'height' => 4,
              'weight' => 60,
              'abilities' => [
                  [
                      'ability' => ['name' => 'static'],
                  ],
                  [
                      'ability' => ['name' => 'lightning-rod'],
                  ],
              ],
          ];
       
          Http::fake([
              "https://pokeapi.co/api/v2/pokemon/{$pokemonName}" => Http::response($mockPokemonData, 200)
          ]);
       
          $response = $this->get(route('pokemon.show', ['name' => $pokemonName]));
          $response->assertStatus(200);
      
          $response->assertViewIs('pokemon.show');
          
          $response->assertViewHas('pokemon', function ($viewPokemon) use ($mockPokemonData) {
              return $viewPokemon == $mockPokemonData;
          });
      }
      
}
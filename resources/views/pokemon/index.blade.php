@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Pokédex</h1>
    <form method="GET" action="{{ route('pokemon.index') }}">
        <input type="text" name="search" placeholder="Search for a Pokémon">
        <button type="submit">Search</button>
    </form>

    <ul>
        @foreach ($pokemons as $pokemon)
        <li><a href="{{ route('pokemon.show', ['name' => $pokemon['name']]) }}">{{ $pokemon['name'] }}</a></li>
        @endforeach
    </ul>
</div>
@endsection
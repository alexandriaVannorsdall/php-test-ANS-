@extends('layouts.app')

@section('content')
<div class="container">
    <h2 style="color:black;">{{ $pokemon['name'] }}</h2>
    <img src=" {{ $pokemon['sprites']['front_default'] }}" alt="{{ $pokemon['name'] }}">
    <p>Species: {{ $pokemon['species']['name'] }}</p>
    <p>Height: {{ $pokemon['height'] }}</p>
    <p>Weight: {{ $pokemon['weight'] }}</p>
    <h3>Abilities</h3>
    <ul>
        @foreach ($pokemon['abilities'] as $ability)
        <li>{{ $ability['ability']['name'] }}</li>
        @endforeach
    </ul>
    <a href="{{ route('pokemon.index') }}">Back to Pokédex</a>
</div>
@endsection
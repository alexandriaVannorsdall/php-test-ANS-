@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Pokédex</h1>
    <form id="searchForm" method="GET" action="{{ route('pokemon.index') }}">
        <input type="text" name="search" id="searchInput" placeholder="Search for a Pokémon">
        <div id="validationMessage" style="color: red;"></div>
        <button type="submit">Search</button>
    </form>

    <ul>
        @foreach ($pokemons as $pokemon)
        <li><a href="{{ route('pokemon.show', ['name' => $pokemon['name']]) }}">{{ $pokemon['name'] }}</a></li>
        @endforeach
    </ul>
    <a href="{{ route('pokemon.index') }}">Back to Pokédex</a>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('searchForm');
    const searchInput = document.getElementById('searchInput');
    const validationMessage = document.getElementById('validationMessage');

    searchForm.addEventListener('submit', function(event) {
        const value = searchInput.value;
        // Regular expression to match only alphabetic characters
        if (/^[a-zA-Z]*$/.test(value)) {
            // Clear any previous validation messages
            validationMessage.textContent = '';
        } else {
            // Prevent the form from submitting
            event.preventDefault();
            // Show validation message
            validationMessage.textContent = 'Please enter only letters.';
        }
    });
});
</script>
@endsection
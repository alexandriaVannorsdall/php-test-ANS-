# ans/pokédex

**This project will be based primarily on your ability to fulfill the task 
requirements. Any potential design skills are a bonus, but usability, 
performance and security will be taken into account.**


## Introduction
This project provides a starting point which will allow you to create your own 
web-based encyclopedia based on the popular franchise Pokémon - also known as 
a pokédex.


## Project Requirements
To get started, you'll need the following installed:
- PHP
- Composer
- Git
 
You are free to use whatever PHP packages and front-end libraries that you wish. We suggest to use the latest available version of Laravel. You are also welcome to use any CSS framework, like Tailwind.


## Task Requirements

For this challenge we require a web app in the form of a pokédex, allowing users
the ability to search for and display information for a specific pokémon.

A RESTful API is available at [Pokéapi](https://pokeapi.co/) which will 
provide you with all the data that you will need. You do not need to create 
an account nor authenticate in order to consume the API, however please 
be aware that this API is rate-limited.
 
To get started, we have provided a skeleton folder structure, please create a 
fork of this repository either here on gitlab or via another public repository like github.

We recommend that you spend no more than two hours on this challenge, 
we are more interested in how you approach the task than spending lots of time on it.


### User Stories

| As an <type of user> | I want to <perform some task> | so that I can <achieve some goal> |
|---|---|---|
| End User | Search for a specific pokémon  | Improve my knowledge of pokémon abilities for my next Gym battle |


### Acceptance Criteria

| GIVEN | WHEN | THEN |
|---|---|---|
| I am on a main pokédex page | The page loads | I can see a full list of available pokémon |
| ^ | ^ | I can see a search form to enter a name of a pokemon to filter the full list |
| ^ | I enter a name AND search | I can see a filtered list of matching results |
| ^ | I can click an entry in the list | I am redirected to an overview page for the selected pokémon |
| I am on the pokémon overview page | The page loads | I can see an image, name, species, height/weight and any abilities |
| ^ | ^ | I can see a link back to the main page |

 
## Submission
When you are aready to submit, please ensure you have forked this repository, no merge/pull request is required,
and provide us a link to your attempt.


## Copyright
All trademarks are the property of their respective owners.

----------------------------------------------------------------------
## Notes from Developer
I decided to focus on usability, security, and validation over design. 
I have added tests to test the index and show methods in the PokemonControllerTest.

I have also tested the API using Postman using the follow URLs:
- To get the entire list of Pokemon: https://pokeapi.co/api/v2/pokemon?limit=151
- To get a specific Pokemon: https://pokeapi.co/api/v2/pokemon/magmar

## Some features I could have done: 
- Style: whether that be through a CSS sheet I imported on the blade files or tailwind. 
- Validate that the user has typed in only a Pokemon name. (I decided against this for time reasons and how many people don't have any issues spelling Pokemon?)
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pokemon;

class PokemonController extends Controller
{
    public function allPokemon() {
        return Pokemon::getAll();
    }

    
}


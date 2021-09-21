<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NavController extends Controller
{
    public function all() {
        $pokemons = Http::get('http://192.168.33.21/all');
        return view('all',['pokemons' => $pokemons->json()]);
    }

    public function getOne($pokedex) {
        $pokemon = Http::get("http://192.168.33.21/pokemon/{$pokedex}");
        dd($pokemon);
    }
}

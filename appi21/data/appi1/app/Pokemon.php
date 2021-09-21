<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    protected $table = 'pokemons'; 
    public static function getAll() {
        return Pokemon::all();
    }
}

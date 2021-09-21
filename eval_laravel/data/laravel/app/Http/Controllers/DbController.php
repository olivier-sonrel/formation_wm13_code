<?php

namespace App\Http\Controllers;

use App\Animal;
use App\Specie;
use Illuminate\Http\Request;

class DbController extends Controller
{
    // -------------------animal--------------------
    public function addAnimal(Request $request) {
        Animal::add($request);
        return redirect('/liste');
    }

    public function delAnimal(Request $request) {
        Animal::del($request);
        return redirect('/liste');
    }

    
    public function updateAnimal(Request $request) {
        Animal::updata($request);
        return redirect('/liste');
    }

    // -------------------specie--------------------
    
    public function addSpecie(Request $request) {
        Specie::add($request);
        return redirect('/addSpecie');
    }

    public function delSpecie(Request $request) {
        Specie::del($request);
        return redirect('/addSpecie');
    }

    public function updateSpecie(Request $request) {
        Specie::updata($request);
        return redirect('/addSpecie');
    }
}

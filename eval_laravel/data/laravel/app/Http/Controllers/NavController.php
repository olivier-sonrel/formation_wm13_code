<?php

namespace App\Http\Controllers;

use App\Animal;
use App\Specie;
use Illuminate\Http\Request;

class NavController extends Controller
{
    public function home(){
        return view('home');
    }

    public function liste(){
        return view('liste', ['animals'=> Animal::getAll()]);
    }

    public function addAnimal(){ 
        return view('addAnimal', ['species'=> Specie::getAll()]);
    }

    public function addSpecie(){ 
        return view('addspecie', ['species' => Specie::getAll()]);
    }

    public function updateSpeciePage(Request $request){
        return view('updatespecie', ['specie'=> Specie::choose($request)]);
    }

    public function updateAnimalPage(Request $request){
        return view('updateanimal', ['animal'=> Animal::choose($request), 'species' => Specie::getAll()]);
    }
}

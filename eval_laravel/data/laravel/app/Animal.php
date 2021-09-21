<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    public static function getAll(){
        return Animal::all();
    }

    public static function add($request){
        $animal = new Animal;
        $animal->name = $request->name;
        $animal->age = $request->age;
        $animal->description = $request->description;
        $animal->sexe = $request->sexe;
        $animal->weight = $request->weight;
        $animal->specie_id = $request->specie_id;
        $animal->save();

        return;
    }

    public static function choose($request){
       return Animal::find($request->id);
    }

    public static function updata($request){
        // dd($request);
        $animal = Animal::find($request->id);
        $animal->name = $request->name;
        $animal->age = $request->age;
        $animal->description = $request->description;
        $animal->sexe = $request->sexe;
        $animal->weight = $request->weight;
        $animal->specie_id = $request->specie_id;
        $animal->save();
        return;
    }

    public static function del($request){  
        $animal = Animal::find($request->id);
        $animal->delete();
        return;
    }

    public function specie(){
        return $this->belongsTo('App\Specie');
    }
}

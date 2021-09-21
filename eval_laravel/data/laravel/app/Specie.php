<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specie extends Model
{
    public static function getAll(){
        return Specie::all()->sortBy('name');
    }

    public static function add($request){
        $specie = new Specie;
        $specie->name = $request->name;
        $specie->save();
        return;
    }

    public static function updata($request){
        $specie = Specie::find($request->id);
        $specie->name = $request->name;
        $specie->save();
        return;
    }

    public static function choose($request){
        return Specie::find($request->id);
     }

    public static function del($request){     
        Specie::destroy($request->id);
        return;
    }
}

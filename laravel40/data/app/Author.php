<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public static function getAll(){//OK
        return Author::all()->sortBy('name');
    }

    public static function add($request){//OK
        $author = new Author;
        $author->name = $request->name;
        $author->save();
        return;
    }

    public static function up($request){
        $author = Author::find($request->id); //equivalent $author = SELF(ou author)::choose($request);
        $author->name = $request->name;
        $author->save();
        return;
    }

    public static function choose($request){
        return Author::find($request->id);
     }

    public static function del($request){     
        Author::destroy($request->id);
        return;
    }
}

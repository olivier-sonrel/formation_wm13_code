<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    public static function getAll(){
        return Genre::all()->sortBy('name');
    }

    public static function add($request){//OK
        $genre = new Genre;
        $genre->name = $request->name;
        $genre->save();
        return;
    }

    public static function up($request){
        $genre = Genre::find($request->id); //equivalent $genre = SELF(ou Genre)::choose($request);
        $genre->name = $request->name;
        $genre->save();
        return;
    }

    public static function choose($request){
        return Genre::find($request->id);
     }

    public static function del($request){     
        Genre::destroy($request->id);
        return;
    }

    public static function addBook($request){
        // $bookGenre = new BookGenre;
        // $bookGenre->book_id = $request->book_id;
        // $bookGenre->genre_id = $request->genre_id;
        // $bookGenre->save();
        // dd($bookGenre);
    }

    public function books(){
        return $this->belongsToMany('App\Book');
    }
}

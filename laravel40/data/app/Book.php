<?php

namespace App;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public static function getAll(){
        return Book::all();
    }

    public static function add($request){
        $book = new Book;
        $book->title = $request->title;
        $book->author_id = $request->author_id;  // TO DO
        $book->description = $request->description;
        $book->year = $request->year;
        $book->save();

        foreach ( $request->genres as $genreId) {
            $book->genres()->attach($genreId);
        }
        return;
    }

    public static function choose($request){
       return Book::find($request->id);
    }

    public static function up($request){
        // dd($request);
        $book = Book::find($request->id); //equivalent $book = SELF(ou Book)::choose($request);
        $book->title = $request->title;
        $book->author_id = $request->author_id; // TO DO     
        $book->description = $request->description;
        $book->year = $request->year;
        $book->save();
        $book->genres()->detach();
        foreach ( $request->genres as $genreId) {
            $book->genres()->attach($genreId);
        }
        // book->genres()->atach($request->genre);  // again an other way but with detach before
        // $book->genres()->sync($request->genre);    //other way to do it
        return;
    }

    public static function del($request){  
        $book = Book::find($request->id);
        $book->genres()->detach();
        $book->delete();
        return;
    }

    public static function unsetGenre($request){
        // dd($request);
            $book = Book::find($request->book_id);
            $book->genres()->detach($request->genre_id);
        return;
    }

    public function author(){
        return $this->belongsTo('App\Author');
    }

    public function genres(){
        return $this->belongsToMany('App\Genre');
    }


}

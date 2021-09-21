<?php

namespace App\Http\Controllers;

use App\Book;
use App\Genre;
use App\BookGenre;
use App\Author;
use Illuminate\Http\Request;

class SwitchController extends Controller
{
    public function addBook(Request $request) {
        Book::add($request);
        return redirect('/listing');
    }

    public function delBook(Request $request) {
        Book::del($request);
        return redirect('/listing');
    }

    
    public function upBook(Request $request) {
        Book::up($request);
        return redirect('/listing');
    }

    // -------------------author--------------------
    
    public function addAuthor(Request $request) {
        Author::add($request);
        return redirect('/addAuthor');
    }

    public function delAuthor(Request $request) {
        Author::del($request);
        return redirect('/addAuthor');
    }

    public function upAuthor(Request $request) {
        Author::up($request);
        return redirect('/addAuthor');
    }

    // -------------------genre--------------------

    public function putBookInGenre(Request $request){
        Genre::addBook($request);
        return redirect('/addGenre');
    }

    public function unsetGenre(Request $request){
        Book::unsetGenre($request);
        return redirect('/listing');
    }
    

}

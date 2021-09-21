<?php

namespace App\Http\Controllers;

use App\Book;
use App\Genre;
use App\Author;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class NavController extends Controller
{
    public function home(){
        return view('home');
    }

    public function listing(){
        return view('listing', ['books'=> Book::getAll()]);
    }

    public function ajout(){ 
        return view('ajout', ['authors'=> Author::getAll()], ['genres' => Genre::getAll()]);
    }

    public function addAuthor(){ 
        return view('addauthor', ['authors' => Author::getAll()]);
    }

    public function addGenre(){ 
        return view('add_genre', ['genres' => Genre::getAll()], ['books'=> Book::getAll()]);
    }

    public function upAuthorPage(Request $request){
        return view('updateauthor', ['author'=> Author::choose($request)]);
    }

    public function upBookPage(Request $request){
        return view('update', ['book'=> Book::choose($request), 'genres' => Genre::getAll(), 'authors' => Author::getAll()]);
    }

    public function contact(){
        return view('contact');
    }

    public function error(){
        return view('errors.404');
    }
}

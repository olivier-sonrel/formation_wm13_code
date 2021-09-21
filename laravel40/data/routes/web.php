<?php

use Illuminate\Support\Facades\Route;
use App\Book;
use App\Http\Controllers\SwitchController;
use GuzzleHttp\Psr7\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('home', ['name' => 'Bouffon']);
// });

Route::get('/','NavController@home');
Route::get('/listing','NavController@listing');
Route::get('/contact','NavController@contact');

Route::get('/addAuthor','NavController@addAuthor');
Route::post('/addAuthor','SwitchController@addAuthor');

Route::get('/addGenre','NavController@addGenre');
Route::post('/putBookInGenre','SwitchController@putBookInGenre');
Route::post('/unsetGenre', 'SwitchController@unsetGenre');

Route::post('/upAuthorPage','NavController@upAuthorPage');
Route::post('/upAuthor','SwitchController@upAuthor');
Route::post('/delAuthor', 'SwitchController@delAuthor');

Route::get('/addBook','NavController@ajout');
Route::post('/addBook','SwitchController@addBook');

Route::post('/delBook', 'SwitchController@delBook');

Route::post('/upBookPage','NavController@upBookPage');
Route::post('/upBook','SwitchController@upBook');

//Route::any('/{any}','NavController@error'); // renvoi sur nav error si reste des routes ne passe pas





// Route::post('/ajout/{auteur}/{nbrPages}', function ($auteur, $nbrPages) {
//     return view('ajout', ['auteur' => $auteur, 'nbrPages' => $nbrPages]);
// });

// Route::get('/contact', function () {
//     return view('contact');
// });

// Route::get('/listing', function () {
//     return view('listing');
// });

// Route::get('/test', function () {
//     return view('test');
// });
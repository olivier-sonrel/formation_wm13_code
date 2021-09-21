<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});



// Route::get('/contact', 'NavController@index')->name('contact')->middleware('auth');
// Route::get('/prout', 'NavController@index')->name('prout')->middleware('auth');
// Route::get('/gland', 'NavController@index')->name('gland')->middleware('auth');

Route::get('/contact', 'NavController@index')->name('contact');
Route::get('/prout', 'NavController@index')->name('prout');
Route::get('/gland', 'NavController@index')->name('gland');
// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Auth::routes();

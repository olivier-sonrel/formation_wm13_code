<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/','NavController@home');
Route::get('/liste','NavController@liste');

Route::get('/addSpecie','NavController@addSpecie');
Route::post('/addSpecie','DbController@addSpecie');

Route::post('/updateSpeciePage','NavController@updateSpeciePage');
Route::post('/updateSpecie','DbController@updateSpecie');
Route::post('/delSpecie', 'DbController@delSpecie');

Route::get('/addAnimal','NavController@addAnimal');
Route::post('/addAnimal','DbController@addAnimal');

Route::post('/delAnimal', 'DbController@delAnimal');

Route::post('/updateAnimalPage','NavController@updateAnimalPage');
Route::post('/updateAnimal','DbController@updateAnimal');

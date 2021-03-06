<?php

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

Route::post('/submit', 'EntryController@submit');

Route::post('/user', 'EntryController@user');

Route::post('/game-progress', 'GameController@store');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

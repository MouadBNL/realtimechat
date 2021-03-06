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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/chat', 'MessageController@index')->name('chat');
Route::get('/chat/api/fetch', 'MessageController@fetchAllMessages')->name('chat.fetch');
Route::post('/chat/api/store', 'MessageController@store')->name('chat.store');


Route::get('/test', 'MessageController@test');
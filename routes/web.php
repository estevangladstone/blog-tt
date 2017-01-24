<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/blog', 'PostController@index');
Route::get('/blog/post/create', 'PostController@create');
Route::post('/blog/post/create', 'PostController@store')->name('createPost');

Route::get('/chat', 'ChatController@index');
Route::get('/chat/get-messages', 'ChatController@getMessages');
Route::post('/chat/send-message', 'ChatController@sendMessage');
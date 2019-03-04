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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', 'PostsController@index');

Route::get('/posts/add', 'PostsController@create');
Route::post('/posts/add', 'PostsController@store');
Route::get('/posts/edit/{id}', 'PostsController@edit');
Route::post('/posts/edit/{id}', 'PostsController@update');
Route::get('/posts/view/{id}', 'PostsController@show');
Route::post('/posts/delete/{id}', 'PostsController@destroy');

Route::get('/tags', 'TagsController@index');

Route::get('/tags/add', 'TagsController@create');
Route::post('/tags/add', 'TagsController@store');
Route::get('/tags/edit/{id}', 'TagsController@edit');
Route::post('/tags/edit/{id}', 'TagsController@update');
Route::get('/tags/view/{id}', 'TagsController@show');
Route::post('/tags/delete/{id}', 'TagsController@destroy');


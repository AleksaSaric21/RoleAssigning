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

Route::get('/admin','AppController@admin')->middleware('role:admin');
Route::patch('/admin/toggleModeratorRole/{user}','AppController@moderatorRole')->middleware('role:admin');
Route::patch('/admin/toggleAuthorRole/{user}','AppController@AuthorRole')->middleware('role:admin');

Auth::routes();

Route::get('/home', 'AppController@index')->name('home');

require base_path('routes/web-includes/tasks.php');



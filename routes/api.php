<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login','Api\UsersController@login');
Route::post('/register','Api\UsersController@register');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/users','Api\UsersController@index');
Route::get('/tasks', 'Api\TasksController@index')->middleware('auth:api');
Route::post('/users/moderator/{user}', 'Api\UsersController@toggleModerator');
Route::post('/users/author/{user}', 'Api\UsersController@toggleAuthor');
Route::get('/tasks/{id}','Api\TasksController@show');
Route::post('/tasks','Api\TasksController@store');
Route::patch('/tasks/{id}','Api\TasksController@update');
Route::delete('/tasks/{id}','Api\TasksController@destroy');

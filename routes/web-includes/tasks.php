<?php


Route::prefix('/tasks')->group(function ()
{
    Route::get('/','TasksController@index');
    Route::get('/create','TasksController@create');
    Route::post('/','TasksController@store');
    Route::post('/publish/{task}','TasksController@publish');

    Route::get('{task}/edit','TasksController@edit');
    Route::get('/{task}','TasksController@show');
    Route::patch('/{task}','TasksController@update');
    Route::delete('/{task}','TasksController@destroy');
});

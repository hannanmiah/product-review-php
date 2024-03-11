<?php

use Hannan\ProductReview\Facades\Route;

Route::get('/', function () {
    return ['hello' => 'world'];
});

Route::get('/reviews', 'ReviewController@index');
Route::post('/reviews', 'ReviewController@store');
Route::get('/reviews/{id}', 'ReviewController@show');
Route::put('/reviews/{id}', 'ReviewController@update');
Route::delete('/reviews/{id}', 'ReviewController@destroy');

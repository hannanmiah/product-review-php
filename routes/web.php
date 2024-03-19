<?php

use Hannan\ProductReview\Facades\DB;
use Hannan\ProductReview\Facades\Route;

Route::get('/', function () {
    $data = DB::table('reviews')->select(['id', 'product_id', 'body']);
    return ['data' => $data];
});

Route::get('/reviews', 'ReviewController@index');
Route::post('/reviews', 'ReviewController@store');
Route::get('/reviews/{id}', 'ReviewController@show');
Route::put('/reviews/{id}', 'ReviewController@update');
Route::delete('/reviews/{id}', 'ReviewController@destroy');

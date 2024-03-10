<?php

use Hannan\ProductReview\Facades\Route;

Route::get('/', function () {
    return 'hello';
});
Route::get('/hello', 'HomeController@index');

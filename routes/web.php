<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/katalog', function () {
    return view('pages.customer.catalog');
});

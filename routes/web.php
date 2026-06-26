<?php

use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';
require __DIR__ . '/api.php';

Route::get('/admin/{any?}', function () {
    return view('admin');
})->where('any', '.*');

Route::get('/{any?}', function () {
    return view('storefront');
})->where('any', '.*');

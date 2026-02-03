<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('{any}', function () {
    return view('app');
})->where('any', '.*');

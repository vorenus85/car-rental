<?php

use App\Http\Controllers\Storefront\CarModuleController;
use Illuminate\Support\Facades\Route;

Route::prefix('/api/storefront/cars')->group(function () {
    Route::get('/random-available', [CarModuleController::class, 'randomCars']);
});

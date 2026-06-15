<?php

use App\Http\Controllers\Storefront\CarModuleController;
use App\Http\Controllers\Storefront\LocationController;
use Illuminate\Support\Facades\Route;

Route::prefix('/api/storefront/cars')->group(function () {
    Route::get('/random-available', [CarModuleController::class, 'randomCars']);
});

Route::prefix('/api/storefront/locations')->group(function () {
    Route::get('/', [LocationController::class, 'index']);
});

<?php

use App\Http\Controllers\Storefront\CarController;
use App\Http\Controllers\Storefront\LocationController;
use Illuminate\Support\Facades\Route;

Route::prefix('/api/storefront/cars')->group(function () {
    Route::get('/', [CarController::class, 'index']);
    Route::get('/{car}', [CarController::class, 'show']);
    Route::get('/random-available', [CarController::class, 'randomCars']);
});

Route::prefix('/api/storefront/locations')->group(function () {
    Route::get('/', [LocationController::class, 'index']);
});

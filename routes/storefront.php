<?php

use App\Http\Controllers\Storefront\BrandController;
use App\Http\Controllers\Storefront\CarController;
use App\Http\Controllers\Storefront\LocationController;
use Illuminate\Support\Facades\Route;

Route::prefix('/api/storefront/cars')->group(function () {
    Route::get('/', [CarController::class, 'index']);
    Route::get('/similars/{car}', [CarController::class, 'similarCars']);
    Route::get('/randoms', [CarController::class, 'randomCars']);
    Route::get('/{car}', [CarController::class, 'show']);
});

Route::prefix('/api/storefront/locations')->group(function () {
    Route::get('/', [LocationController::class, 'index']);
});

Route::prefix('/api/storefront/brands')->group(function () {
    Route::get('/', [BrandController::class, 'index']);
});

<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Fleet\BrandController;
use App\Http\Controllers\Fleet\BrandImageController;
use App\Http\Controllers\Fleet\CarController;
use App\Http\Controllers\Fleet\CarImageController;
use App\Http\Controllers\Fleet\CarModelController;
use App\Http\Controllers\Fleet\FeatureController;
use App\Http\Controllers\Fleet\LocationController;
use App\Http\Controllers\Fleet\VariantController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('/api/admin/users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/', [UserController::class, 'store']);
        Route::get('/{user}', [UserController::class, 'show']);
        Route::put('/{user}', [UserController::class, 'update']);
        Route::delete('/{user}', [UserController::class, 'destroy']);
        Route::put('/{user}/toggle-active', [UserController::class, 'toggleActive']);
    });

    Route::prefix('/api/admin/account')->group(function () {
        Route::get('/me', [AccountController::class, 'show']);
        Route::put('/me', [AccountController::class, 'update']);
        Route::put('/password', [AccountController::class, 'changePassword']);
    });

    Route::prefix('/api/admin/features')->group(function () {
        Route::get('/', [FeatureController::class, 'index']);
        Route::post('/', [FeatureController::class, 'store']);
        Route::get('/{feature}', [FeatureController::class, 'show']);
        Route::put('/{feature}', [FeatureController::class, 'update']);
        Route::delete('/{feature}', [FeatureController::class, 'destroy']);
    });

    Route::prefix('/api/admin/brands')->group(function () {
        Route::get('/', [BrandController::class, 'index']);
        Route::post('/', [BrandController::class, 'store']);
        Route::get('/{brand}', [BrandController::class, 'show']);
        Route::put('/{brand}', [BrandController::class, 'update']);
        Route::delete('/{brand}', [BrandController::class, 'destroy']);

        Route::post('/image/upload', [BrandImageController::class, 'store']);
        Route::delete('/image/delete/{brand}', [BrandImageController::class, 'delete']);
    });

    Route::prefix('/api/admin/car-models')->group(function () {
        Route::get('/', [CarModelController::class, 'index']);
        Route::get('/options', [CarModelController::class, 'options']);
        Route::post('/', [CarModelController::class, 'store']);
        Route::get('/{carModel}', [CarModelController::class, 'show']);
        Route::put('/{carModel}', [CarModelController::class, 'update']);
        Route::delete('/{carModel}', [CarModelController::class, 'destroy']);
    });

    Route::prefix('/api/admin/variants')->group(function () {
        Route::get('/', [VariantController::class, 'index']);
        Route::get('/options', [VariantController::class, 'options']);
        Route::post('/', [VariantController::class, 'store']);
        Route::get('/{variant}', [VariantController::class, 'show']);
        Route::put('/{variant}', [VariantController::class, 'update']);
        Route::delete('/{variant}', [VariantController::class, 'destroy']);
    });

    Route::prefix('/api/admin/cars')->group(function () {
        Route::get('/', [CarController::class, 'index']);
        Route::post('/', [CarController::class, 'store']);
        Route::get('/{car}', [CarController::class, 'show']);
        Route::put('/{car}', [CarController::class, 'update']);
        Route::delete('/{car}', [CarController::class, 'destroy']);

        Route::post('/image/upload', [CarImageController::class, 'store']);
        Route::delete('/image/delete/{car}', [CarImageController::class, 'delete']);
    });

    Route::prefix('/api/admin/locations')->group(function () {
        Route::get('/', [LocationController::class, 'index']);
        Route::get('/options', [LocationController::class, 'options']);
        Route::post('/', [LocationController::class, 'store']);
        Route::get('/{location}', [LocationController::class, 'show']);
        Route::put('/{location}', [LocationController::class, 'update']);
        Route::delete('/{location}', [LocationController::class, 'destroy']);

        Route::put('/{location}/toggle-active', [LocationController::class, 'toggleActive']);
    });
});

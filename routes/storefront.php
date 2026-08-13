<?php

use App\Http\Controllers\Storefront\BookingController;
use App\Http\Controllers\Storefront\BrandController;
use App\Http\Controllers\Storefront\CarController;
use App\Http\Controllers\Storefront\ContactController;
use App\Http\Controllers\Storefront\ExtraController;
use App\Http\Controllers\Storefront\InsuranceController;
use App\Http\Controllers\Storefront\LocationController;
use App\Http\Controllers\Storefront\ProfileController;
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

Route::prefix('/api/storefront/extras')->group(function () {
    Route::get('/', [ExtraController::class, 'index']);
});

Route::prefix('/api/storefront/insurances')->group(function () {
    Route::get('/', [InsuranceController::class, 'index']);
});

Route::prefix('/api/storefront/booking')
    ->middleware('auth:customer')
    ->group(function () {
        Route::get('/', [BookingController::class, 'bookingData']);
        Route::get('/order/', [BookingController::class, 'order']);
        Route::post('/', [BookingController::class, 'store']);
    });

Route::prefix('/api/storefront/contact')->group(function () {
    Route::post('/', [ContactController::class, 'store']);
});

Route::prefix('/api/storefront/profile')
    ->middleware('auth:customer')
    ->group(function () {
        Route::patch('/basic-details', [ProfileController::class, 'editBasicDetails']);
        Route::patch('/password', [ProfileController::class, 'changePassword']);
        Route::patch('/billing-info', [ProfileController::class, 'billingInfo']);
    });

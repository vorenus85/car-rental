<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\Booking\BookingController;
use App\Http\Controllers\Admin\Booking\CarDriverController;
use App\Http\Controllers\Admin\Booking\CustomerBillingController;
use App\Http\Controllers\Admin\Booking\CustomerController;
use App\Http\Controllers\Admin\Booking\ExtraController;
use App\Http\Controllers\Admin\Booking\InsuranceController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Fleet\BrandController;
use App\Http\Controllers\Admin\Fleet\BrandImageController;
use App\Http\Controllers\Admin\Fleet\CarController;
use App\Http\Controllers\Admin\Fleet\CarImageController;
use App\Http\Controllers\Admin\Fleet\CarModelController;
use App\Http\Controllers\Admin\Fleet\FeatureController;
use App\Http\Controllers\Admin\Fleet\LocationController;
use App\Http\Controllers\Admin\Fleet\VariantController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('/api/admin/users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/', [UserController::class, 'store']);
        Route::get('/{user}', [UserController::class, 'show']);
        Route::put('/{user}', [UserController::class, 'update']);
        Route::delete('/{user}', [UserController::class, 'destroy']);
        Route::post('{user}/send-password-reset', [UserController::class, 'sendPasswordReset']);
        Route::put('/{user}/toggle-active', [UserController::class, 'toggleActive']);
    });

    Route::prefix('/api/admin/customers')->group(function () {
        Route::get('/', [CustomerController::class, 'index']);
        Route::post('/', [CustomerController::class, 'store']);
        Route::get('/{customer}', [CustomerController::class, 'show']);
        Route::get('/{customer}/billing', [CustomerBillingController::class, 'show']);
        Route::post('/{customer}/billing', [CustomerBillingController::class, 'update']);
        Route::put('/{customer}', [CustomerController::class, 'update']);
        Route::delete('/{customer}', [CustomerController::class, 'destroy']);
        Route::post('{customer}/send-password-reset', [CustomerController::class, 'sendPasswordReset']);
        Route::put('/{customer}/toggle-active', [CustomerController::class, 'toggleActive']);
    });

    Route::prefix('/api/admin/account')->group(function () {
        Route::get('/me', [AccountController::class, 'show']);
        Route::put('/me', [AccountController::class, 'update']);
        Route::put('/password', [AccountController::class, 'changePassword']);
    });

    Route::prefix('/api/admin/bookings')->group(function () {
        Route::get('/', [BookingController::class, 'index']);
    });

    Route::prefix('/api/admin/dashboard')->group(function () {
        Route::get('/available-cars', [DashboardController::class, 'availableCarsKpi']);
        Route::get('/today-dropoffs', [DashboardController::class, 'todayDropoffsKpi']);
        Route::get('/today-pickups', [DashboardController::class, 'todayPickupKpi']);
        Route::get('/monthly-revenue', [DashboardController::class, 'monthlyRevenueKpi']);
    });

    Route::prefix('/api/admin/car-drivers')->group(function () {
        Route::get('/', [CarDriverController::class, 'index']);
        Route::post('/', [CarDriverController::class, 'store']);
        Route::get('/{carDriver}', [CarDriverController::class, 'show']);
        Route::put('/{carDriver}', [CarDriverController::class, 'update']);
        Route::delete('/{carDriver}', [CarDriverController::class, 'destroy']);
    });

    Route::prefix('/api/admin/features')->group(function () {
        Route::get('/', [FeatureController::class, 'index']);
        Route::post('/', [FeatureController::class, 'store']);
        Route::get('/{feature}', [FeatureController::class, 'show']);
        Route::put('/{feature}', [FeatureController::class, 'update']);
        Route::delete('/{feature}', [FeatureController::class, 'destroy']);
    });

    Route::prefix('/api/admin/extras')->group(function () {
        Route::get('/', [ExtraController::class, 'index']);
        Route::post('/', [ExtraController::class, 'store']);
        Route::get('/{extra}', [ExtraController::class, 'show']);
        Route::put('/{extra}', [ExtraController::class, 'update']);
        Route::delete('/{extra}', [ExtraController::class, 'destroy']);
    });

    Route::prefix('/api/admin/insurances')->group(function () {
        Route::get('/', [InsuranceController::class, 'index']);
        Route::post('/', [InsuranceController::class, 'store']);
        Route::get('/{insurance}', [InsuranceController::class, 'show']);
        Route::put('/{insurance}', [InsuranceController::class, 'update']);
        Route::delete('/{insurance}', [InsuranceController::class, 'destroy']);
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

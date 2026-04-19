<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Fleet\BrandController;
use App\Http\Controllers\Fleet\BrandImageController;
use App\Http\Controllers\Fleet\CarModelController;
use App\Http\Controllers\Fleet\FeatureController;
use App\Http\Controllers\Fleet\VariantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout']);
Route::get('/auth/me', fn(Request $request) => response()->json($request->user()));
Route::get('/auth/check', function () {
    return response()->json([
        'authenticated' => Auth::check(),
        'user' => Auth::user(),
    ]);
});

Route::middleware('auth:sanctum')->group(function () {

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
        Route::post('/', [VariantController::class, 'store']);
        Route::get('/{variant}', [VariantController::class, 'show']);
        Route::put('/{variant}', [VariantController::class, 'update']);
        Route::delete('/{variant}', [VariantController::class, 'destroy']);
    });
});

Route::get('{any}', function () {
    return view('app');
})->where('any', '.*');

<?php

use App\Http\Controllers\Storefront\AuthController;
use App\Http\Resources\Storefront\CustomerResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('/storefront/auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', function () {
        return response()->json([
            'customer' => new CustomerResource(Auth::guard('customer')->user()),
        ]);
    });

    Route::post('/forgot-password', [AuthController::class, 'sendResetLink']);
    Route::post('/reset-password', [AuthController::class, 'reset']);
});

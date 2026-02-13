<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ColorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout']);
Route::get('/auth/me', fn (Request $request) => response()->json($request->user()));
Route::get('/auth/check', function () {
    return response()->json([
        'authenticated' => Auth::check(),
        'user' => Auth::user(),
    ]);
});

Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('/api/admin/colors')->group(function(){
        Route::get('/', [ColorController::class, 'index']);
        Route::post('/', [ColorController::class, 'store']);
        Route::get('/{color}', [ColorController::class, 'show']);
        Route::put('/{color}', [ColorController::class, 'update']);
        Route::delete('/{color}', [ColorController::class, 'destroy']);
    });

});

Route::get('{any}', function () {
    return view('app');
})->where('any', '.*');

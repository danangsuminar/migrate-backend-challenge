<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShipController;

// Endpoint Publik (Tanpa Token)
Route::post('Auth/login', [AuthController::class, 'login']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Endpoint Terlindungi (Wajib Token)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('Ships', [ShipController::class, 'index']);
    Route::get('Ships/{code}', [ShipController::class, 'show']);
    Route::post('Ships', [ShipController::class, 'store']);
    Route::put('Ships/{code}', [ShipController::class, 'update']);
    Route::delete('Ships/{code}', [ShipController::class, 'destroy']);
});
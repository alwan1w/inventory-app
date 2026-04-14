<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rute Terbuka (Siapapun bisa akses untuk login)
Route::post('/login', [AuthController::class, 'login']);

// Rute Tergembok (Hanya yang punya token yang bisa masuk)
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('items', ItemController::class);
});


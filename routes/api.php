<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/upload', [ImageController::class, 'upload']);
    Route::post('/images/{id}/resize', [ImageController::class, 'resize']);
    Route::post('/images/{id}/crop', [ImageController::class, 'crop']);
    Route::post('/images/{id}/rotate', [ImageController::class, 'rotate']);
    Route::post('/images/{id}/flip', [ImageController::class, 'flip']);
    Route::post('/images/{id}/grayscale', [ImageController::class, 'grayscale']);
});

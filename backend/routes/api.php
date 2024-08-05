<?php

use App\Http\Controllers\TrainingController;
use App\Http\Controllers\SubordinateController;
use App\Http\Controllers\SubordinateTrainingController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('trainings', TrainingController::class);
    Route::resource('subordinates', SubordinateController::class);
    Route::resource('subordinate-trainings', SubordinateTrainingController::class);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('user', [AuthController::class, 'user']);
});

Route::get('/test-connection', function () {
    return response()->json(['message' => 'Connection successful'], 200);
});

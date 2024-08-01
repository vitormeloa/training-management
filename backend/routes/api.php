<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\UserTrainingController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::apiResource('trainings', TrainingController::class);
    Route::apiResource('user-trainings', UserTrainingController::class);
});

Route::get('/test', function () {
    return response()->json(['message' => 'Backend is working!']);
});

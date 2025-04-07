<?php

use App\Http\Controllers\Api\Authentication\AuthController;
use App\Http\Controllers\Api\Authentication\RegisterController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function(){
    Route::middleware('guest:api')->group(function () {
        Route::post('register', [RegisterController::class, 'store']);
        Route::post('login', [AuthController::class, 'store']);
    });

    Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});


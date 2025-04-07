<?php

use App\Http\Controllers\Api\Authentication\RegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:api')->prefix('auth')->group(function(){
    Route::post('register', [RegisterController::class, 'store']);
});



<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Middleware\EnsureUserIsVerified;

Route::group(['prefix'=>'auth'],function(){
    Route::post('register', [AuthController::class, 'register']);
    
    Route::post('verify-otp', [AuthController::class, 'verifyOTP']);    
});

Route::middleware([EnsureUserIsVerified::class])->group(function () {
    Route::post('auth/login', [AuthController::class, 'login']);
    Route::group(['middleware'=>'auth:sanctum'],function(){
        Route::post('logout', [AuthController::class, 'logout']);
    });
});

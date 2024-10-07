<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PasswordResetsController;
use App\Http\Middleware\EnsureUserIsVerified;

Route::group(['prefix'=>'auth'],function(){
    Route::post('register', [AuthController::class, 'register']);
    Route::post('verify-otp', [AuthController::class, 'verifyOTP']);
    Route::middleware([EnsureUserIsVerified::class])->post('login', [AuthController::class, 'login']);
});

Route::group(['prefix'=>'reset-password'],function(){
    Route::post('/', [PasswordResetsController::class, 'submitEmail']);
    Route::post('verify-otp', [PasswordResetsController::class, 'verifyOTP']);
    Route::middleware([EnsureUserIsVerified::class])->post('update', [PasswordResetsController::class, 'resetPassword']); 
});
Route::middleware([EnsureUserIsVerified::class])->group(function () {
    Route::group(['middleware'=>'auth:sanctum'],function(){
        Route::post('logout', [AuthController::class, 'logout']);
    });
});

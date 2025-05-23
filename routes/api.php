<?php

use App\Http\Controllers\MessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\PasswordResetsController;
use App\Http\Controllers\API\UmkmController;
use App\Http\Middleware\EnsureUserIsVerified;
use App\Http\Controllers\ConversationController;

Route::get('get-all-user', [UserController::class, 'getAllUser']);
Route::get('get-all-umkm', [UmkmController::class, 'getAllUmkm']);
Route::get('umkm/find/{id}', [UmkmController::class, 'find']);

Route::group(['prefix'=>'auth'],function(){
    Route::post('register', [AuthController::class, 'register']);
    Route::post('verify-otp', [AuthController::class, 'verifyOTP']);
    Route::post('check-email', [AuthController::class, 'checkEmail']);
    Route::post('resend-otp', [PasswordResetsController::class, 'resendOTP']);
    Route::middleware([EnsureUserIsVerified::class])->post('login', [AuthController::class, 'login']);
});

Route::group(['prefix' => 'reset-password'], function () {
    Route::post('/', [PasswordResetsController::class, 'submitEmail']);
    Route::post('verify-otp', [PasswordResetsController::class, 'verifyOTP']);
    Route::middleware([EnsureUserIsVerified::class])->post('update', [PasswordResetsController::class, 'resetPassword']);
});

Route::middleware('auth:sanctum', 'verified')->group(function () {
    Route::middleware([EnsureUserIsVerified::class])->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('getUser', [UserController::class, 'getUserData']);
        Route::get('getUser/{id}', [UserController::class, 'findUserData']);
        Route::post('user/update', [UserController::class, 'update']);
        Route::prefix('umkm')->group(function () {
            Route::post('create', [UmkmController::class, 'create']);
            Route::get('get-data', [UmkmController::class, 'getUmkmData']);
            Route::post('update', [UmkmController::class, 'update']);
            Route::post('delete', [UmkmController::class, 'delete']);
        });

        // for chat
        Route::get('/retreive/conversations', [ConversationController::class, 'index']);
        Route::get('/find/conversations', [ConversationController::class, 'getConversations']);
        Route::post('/make/conversations', [ConversationController::class, 'store']);

        Route::get('/retreive/messages', [MessageController::class, 'index']);
        Route::post('/make/messages', [MessageController::class, 'store']);
    });
});

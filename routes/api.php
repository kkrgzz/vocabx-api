<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SentenceController;
use App\Http\Controllers\TranslationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'account'
], function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware(['middleware' => 'api', 'auth:api'])->group(function () {
    Route::prefix('account')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
        Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
        Route::get('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');
    });

    // User routes
    Route::put('user/edit', [UserController::class, 'edit']);

    // Language routes
    Route::apiResource('languages', LanguageController::class);

    // Word routes
    Route::get('user/words', [WordController::class, 'userWords']);
    Route::apiResource('words', WordController::class);
    
    // Sentence routes
    Route::apiResource('sentences', SentenceController::class);

    // Translation routes
    Route::apiResource('translations', TranslationController::class);
});

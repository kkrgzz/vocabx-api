<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\TranslationController;
use App\Http\Controllers\WordController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {

    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register'])->name('register');

    Route::middleware(['middleware' => 'api', 'auth:api'])->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::post('refresh', [AuthController::class, 'refresh'])->name('refresh');
        Route::post('me', [AuthController::class, 'me'])->name('me');
    });
});

Route::group([
    'middleware' => 'api',
], function () {
    // Language routes
    Route::apiResource('languages', LanguageController::class);

    // Word routes
    Route::get('user/words', [WordController::class, 'userWords']);
    Route::apiResource('words', WordController::class);

    // Translation routes
    Route::post('translations/bulk', [TranslationController::class, 'bulkStore']);
    Route::put('translations/bulk', [TranslationController::class, 'bulkUpdate']);
    Route::apiResource('translations', TranslationController::class);
});

<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MoodController;
use App\Http\Controllers\SentenceController;
use App\Http\Controllers\TodoCategoryController;
use App\Http\Controllers\TranslationController;
use App\Http\Controllers\WordController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {

    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register'])->name('register');
});

Route::middleware(['middleware' => 'api', 'auth:api'])->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
        Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
        Route::get('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');
    });

    // Language routes
    Route::apiResource('languages', LanguageController::class);

    // Word routes
    Route::get('user/words', [WordController::class, 'userWords']);
    Route::apiResource('words', WordController::class);

    // Translation routes
    Route::post('translations/bulk', [TranslationController::class, 'bulkStore']);
    Route::put('translations/bulk', [TranslationController::class, 'bulkUpdate']);
    Route::apiResource('translations', TranslationController::class);

    // Sentence routes
    Route::put('sentences/bulk', [SentenceController::class, 'bulkUpdate']);
    Route::apiResource('sentences', SentenceController::class);

    // Mood Routes
    Route::get('moods/latest', [MoodController::class, 'latestMoods']);
    Route::apiResource('moods', MoodController::class);

    // Todo Category Routes
    Route::apiResource('todo-categories', TodoCategoryController::class);
});

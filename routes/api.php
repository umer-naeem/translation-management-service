<?php

use App\Http\Controllers\TranslationController;
use App\Http\Controllers\AuthController;

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('translations', TranslationController::class);
    Route::get('translations-export', [TranslationController::class, 'export']);
});

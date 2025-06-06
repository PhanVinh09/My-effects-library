<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EffectController;

Route::get('/admin/effects', [EffectController::class, 'index'])->name('effects.index');

Route::prefix('api')->group(function () {
    Route::get('/effects', [EffectController::class, 'apiIndex']);
    Route::post('/effects', [EffectController::class, 'store']);
    Route::get('/effects/{id}', [EffectController::class, 'show']);
    Route::put('/effects/{id}', [EffectController::class, 'update']);
    Route::delete('/effects/{id}', [EffectController::class, 'destroy']);
});

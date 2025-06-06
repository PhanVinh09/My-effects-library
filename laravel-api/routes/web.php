<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EffectController;
use App\Http\Controllers\AuthController;
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('formRegister');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('formLogin');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/admin/effects', [EffectController::class, 'index'])->name('effects.index');

Route::prefix('api')->group(function () {
    Route::get('/effects', [EffectController::class, 'apiIndex']);
    Route::post('/effects', [EffectController::class, 'store']);
    Route::get('/effects/{id}', [EffectController::class, 'show']);
    Route::put('/effects/{id}', [EffectController::class, 'update']);
    Route::delete('/effects/{id}', [EffectController::class, 'destroy']);
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EffectController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminMiddleware;

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::view('/admin', 'admin.admin_index')->name('admin.index');
    Route::view('/admin/dashboard', 'admin.admin_dashboard')->name('admin.dashboard');
    Route::get('/admin/effects', [EffectController::class, 'index'])->name('effects.index');
});
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login')->with('message', 'Đăng xuất thành công!');
})->name('logout');

Route::prefix('api')->group(function () {
    Route::get('/effects', [EffectController::class, 'apiIndex']);
    Route::post('/effects', [EffectController::class, 'store']);
    Route::get('/effects/{id}', [EffectController::class, 'show']);
    Route::put('/effects/{id}', [EffectController::class, 'update']);
    Route::delete('/effects/{id}', [EffectController::class, 'destroy']);
});

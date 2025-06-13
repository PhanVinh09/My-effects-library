<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EffectController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\AdminManagementController;

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::view('/admin', 'admin.admin_index')->name('admin.index');
    Route::view('/admin/dashboard', 'admin.admin_dashboard')->name('admin.dashboard');

    // CRUD cho Effect
    Route::get('/admin/effects', [EffectController::class, 'index'])->name('effects.index');
    // Thêm
    Route::post('/effects/add', [EffectController::class, 'store'])->name('effects.store');
    // Sửa
    Route::put('/effects/{id}', [EffectController::class, 'update'])->name('effects.update');
    // Xoá
    Route::delete('/effects/{id}', [EffectController::class, 'destroy'])->name('effects.destroy');;

    Route::get('/admin/layouts', [LayoutController::class, 'index'])->name('layouts.index');

    Route::get('/admin/user', [UserManagementController::class, 'index'])->name('users.index');
    Route::post('/user/add', [UserManagementController::class, 'store'])->name('users.store');
    Route::put('/user/{id}', [UserManagementController::class, 'update'])->name('users.update');
    Route::delete('/user/{id}', [UserManagementController::class, 'destroy'])->name('users.destroy');

    Route::get('/admin/admins', [AdminManagementController::class, 'index'])->name('admins.index');
    Route::post('/admin/add', [AdminManagementController::class, 'store'])->name('admins.store');
    Route::put('/admin/{id}', [AdminManagementController::class, 'update'])->name('admins.update');
    Route::delete('/admin/{id}', [AdminManagementController::class, 'destroy'])->name('admins.destroy');
});
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login')->with('message', 'Đăng xuất thành công!');
})->name('logout');

Route::prefix('api')->group(function () {
    Route::get('/effects', [EffectController::class, 'apiIndex']);
});

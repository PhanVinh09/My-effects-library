<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;

use App\Http\Controllers\EffectController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\UseInterfaceController;

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

use App\Http\Middleware\AdminMiddleware;

use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\AdminManagementController;

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::view('/admin', 'admin.admin_index')->name('admin.index');
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // CRUD cho Effect
    Route::get('/admin/effects', [EffectController::class, 'index'])->name('effects.index');
    Route::post('/effects/add', [EffectController::class, 'store'])->name('effects.store');
    Route::put('/effects/{id}', [EffectController::class, 'update'])->name('effects.update');
    Route::delete('/effects/{id}', [EffectController::class, 'destroy'])->name('effects.destroy');

    // CRUD cho Layout
    Route::get('/admin/layouts', [LayoutController::class, 'index'])->name('layouts.index');
    Route::post('/layouts/add', [LayoutController::class, 'store'])->name('layouts.store');
    Route::put('/layouts/{id}', [LayoutController::class, 'update'])->name('layouts.update');
    Route::delete('/layouts/{id}', [LayoutController::class, 'destroy'])->name('layouts.destroy');

     // CRUD cho Form
    Route::get('/admin/forms', [FormController::class, 'index'])->name('forms.index');
    Route::post('/forms/add', [FormController::class, 'store'])->name('forms.store');
    Route::put('/forms/{id}', [FormController::class, 'update'])->name('forms.update');
    Route::delete('/forms/{id}', [FormController::class, 'destroy'])->name('forms.destroy');

    // CRUD cho UI
    Route::get('/admin/useInterfaces', [UseInterfaceController::class, 'index'])->name('useInterfaces.index');
    Route::post('/useInterfaces/add', [UseInterfaceController::class, 'store'])->name('useInterfaces.store');
    Route::put('/useInterfaces/{id}', [UseInterfaceController::class, 'update'])->name('useInterfaces.update');
    Route::delete('/useInterfaces/{id}', [UseInterfaceController::class, 'destroy'])->name('useInterfaces.destroy');

    // CRUD cho User
    Route::get('/admin/user', [UserManagementController::class, 'index'])->name('users.index');
    Route::post('/user/add', [UserManagementController::class, 'store'])->name('users.store');
    Route::put('/user/{id}', [UserManagementController::class, 'update'])->name('users.update');
    Route::delete('/user/{id}', [UserManagementController::class, 'destroy'])->name('users.destroy');

    // CRUD cho Admin
    Route::get('/admin/admins', [AdminManagementController::class, 'index'])->name('admins.index');
    Route::post('/admin/add', [AdminManagementController::class, 'store'])->name('admins.store');
    Route::put('/admin/{id}', [AdminManagementController::class, 'update'])->name('admins.update');
    Route::delete('/admin/{id}', [AdminManagementController::class, 'destroy'])->name('admins.destroy');
});

// login, logout và register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login')->with('message', 'Đăng xuất thành công!');
})->name('logout');

// Hiểu Thị bằng Api
Route::prefix('api')->group(function () {
    Route::get('/effects', [EffectController::class, 'apiIndex']);
});

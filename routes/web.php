<?php

use App\Http\Controllers\Admin\KaryawanController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login.view');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.view');

Route::post('/login', [AuthController::class, 'handleLogin'])->name('login.handle');
Route::post('/register', [AuthController::class, 'handleRegister'])->name('register.handle');
Route::post('/logout', [AuthController::class, 'handleLogout'])->name('logout.handle');


Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/admin/karyawan', [KaryawanController::class, 'showList'])->name('admin.karyawan.view');
    Route::get('/admin/karyawan/detail/{id}', [KaryawanController::class, 'showDetail'])->name('admin.karyawan.detail.view');

    Route::get('/admin/karyawan/create', [KaryawanController::class, 'showCreate'])->name('admin.karyawan.create.view');
    Route::post('/admin/karyawan/create', [KaryawanController::class, 'handleCreate'])->name('admin.karyawan.create.handle');
});

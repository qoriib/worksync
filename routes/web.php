<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\Admin\KaryawanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\PresensiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register.view');
    Route::post('/login', [AuthController::class, 'handleLogin'])->name('login.handle');
    Route::post('/register', [AuthController::class, 'handleRegister'])->name('register.handle');
});

Route::post('/logout', [AuthController::class, 'handleLogout'])->name('logout.handle');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/karyawan', [KaryawanController::class, 'showList'])->name('admin.karyawan.view');
    Route::get('/karyawan/detail/{id}', [KaryawanController::class, 'showDetail'])->name('admin.karyawan.detail.view');
    Route::get('/karyawan/create', [KaryawanController::class, 'showCreate'])->name('admin.karyawan.create.view');
    Route::post('/karyawan/create', [KaryawanController::class, 'handleCreate'])->name('admin.karyawan.create.handle');
    Route::delete('/karyawan/{id}', [KaryawanController::class, 'handleDelete'])->name('admin.karyawan.delete.handle');

    Route::get('/presensi', [PresensiController::class, 'showList'])->name('admin.presensi.view');
    Route::get('/presensi/create', [PresensiController::class, 'showCreate'])->name('admin.presensi.create.view');
    Route::post('/presensi/create', [PresensiController::class, 'handleCreate'])->name('admin.presensi.create.handle');
    Route::get('/presensi/detail/{id}', [PresensiController::class, 'showDetail'])->name('admin.presensi.detail.view');

    Route::get('cuti', [CutiController::class, 'adminShowList'])->name('admin.cuti.view');
    Route::post('cuti/{id}/{status}', [CutiController::class, 'adminHandleApproval'])->name('admin.cuti.approval');
});

Route::middleware(['auth', 'user'])->prefix('user')->group(function () {
    Route::get('/absensi', [AbsensiController::class, 'showList'])->name('user.absensi.view');
    Route::get('/absensi/{id}', [AbsensiController::class, 'showForm'])->name('user.absensi.form.view');
    Route::post('/absensi/{id}', [AbsensiController::class, 'handleSubmit'])->name('user.absensi.handle');

    Route::get('/cuti', [CutiController::class, 'userShowList'])->name('user.cuti.view');
    Route::post('/cuti/submit', [CutiController::class, 'userHandleSubmit'])->name('user.cuti.handle');
});

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    return redirect()->route('dashboard.redirect');
})->name('dashboard');

Route::get('/redirect-dashboard', function () {
    $user = Auth::user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.karyawan.view');
    } else {
        return redirect()->route('user.absensi.view');
    }
})->name('dashboard.redirect')->middleware('auth');

<?php

use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\PresensiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'handleLogin'])->name('login.handle');
});

Route::post('/logout', [AuthController::class, 'handleLogout'])->name('logout.handle');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/karyawan', [KaryawanController::class, 'adminShowList'])->name('admin.karyawan.view');
    Route::get('/karyawan/detail/{id}', [KaryawanController::class, 'adminShowDetail'])->name('admin.karyawan.detail.view');
    Route::get('/karyawan/create', [KaryawanController::class, 'adminShowCreate'])->name('admin.karyawan.create.view');
    Route::post('/karyawan/create', [KaryawanController::class, 'adminHandleCreate'])->name('admin.karyawan.create.handle');
    Route::delete('/karyawan/{id}', [KaryawanController::class, 'adminHandleDelete'])->name('admin.karyawan.delete.handle');

    Route::get('/presensi', [PresensiController::class, 'adminShowList'])->name('admin.presensi.view');
    Route::get('/presensi/create', [PresensiController::class, 'adminShowCreate'])->name('admin.presensi.create.view');
    Route::post('/presensi/create', [PresensiController::class, 'adminHandleCreate'])->name('admin.presensi.create.handle');
    Route::get('/presensi/detail/{id}', [PresensiController::class, 'adminShowDetail'])->name('admin.presensi.detail.view');
    Route::delete('/presensi/delete/{presensi}', [PresensiController::class, 'adminHandleDelete'])->name('admin.presensi.delete.handle');

    Route::get('cuti', [CutiController::class, 'adminShowList'])->name('admin.cuti.view');
    Route::post('cuti/{id}/{status}', [CutiController::class, 'adminHandleApproval'])->name('admin.cuti.approval');
});

Route::middleware(['auth', 'user'])->prefix('user')->group(function () {
    Route::get('/profile', [KaryawanController::class, 'userShowProfile'])->name('user.profile.view');
    Route::get('/profile/edit', [KaryawanController::class, 'userShowProfileEdit'])->name('user.profile.edit.view');
    Route::put('/profile/update', [KaryawanController::class, 'userHandleProfileEdit'])->name('user.profile.edit.handle');

    Route::get('/presensi', [PresensiController::class, 'userShowList'])->name('user.presensi.view');
    Route::get('/presensi/{id}', [PresensiController::class, 'userShowForm'])->name('user.presensi.form.view');
    Route::post('/presensi/{id}', [PresensiController::class, 'userHandleForm'])->name('user.presensi.form.handle');

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
        return redirect()->route('user.profile.view');
    }
})->name('dashboard.redirect')->middleware('auth');

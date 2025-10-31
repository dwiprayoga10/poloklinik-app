<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\Dokter\JadwalPeriksaController;
use App\Http\Controllers\Pasien\PoliController as PasienPoliController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Semua route utama aplikasi Poliklinik.
| Sudah diperbaiki agar tidak ada duplikasi nama atau konflik path.
|
*/

// =========================
// 🔐 AUTHENTICATION ROUTES
// =========================

// Halaman login utama (root diarahkan ke login)
Route::get('/', [AuthController::class, 'showLogin']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// =========================
// 🩺 DOKTER ROUTES
// =========================
Route::middleware(['auth', 'role:dokter'])
    ->prefix('dokter')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('dokter.dashboard');
        })->name('dokter.dashboard');

        // Jadwal periksa dokter
        Route::resource('jadwal-periksa', JadwalPeriksaController::class);
    });


// =========================
// 🧍‍♂️ PASIEN ROUTES
// =========================
Route::middleware(['auth', 'role:pasien'])
    ->prefix('pasien')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('pasien.dashboard');
        })->name('pasien.dashboard');

        // Halaman daftar poli
        Route::get('/daftar', [PasienPoliController::class, 'get'])->name('pasien.daftar');

        // Proses pengiriman form daftar poli
        Route::post('/daftar', [PasienPoliController::class, 'submit'])->name('pasien.daftar.submit');
    });


// =========================
// 🧑‍💼 ADMIN ROUTES
// =========================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        Route::resource('polis', PoliController::class);
        Route::resource('dokter', DokterController::class);
        Route::resource('pasien', PasienController::class);
        Route::resource('obat', ObatController::class);
    });

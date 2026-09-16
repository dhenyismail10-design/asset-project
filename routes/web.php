<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PengembalianController;

// Redirect URL utama (/) langsung ke Dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Route Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Resource Routes
Route::resource('aset', AsetController::class);
Route::resource('peminjaman', PeminjamanController::class);
Route::resource('lokasi', LokasiController::class);
Route::resource('kategori', KategoriController::class);
Route::resource('pengembalian', PengembalianController::class);
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\LokasiController;


Route::get('/', function () {
    return redirect()->route('aset.index');
});

// Atur halaman utama atau /dashboard ke DashboardController
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::resource('aset', AsetController::class);
Route::resource('peminjaman', PeminjamanController::class);
Route::resource('lokasi', LokasiController::class);
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\PeminjamanController;

Route::get('/', function () {
    return redirect()->route('aset.index');
});

Route::resource('aset', AsetController::class);
Route::resource('peminjaman', PeminjamanController::class);
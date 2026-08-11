<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsetController;

Route::get('/', function () {
    return redirect()->route('aset.index');
});

Route::resource('aset', AsetController::class);

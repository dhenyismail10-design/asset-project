<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Lokasi;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung Ringkasan Data
        $totalAset        = Aset::count();
        $totalPeminjaman  = Peminjaman::count();
        $totalPengembalian = Pengembalian::count();
        $totalLokasi      = class_exists('\App\Models\Lokasi') ? Lokasi::count() : 0;

        // Data Peminjaman Terbaru (5 data terakhir)
        $peminjamanTerbaru = Peminjaman::with('aset')->latest()->take(5)->get();

        return view('dashboard', compact(
            'totalAset', 
            'totalPeminjaman', 
            'totalPengembalian', 
            'totalLokasi', 
            'peminjamanTerbaru'
        ));
    }
}
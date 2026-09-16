<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Lokasi;
use App\Models\Kategori;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Menghitung Ringkasan Data
        $totalAset         = Aset::count();
        $totalKategori     = Kategori::count();
        $totalPeminjaman   = Peminjaman::count();
        $totalPengembalian = Pengembalian::count();
        $totalLokasi       = class_exists('\App\Models\Lokasi') ? Lokasi::count() : 0;

        // 2. Data Peminjaman Terbaru (Menggunakan eager loading aset.kategori)
        $peminjamanTerbaru = Peminjaman::with('aset.kategori')->latest()->take(5)->get();

        // 3. Kirim data ke view
        return view('dashboard', compact(
            'totalAset', 
            'totalKategori', 
            'totalPeminjaman', 
            'totalPengembalian', 
            'totalLokasi', 
            'peminjamanTerbaru'
        ));
    }
}
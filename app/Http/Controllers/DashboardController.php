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
    $totalAset = \App\Models\Aset::count();
    $totalKategori = \App\Models\Kategori::count();
    
    // MENGHILANGKAN WHERE('STATUS') AGAR TIDAK ERROR
    $totalPeminjaman = \App\Models\Peminjaman::count();
    $totalPengembalian = \App\Models\Pengembalian::count();

    // MEMANGGIL RELASI ASET, LOKASI, DAN KATEGORI DENGAN BENAR
    $peminjamanTerbaru = \App\Models\Peminjaman::with(['aset.lokasi', 'aset.kategori'])
                        ->latest()
                        ->take(5)
                        ->get();

    return view('dashboard', compact(
        'totalAset', 
        'totalKategori', 
        'totalPeminjaman', 
        'totalPengembalian', 
        'peminjamanTerbaru'
    ));
}
}
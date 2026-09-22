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
            $totalAset = Aset::count();
            $totalKategori = Kategori::count();
            $totalPeminjaman = Peminjaman::count();
            $totalPengembalian = Pengembalian::count();

            // TAMBAHKAN with('aset.kategori') DI SINI:
            $peminjamanTerbaru = Peminjaman::with(['aset.kategori'])->latest()->take(5)->get();

            return view('dashboard', compact(
                'totalAset', 
                'totalKategori', 
                'totalPeminjaman', 
                'totalPengembalian', 
                'peminjamanTerbaru'
            ));
        }
}
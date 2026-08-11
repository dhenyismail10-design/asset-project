<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PeminjamanController extends Controller
{
    /**
     * Menampilkan daftar transaksi peminjaman aset.
     */
    public function index()
    {
        $peminjaman = Peminjaman::with('aset')->latest()->get();
        return view('peminjaman.index', compact('peminjaman'));
    }

    /**
     * Menampilkan form peminjaman aset.
     */
    public function create()
    {
        // Hanya mengambil aset yang kondisinya tidak rusak berat dan sedang tidak dipinjam
        $assets = Aset::all();
        return view('peminjaman.create', compact('assets'));
    }

    /**
     * Menyimpan data peminjaman ke database.
     */
    public function store(Request $request)
    {
        // Validasi Input Data
        $request->validate([
            'asset_id' => 'required|exists:aset,id',
            'peminjam'        => 'required|string|max:255',
            'tanggal_pinjam'  => 'required|date',
            'tanggal_kembali' => 'nullable|date|after_or_equal:tanggal_pinjam',
            'kondisi_awal'    => 'required|in:Baik,Rusak Ringan',
            'bukti_pinjam'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'keperluan'       => 'nullable|string',
        ]);

        $data = $request->all();

        // Proses Upload File/Bukti jika ada
        if ($request->hasFile('bukti_pinjam')) {
            $data['bukti_pinjam'] = $request->file('bukti_pinjam')->store('bukti_peminjaman', 'public');
        }

        // Simpan data transaksi ke tabel peminjaman
        Peminjaman::create($data);

        return redirect()->route('peminjaman.index')->with('success', 'Transaksi peminjaman aset berhasil disimpan!');
    }

        public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $assets = Aset::all();

        return view('peminjaman.edit', compact('peminjaman', 'assets'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
        'asset_id'       => 'required|exists:aset,id',
        'peminjam'       => 'required|string|max:255',
        'tanggal_pinjam' => 'required|date',
        'tanggal_kembali'=> 'nullable|date|after_or_equal:tanggal_pinjam',
        'kondisi_awal'   => 'required|in:Baik,Rusak Ringan,Rusak Berat',
        'bukti_pinjam'   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'keperluan'      => 'nullable|string',
    ]);

    $peminjaman = Peminjaman::findOrFail($id);
    $peminjaman->update($request->all());

    return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui.');
    }

    /**
     * Menghapus/Membatalkan data peminjaman.
     */
    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // Hapus file bukti pinjam dari storage jika ada
        if ($peminjaman->bukti_pinjam) {
            Storage::disk('public')->delete($peminjaman->bukti_pinjam);
        }

        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil dihapus!');
    }
}
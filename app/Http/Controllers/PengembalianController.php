<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    /**
     * Menampilkan daftar riwayat pengembalian.
     */
    public function index()
    {
        // Mengambil data pengembalian beserta relasi peminjaman (jika ada relasi)
        $pengembalian = Pengembalian::latest()->get();

        return view('pengembalian.index', compact('pengembalian'));
    }

    /**
     * Menampilkan form tambah pengembalian.
     */
    public function create()
    {
        // Ambil semua data peminjaman
        $peminjaman = Peminjaman::all();

        return view('pengembalian.create', compact('peminjaman'));
    }

    /**
     * Menyimpan data pengembalian baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_id'        => 'required',
            'tanggal_pengembalian' => 'required|date',
            'status'               => 'required|string',
        ]);

        Pengembalian::create([
            'peminjaman_id'        => $request->peminjaman_id,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'status'               => $request->status,
        ]);

        return redirect()->route('pengembalian.index')
            ->with('success', 'Data pengembalian berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit pengembalian.
     */
    public function edit($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        $peminjaman = Peminjaman::all();

        return view('pengembalian.edit', compact('pengembalian', 'peminjaman'));
    }

    /**
     * Memperbarui data pengembalian di database.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'peminjaman_id'        => 'required',
            'tanggal_pengembalian' => 'required|date',
            'status'               => 'required|string',
        ]);

        $pengembalian = Pengembalian::findOrFail($id);
        $pengembalian->update([
            'peminjaman_id'        => $request->peminjaman_id,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'status'               => $request->status,
        ]);

        return redirect()->route('pengembalian.index')
            ->with('success', 'Data pengembalian berhasil diperbarui!');
    }

    /**
     * Menghapus data pengembalian dari database.
     */
    public function destroy($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        $pengembalian->delete();

        return redirect()->route('pengembalian.index')
            ->with('success', 'Data pengembalian berhasil dihapus!');
    }
}
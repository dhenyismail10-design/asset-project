<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    /**
     * Menampilkan semua data lokasi
     */
    public function index()
    {
        $lokasis = Lokasi::latest()->get();

        return view('lokasi.index', compact('lokasis'));
    }

    /**
     * Menampilkan form tambah lokasi
     */
    public function create()
    {
        return view('lokasi.create');
    }

    /**
     * Menyimpan data lokasi
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lokasi' => 'required|string|max:255',
            'alamat'      => 'required|string',
        ]);

        Lokasi::create([
            'nama_lokasi' => $request->nama_lokasi,
            'alamat'      => $request->alamat,
        ]);

        return redirect()
            ->route('lokasi.index')
            ->with('success', 'Data lokasi berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail lokasi
     */
    public function show($id)
    {
        $lokasi = Lokasi::findOrFail($id);

        return view('lokasi.show', compact('lokasi'));
    }

    /**
     * Menampilkan form edit lokasi
     */
    public function edit($id)
    {
        $lokasi = Lokasi::findOrFail($id);

        return view('lokasi.edit', compact('lokasi'));
    }

    /**
     * Mengupdate data lokasi
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lokasi' => 'required|string|max:255',
            'alamat'      => 'required|string',
        ]);

        $lokasi = Lokasi::findOrFail($id);

        $lokasi->update([
            'nama_lokasi' => $request->nama_lokasi,
            'alamat'      => $request->alamat,
        ]);

        return redirect()
            ->route('lokasi.index')
            ->with('success', 'Data lokasi berhasil diperbarui.');
    }

    /**
     * Menghapus data lokasi
     */
    public function destroy($id)
    {
        $lokasi = Lokasi::findOrFail($id);

        $lokasi->delete();

        return redirect()
            ->route('lokasi.index')
            ->with('success', 'Data lokasi berhasil dihapus.');
    }
}
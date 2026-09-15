<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use Illuminate\Http\Request;

class AsetController extends Controller
{
    public function index()
    {
        // Mengambil semua data aset
        $asets = Aset::all();
        return view('aset.index', compact('asets'));
    }

    public function create()
    {
        return view('aset.create');
    }

    public function store(Request $request)
    {
        // 1. Validasi input dari form
        $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'kondisi'     => 'required',
            'lokasi'      => 'required',
        ]);

        // 2. Simpan data ke database
        Aset::create([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'kondisi'     => $request->kondisi,
            'lokasi'      => $request->lokasi,
        ]);

        return redirect()->route('aset.index')->with('success', 'Data aset berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $aset = Aset::findOrFail($id);
        return view('aset.edit', compact('aset'));
    }

    public function update(Request $request, $id)
    {
        // 1. Validasi input
        $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'kondisi'     => 'required',
            'lokasi'      => 'required',
        ]);

        // 2. Update data
        $aset = Aset::findOrFail($id);
        $aset->update([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'kondisi'     => $request->kondisi,
            'lokasi'      => $request->lokasi,
        ]);

        return redirect()->route('aset.index')->with('success', 'Data aset berhasil diubah!');
    }

    public function destroy($id)
    {
        $aset = Aset::findOrFail($id);
        $aset->delete();

        return redirect()->route('aset.index')->with('success', 'Data aset berhasil dihapus!');
    }
}
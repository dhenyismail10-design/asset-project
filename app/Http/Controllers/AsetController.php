<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Kategori;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class AsetController extends Controller
{
    public function index()
{
    
    $aset = Aset::with(['kategori', 'lokasi'])->latest()->get();

    return view('aset.index', compact('aset'));
}

    public function create()
    {
        $kategori = Kategori::all();
        $lokasi = Lokasi::all();
        return view('aset.create', compact('kategori', 'lokasi'));
    }

    public function store(Request $request)
{
    $request->validate([
        'kode_barang' => 'required|string|max:255',
        'nama_aset'   => 'required|string|max:255',
        'kategori_id' => 'required|exists:kategoris,id',
        'kondisi'     => 'required|string',
        'lokasi_id'   => 'required|exists:lokasis,id',
    ]);

    // Ambil data hanya field yang valid sesuai struktur tabel
    Aset::create([
        'kode_barang' => $request->kode_barang,
        'nama_aset'   => $request->nama_aset ?? $request->nama_barang,
        'kategori_id' => $request->kategori_id,
        'kondisi'     => $request->kondisi,
        'lokasi_id'   => $request->lokasi_id,
    ]);

    return redirect()->route('aset.index')->with('success', 'Data aset berhasil ditambahkan!');
} 

    public function edit($id)
    {
        $aset = Aset::findOrFail($id);
        $kategori = Kategori::all();
        $lokasi = Lokasi::all();

        return view('aset.edit', compact('aset', 'kategori', 'lokasi'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'kode_barang' => 'required|string|max:255',
        'nama_aset'   => 'required|string|max:255',
        'kategori_id' => 'required|exists:kategoris,id',
        'kondisi'     => 'required|string',
        'lokasi_id'   => 'required|exists:lokasis,id',
    ]);

    $aset = Aset::findOrFail($id);
    
    $aset->update([
        'kode_barang' => $request->kode_barang,
        'nama_aset'   => $request->nama_aset ?? $request->nama_barang,
        'kategori_id' => $request->kategori_id,
        'kondisi'     => $request->kondisi,
        'lokasi_id'   => $request->lokasi_id,
    ]);

    return redirect()->route('aset.index')->with('success', 'Data aset berhasil diperbarui!');
}

    public function destroy($id)
    {
        $aset = Aset::findOrFail($id);
        $aset->delete();

        return redirect()->route('aset.index')->with('success', 'Data aset berhasil dihapus!');
    }
}
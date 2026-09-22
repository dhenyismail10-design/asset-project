<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AsetController extends Controller
{
    public function index()
    {
    $aset = Aset::with('kategori')->latest()->get(); 
    return view('aset.index', compact('aset'));
    }

    public function create()
    {
        $categories = Kategori::all(); 
    return view('aset.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
        'kode_barang' => 'required|string|max:255',
        'nama_aset'   => 'required|string|max:255',
        'kategori_id' => 'required|exists:kategoris,id', // Validasi kategori
        'kondisi'     => 'required|string',
        'lokasi'      => 'nullable|string',
    ]);

    Aset::create($request->all());

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
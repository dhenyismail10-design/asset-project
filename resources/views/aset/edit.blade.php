@extends('layouts.app')

@section('content')
<style>
    .form-card {
        background: #ffffff;
        border: 1px solid #f1f5f9;
        border-radius: 18px;
        box-shadow: var(--card-shadow);
    }

    .form-control, .form-select {
        border-radius: 10px;
        border: 1px solid #cbd5e1;
        padding: 0.65rem 1rem;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    .form-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #475569;
        margin-bottom: 0.4rem;
    }
</style>

<div class="container-fluid p-0" style="max-width: 800px; margin: 0 auto;">
    <!-- Header Halaman -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h2 class="fw-800 text-slate-900 mb-1" style="font-weight: 800; letter-spacing: -0.5px;">Edit Data Aset</h2>
            <p class="text-muted mb-0 font-medium">Perbarui rincian informasi dan status aset inventaris.</p>
        </div>
        <a href="{{ route('aset.index') }}" class="btn btn-light border fw-semibold px-3 py-2 rounded-3">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="card form-card border-0 p-3 p-md-4">
        <div class="card-body">
            <form action="{{ route('aset.update', $aset->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Kode Barang <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted" style="border-radius: 10px 0 0 10px;"><i class="bi bi-qr-code"></i></span>
                            <input type="text" name="kode_barang" class="form-control border-start-0" style="border-radius: 0 10px 10px 0;" value="{{ old('kode_barang', $aset->kode_barang) }}" required>
                        </div>
                    </div>

                    <div class="col-md-6 mb-2">
                        <label class="form-label">Nama Barang <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted" style="border-radius: 10px 0 0 10px;"><i class="bi bi-box-seam"></i></span>
                            <!-- Menangani nilai fallback $aset->nama_aset atau $aset->nama_barang -->
                            <input type="text" name="nama_barang" class="form-control border-start-0" style="border-radius: 0 10px 10px 0;" value="{{ old('nama_barang', $aset->nama_aset ?? $aset->nama_barang) }}" required>
                        </div>
                    </div>

                    <div class="col-md-6 mb-2">
                        <label class="form-label">Kondisi <span class="text-danger">*</span></label>
                        <select name="kondisi" class="form-select" required>
                            <option value="Baik" {{ old('kondisi', $aset->kondisi) == 'Baik' ? 'selected' : '' }}>Baik</option>
                            <option value="Rusak Ringan" {{ old('kondisi', $aset->kondisi) == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                            <option value="Rusak Berat" {{ old('kondisi', $aset->kondisi) == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Lokasi</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted" style="border-radius: 10px 0 0 10px;"><i class="bi bi-geo-alt"></i></span>
                            <input type="text" name="lokasi" class="form-control border-start-0" style="border-radius: 0 10px 10px 0;" value="{{ old('lokasi', is_object($aset->lokasi) ? ($aset->lokasi->nama_lokasi ?? $aset->lokasi->nama) : $aset->lokasi) }}">
                        </div>
                    </div>
                </div>

                <hr class="my-4" style="border-color: #f1f5f9;">

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('aset.index') }}" class="btn btn-light fw-semibold px-4 py-2 rounded-3" style="border: 1px solid #cbd5e1;">Batal</a>
                    <button type="submit" class="btn btn-indigo text-white fw-semibold px-4 py-2 rounded-3 shadow-sm" style="background: #4f46e5; border: none;">
                        <i class="bi bi-check-lg me-1"></i> Perbarui Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
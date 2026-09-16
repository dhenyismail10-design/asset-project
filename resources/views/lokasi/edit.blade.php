@extends('layouts.app')

@section('content')
<style>
    .form-card {
        background: #ffffff;
        border: 1px solid #f1f5f9;
        border-radius: 18px;
        box-shadow: var(--card-shadow);
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #cbd5e1;
        padding: 0.65rem 1rem;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }

    .form-control:focus {
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

<div class="container-fluid p-0" style="max-width: 700px; margin: 0 auto;">
    <!-- Header Halaman -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h2 class="fw-800 text-slate-900 mb-1" style="font-weight: 800; letter-spacing: -0.5px;">Edit Lokasi</h2>
            <p class="text-muted mb-0 font-medium">Ubah dan perbarui informasi lokasi aset.</p>
        </div>
        <a href="{{ route('lokasi.index') }}" class="btn btn-light border fw-semibold px-3 py-2 rounded-3">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="card form-card border-0 p-3 p-md-4">
        <div class="card-body">
            <form action="{{ route('lokasi.update', $lokasi->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nama Lokasi -->
                <div class="mb-3">
                    <label for="nama_lokasi" class="form-label">Nama Lokasi <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted" style="border-radius: 10px 0 0 10px;">
                            <i class="bi bi-geo-alt"></i>
                        </span>
                        <input id="nama_lokasi" type="text" name="nama_lokasi" class="form-control border-start-0 @error('nama_lokasi') is-invalid @enderror" style="border-radius: 0 10px 10px 0;" value="{{ old('nama_lokasi', $lokasi->nama_lokasi ?? $lokasi->nama) }}" placeholder="Masukkan nama lokasi" required>
                        @error('nama_lokasi')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Alamat / Detail Lokasi -->
                <div class="mb-4">
                    <label for="alamat" class="form-label">Alamat / Keterangan Lokasi</label>
                    <textarea id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" placeholder="Masukkan alamat atau detail lokasi (opsional)">{{ old('alamat', $lokasi->alamat) }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <hr class="my-4" style="border-color: #f1f5f9;">

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('lokasi.index') }}" class="btn btn-light fw-semibold px-4 py-2 rounded-3" style="border: 1px solid #cbd5e1;">Batal</a>
                    <button type="submit" class="btn btn-indigo text-white fw-semibold px-4 py-2 rounded-3 shadow-sm" style="background: #4f46e5; border: none;">
                        <i class="bi bi-check-lg me-1"></i> Perbarui Lokasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
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
            <h2 class="fw-800 text-slate-900 mb-1" style="font-weight: 800; letter-spacing: -0.5px;">Edit Data Kategori</h2>
            <p class="text-muted mb-0 font-medium">Perbarui rincian informasi nama kategori inventaris.</p>
        </div>
        <a href="{{ route('kategori.index') }}" class="btn btn-light border fw-semibold px-3 py-2 rounded-3">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="card form-card border-0 p-3 p-md-4">
        <div class="card-body">
            <form action="{{ route('kategori.update', is_object($kategori) ? $kategori->id : $kategori) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="nama_kategori" class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted" style="border-radius: 10px 0 0 10px;">
                            <i class="bi bi-tag"></i>
                        </span>
                        <!-- Menangani pemanggilan kolom nama_kategori atau nama sebagai fallback -->
                        <input id="nama_kategori" type="text" name="nama_kategori" class="form-control border-start-0 @error('nama_kategori') is-invalid @enderror" style="border-radius: 0 10px 10px 0;" value="{{ old('nama_kategori', $kategori->nama_kategori ?? $kategori->nama ?? '') }}" placeholder="Masukkan nama kategori" required autofocus>
                        @error('nama_kategori')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr class="my-4" style="border-color: #f1f5f9;">

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('kategori.index') }}" class="btn btn-light fw-semibold px-4 py-2 rounded-3" style="border: 1px solid #cbd5e1;">Batal</a>
                    <button type="submit" class="btn btn-indigo text-white fw-semibold px-4 py-2 rounded-3 shadow-sm" style="background: #4f46e5; border: none;">
                        <i class="bi bi-check-lg me-1"></i> Perbarui Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
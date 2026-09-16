@extends('layouts.app')

@section('content')
<style>
    .detail-card {
        background: #ffffff;
        border: 1px solid #f1f5f9;
        border-radius: 18px;
        box-shadow: var(--card-shadow);
    }

    .info-label {
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #64748b;
        margin-bottom: 0.4rem;
    }

    .info-value {
        font-size: 1.1rem;
        font-weight: 600;
        color: #0f172a;
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 0.75rem 1rem;
    }

    .btn-action-edit {
        background-color: #fef3c7;
        color: #d97706;
        border: 1px solid #fde68a;
    }

    .btn-action-edit:hover {
        background-color: #fde68a;
        color: #b45309;
    }
</style>

<div class="container-fluid p-0" style="max-width: 700px; margin: 0 auto;">
    <!-- Header Halaman -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h2 class="fw-800 text-slate-900 mb-1" style="font-weight: 800; letter-spacing: -0.5px;">Detail Kategori</h2>
            <p class="text-muted mb-0 font-medium">Informasi rincian mengenai kategori aset inventaris.</p>
        </div>
        <a href="{{ route('kategori.index') }}" class="btn btn-light border fw-semibold px-3 py-2 rounded-3">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <!-- Detail Card -->
    <div class="card detail-card border-0 p-3 p-md-4">
        <div class="card-body">
            <div class="mb-4">
                <div class="info-label">Nama Kategori</div>
                <div class="info-value d-flex align-items-center gap-2">
                    <i class="bi bi-tag text-indigo" style="color: #4f46e5;"></i>
                    <span>{{ $kategori->nama_kategori ?? $kategori->nama ?? '-' }}</span>
                </div>
            </div>

            <hr class="my-4" style="border-color: #f1f5f9;">

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('kategori.index') }}" class="btn btn-light fw-semibold px-4 py-2 rounded-3" style="border: 1px solid #cbd5e1;">Kembali</a>
                <a href="{{ route('kategori.edit', is_object($kategori) ? $kategori->id : $kategori) }}" class="btn btn-action-edit fw-semibold px-4 py-2 rounded-3">
                    <i class="bi bi-pencil-square me-1"></i> Edit Data
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
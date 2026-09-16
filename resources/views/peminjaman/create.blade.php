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

<div class="container-fluid p-0" style="max-width: 700px; margin: 0 auto;">
    <!-- Header Halaman -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h2 class="fw-800 text-slate-900 mb-1" style="font-weight: 800; letter-spacing: -0.5px;">Tambah Peminjaman Aset</h2>
            <p class="text-muted mb-0 font-medium">Isi formulir di bawah ini untuk mencatat peminjaman baru.</p>
        </div>
        <a href="{{ route('peminjaman.index') }}" class="btn btn-light border fw-semibold px-3 py-2 rounded-3">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="card form-card border-0 p-3 p-md-4">
        <div class="card-body">

            <!-- Alert Error Validasi -->
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show border-0 rounded-3 shadow-sm mb-4" role="alert" style="background-color: #fee2e2; color: #991b1b;">
                    <div class="d-flex align-items-center mb-1">
                        <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                        <strong>Periksa kembali inputan Anda:</strong>
                    </div>
                    <ul class="mb-0 ps-4 small">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('peminjaman.store') }}" method="POST">
                @csrf

                <!-- Pilih Aset -->
                <div class="mb-3">
                    <label for="asset_id" class="form-label">Pilih Aset <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted" style="border-radius: 10px 0 0 10px;">
                            <i class="bi bi-box-seam"></i>
                        </span>
                        <select name="asset_id" id="asset_id" class="form-select border-start-0 @error('asset_id') is-invalid @enderror" style="border-radius: 0 10px 10px 0;" required>
                            <option value="" hidden>-- Pilih Aset --</option>
                            @foreach($assets as $asset)
                                <!-- PASTI-KAN value="{{ $asset->id }}" terisi seperti ini -->
                                <option value="{{ $asset->id }}" {{ old('asset_id') == $asset->id ? 'selected' : '' }}>
                                    {{ $asset->nama_barang ?? $asset->nama_aset ?? $asset->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('asset_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nama Peminjam -->
                <div class="mb-3">
                    <label for="peminjam" class="form-label">Nama Peminjam <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted" style="border-radius: 10px 0 0 10px;">
                            <i class="bi bi-person"></i>
                        </span>
                        <input type="text" name="peminjam" id="peminjam" class="form-control border-start-0 @error('peminjam') is-invalid @enderror" style="border-radius: 0 10px 10px 0;" placeholder="Masukkan nama peminjam" value="{{ old('peminjam') }}" required>
                    </div>
                    @error('peminjam')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tanggal Pinjam & Estimasi Kembali -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control @error('tanggal_pinjam') is-invalid @enderror" value="{{ old('tanggal_pinjam', date('Y-m-d')) }}" required>
                        @error('tanggal_pinjam')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="tanggal_kembali" class="form-label">Rencana Tanggal Kembali</label>
                        <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control @error('tanggal_kembali') is-invalid @enderror" value="{{ old('tanggal_kembali') }}">
                        @error('tanggal_kembali')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Kondisi Awal Saat Dipinjam -->
                <div class="mb-4">
                    <label for="kondisi_awal" class="form-label">Kondisi Awal Barang <span class="text-danger">*</span></label>
                    <select name="kondisi_awal" id="kondisi_awal" class="form-select @error('kondisi_awal') is-invalid @enderror" required>
                        <option value="Baik" {{ old('kondisi_awal') == 'Baik' ? 'selected' : '' }}>Baik</option>
                        <option value="Rusak Ringan" {{ old('kondisi_awal') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                        <option value="Rusak Berat" {{ old('kondisi_awal') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                    </select>
                    @error('kondisi_awal')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <hr class="my-4" style="border-color: #f1f5f9;">

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('peminjaman.index') }}" class="btn btn-light fw-semibold px-4 py-2 rounded-3" style="border: 1px solid #cbd5e1;">Batal</a>
                    <button type="submit" class="btn btn-indigo text-white fw-semibold px-4 py-2 rounded-3 shadow-sm" style="background: #4f46e5; border: none;">
                        <i class="bi bi-check-lg me-1"></i> Simpan Peminjaman
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection 
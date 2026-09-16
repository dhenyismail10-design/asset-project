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
            <h2 class="fw-800 text-slate-900 mb-1" style="font-weight: 800; letter-spacing: -0.5px;">Edit Pengembalian Aset</h2>
            <p class="text-muted mb-0 font-medium">Perbarui rincian data transaksi pengembalian aset.</p>
        </div>
        <a href="{{ route('pengembalian.index') }}" class="btn btn-light border fw-semibold px-3 py-2 rounded-3">
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

            <form action="{{ route('pengembalian.update', $pengembalian->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- ID / Transaksi Peminjaman -->
                <div class="mb-3">
                    <label for="peminjaman_id" class="form-label">ID Peminjaman <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted" style="border-radius: 10px 0 0 10px;">
                            <i class="bi bi-hash"></i>
                        </span>
                        <select name="peminjaman_id" id="peminjaman_id" class="form-select border-start-0 @error('peminjaman_id') is-invalid @enderror" style="border-radius: 0 10px 10px 0;" required>
                            <option value="" hidden>-- Pilih Peminjaman --</option>
                            @foreach ($peminjaman as $item)
                                <option value="{{ $item->id }}" {{ old('peminjaman_id', $pengembalian->peminjaman_id) == $item->id ? 'selected' : '' }}>
                                    #{{ $item->id }} - {{ $item->peminjam ?? $item->nama_peminjam ?? 'Peminjaman #' . $item->id }} 
                                    @if(isset($item->asset->nama_barang) || isset($item->asset->nama))
                                        ({{ $item->asset->nama_barang ?? $item->asset->nama }})
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('peminjaman_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tanggal Pengembalian -->
                <div class="mb-3">
                    <label for="tanggal_pengembalian" class="form-label">Tanggal Pengembalian <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted" style="border-radius: 10px 0 0 10px;">
                            <i class="bi bi-calendar-check"></i>
                        </span>
                        <input type="date" name="tanggal_pengembalian" id="tanggal_pengembalian" 
                            class="form-control border-start-0 @error('tanggal_pengembalian') is-invalid @enderror" style="border-radius: 0 10px 10px 0;"
                            value="{{ old('tanggal_pengembalian', $pengembalian->tanggal_pengembalian) }}" required>
                    </div>
                    @error('tanggal_pengembalian')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Status Pengembalian -->
                <div class="mb-4">
                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted" style="border-radius: 10px 0 0 10px;">
                            <i class="bi bi-info-circle"></i>
                        </span>
                        <select name="status" id="status" class="form-select border-start-0 @error('status') is-invalid @enderror" style="border-radius: 0 10px 10px 0;" required>
                            <option value="Selesai" {{ old('status', $pengembalian->status) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="Dikembalikan" {{ old('status', $pengembalian->status) == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                            <option value="Terlambat" {{ old('status', $pengembalian->status) == 'Terlambat' ? 'selected' : '' }}>Terlambat</option>
                        </select>
                    </div>
                    @error('status')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <hr class="my-4" style="border-color: #f1f5f9;">

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('pengembalian.index') }}" class="btn btn-light fw-semibold px-4 py-2 rounded-3" style="border: 1px solid #cbd5e1;">Batal</a>
                    <button type="submit" class="btn btn-warning text-white fw-semibold px-4 py-2 rounded-3 shadow-sm" style="background: #f59e0b; border: none;">
                        <i class="bi bi-check-lg me-1"></i> Perbarui Data
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
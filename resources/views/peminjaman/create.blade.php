<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peminjaman Aset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="p-4 bg-light">

    <div class="container my-3" style="max-width: 700px;">
        
        <!-- Header -->
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-secondary me-3">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <h3 class="fw-bold text-dark mb-0">Tambah Peminjaman Aset</h3>
                <p class="text-muted mb-0 small">Isi formulir di bawah ini untuk mencatat peminjaman baru.</p>
            </div>
        </div>

        <!-- Card Form -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">

                <!-- Alert Error Validasi -->
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mb-4">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('peminjaman.store') }}" method="POST">
                    @csrf

                    <!-- Pilih Aset -->
                    <div class="mb-3">
                        <label for="asset_id" class="form-label fw-semibold">Pilih Aset <span class="text-danger">*</span></label>
                        <select name="asset_id" id="asset_id" class="form-select" required>
                            <option value="" hidden>-- Pilih Aset --</option>
                            
                            @php $listAssets = $assets ?? $asets ?? []; @endphp
                            
                            @foreach($listAssets as $asset)
                                <option value="{{ $asset->id }}" {{ old('asset_id') == $asset->id ? 'selected' : '' }}>
                                    {{ $asset->nama_barang ?? $asset->nama }} ({{ $asset->kode_barang ?? $asset->kode ?? 'Tanpa Kode' }}) - Kondisi: {{ $asset->kondisi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Nama Peminjam -->
                    <div class="mb-3">
                        <label for="peminjam" class="form-label fw-semibold">Nama Peminjam <span class="text-danger">*</span></label>
                        <input type="text" name="peminjam" id="peminjam" class="form-control" placeholder="Masukkan nama peminjam" value="{{ old('peminjam') }}" required>
                    </div>

                    <!-- Tanggal Pinjam -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_pinjam" class="form-label fw-semibold">Tanggal Pinjam <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control" value="{{ old('tanggal_pinjam', date('Y-m-d')) }}" required>
                        </div>

                        <!-- Tanggal Estimasi Kembali -->
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_kembali" class="form-label fw-semibold">Rencana Tanggal Kembali</label>
                            <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control" value="{{ old('tanggal_kembali') }}">
                        </div>
                    </div>

                    <!-- Kondisi Awal Saat Dipinjam -->
                    <div class="mb-4">
                        <label for="kondisi_awal" class="form-label fw-semibold">Kondisi Awal Barang <span class="text-danger">*</span></label>
                        <select name="kondisi_awal" id="kondisi_awal" class="form-select" required>
                            <option value="Baik" {{ old('kondisi_awal') == 'Baik' ? 'selected' : '' }}>Baik</option>
                            <option value="Rusak Ringan" {{ old('kondisi_awal') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                            <option value="Rusak Berat" {{ old('kondisi_awal') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                        </select>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                        <a href="{{ route('peminjaman.index') }}" class="btn btn-light border px-4">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save me-1"></i> Simpan Peminjaman
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
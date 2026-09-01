<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Lokasi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light py-4">

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header">
            <h5 class="card-title mb-0">Tambah Lokasi</h5>
        </div>

        <form action="{{ route('lokasi.store') }}" method="POST">

            @csrf

            <div class="card-body">

                <div class="mb-3">
                    <label class="form-label">Nama Lokasi</label>

                    <input type="text"
                           name="nama_lokasi"
                           class="form-control @error('nama_lokasi') is-invalid @enderror"
                           value="{{ old('nama_lokasi') }}"
                           placeholder="Masukkan nama lokasi">

                    @error('nama_lokasi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>

                    <textarea name="alamat"
                              class="form-control @error('alamat') is-invalid @enderror"
                              rows="4"
                              placeholder="Masukkan alamat lokasi">{{ old('alamat') }}</textarea>

                    @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

            </div>

            <div class="card-footer text-end">

                <a href="{{ route('lokasi.index') }}" class="btn btn-secondary me-1">
                    Kembali
                </a>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>

            </div>

        </form>

    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
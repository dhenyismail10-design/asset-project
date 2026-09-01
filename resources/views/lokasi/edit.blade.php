<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Lokasi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light py-4">

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header">
            <h5 class="card-title mb-0">Detail Lokasi</h5>
        </div>

        <div class="card-body">

            <div class="mb-3">
                <label class="form-label fw-bold">Nama Lokasi</label>

                <input type="text"
                       class="form-control"
                       value="{{ $lokasi->nama_lokasi }}"
                       readonly>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Alamat</label>

                <textarea class="form-control"
                          rows="4"
                          readonly>{{ $lokasi->alamat }}</textarea>
            </div>

        </div>

        <div class="card-footer text-end">

            <a href="{{ route('lokasi.edit', $lokasi->id) }}"
               class="btn btn-warning text-white me-1">
                <i class="fas fa-edit"></i> Edit
            </a>

            <a href="{{ route('lokasi.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </div>

    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
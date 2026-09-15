<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="card shadow-sm border-0">
        <div class="card-header"><h5 class="mb-0">Detail Kategori</h5></div>
        <div class="card-body">
            <label class="form-label fw-bold">Nama Kategori</label>
            <input type="text" class="form-control" value="{{ $kategori->nama_kategori }}" readonly>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('kategori.edit', $kategori) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
</body>
</html>

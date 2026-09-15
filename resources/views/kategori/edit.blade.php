<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="card shadow-sm border-0">
        <div class="card-header"><h5 class="mb-0">Edit Kategori</h5></div>
        <form action="{{ route('kategori.update', $kategori) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <label for="nama_kategori" class="form-label">Nama Kategori</label>
                <input id="nama_kategori" type="text" name="nama_kategori" class="form-control @error('nama_kategori') is-invalid @enderror" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>
                @error('nama_kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Perbarui</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>

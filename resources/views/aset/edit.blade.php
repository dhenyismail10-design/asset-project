<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Aset</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">

    <div class="container" style="max-width: 600px;">
        
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                
                <h4 class="fw-bold mb-3">Edit Data Aset</h4>
                <hr class="mb-4">

                <form action="{{ route('aset.update', $aset->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kode Barang</label>
                        <input type="text" name="kode_barang" value="{{ old('kode_barang', $aset->kode_barang) }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Barang</label>
                        <input type="text" name="nama_barang" value="{{ old('nama_barang', $aset->nama_barang) }}" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kondisi</label>
                        <select name="kondisi" class="form-select" required>
                            <option value="Baik" {{ old('kondisi', $aset->kondisi) == 'Baik' ? 'selected' : '' }}>Baik</option>
                            <option value="Rusak Ringan" {{ old('kondisi', $aset->kondisi) == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                            <option value="Rusak Berat" {{ old('kondisi', $aset->kondisi) == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Lokasi</label>
                        <input type="text" name="lokasi" value="{{ old('lokasi', $aset->lokasi) }}" class="form-control">
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('aset.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>

            </div>
        </div>

    </div>

</body>
</html>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengembalian</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }

        .card-custom {
            width: 100%;
            max-width: 450px;
            background: #ffffff;
            border-radius: 8px;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            padding: 30px;
        }

        .form-label {
            font-size: 0.9rem;
            font-weight: 500;
            color: #212529;
            margin-bottom: 6px;
        }

        .form-control,
        .form-select {
            font-size: 0.9rem;
            padding: 8px 12px;
            border-color: #dee2e6;
            border-radius: 6px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        }

        .btn-custom {
            font-size: 0.9rem;
            padding: 7px 18px;
            border-radius: 6px;
            font-weight: 500;
        }
    </style>
</head>

<body>

    <div class="card-custom">
        <!-- Title & Divider -->
        <h4 class="fw-bold text-dark mb-3">Tambah Pengembalian</h4>
        <hr class="text-secondary mb-4" style="opacity: 0.15;">

        <!-- Alert Error -->
        @if ($errors->any())
            <div class="alert alert-danger py-2 px-3 mb-3 style="font-size: 0.85rem;">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Pengembalian -->
        <form action="{{ route('pengembalian.store') }}" method="POST">
            @csrf

            <!-- ID Peminjaman / Peminjam -->
            <div class="mb-3">
                <label for="peminjaman_id" class="form-label">ID Peminjaman</label>
                <select name="peminjaman_id" id="peminjaman_id" class="form-select @error('peminjaman_id') is-invalid @enderror" required>
                    <option value="" selected disabled>Pilih ID Peminjaman</option>
                    @foreach ($peminjaman as $item)
                        <option value="{{ $item->id }}" {{ old('peminjaman_id') == $item->id ? 'selected' : '' }}>
                            #{{ $item->id }} - {{ $item->nama_peminjam ?? 'Peminjaman #' . $item->id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tanggal Pengembalian -->
            <div class="mb-3">
                <label for="tanggal_pengembalian" class="form-label">Tanggal Pengembalian</label>
                <input type="date" name="tanggal_pengembalian" id="tanggal_pengembalian" 
                    class="form-control @error('tanggal_pengembalian') is-invalid @enderror" 
                    value="{{ old('tanggal_pengembalian', date('Y-m-d')) }}" required>
            </div>

            <!-- Status Pengembalian -->
            <div class="mb-4">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                    <option value="Selesai" {{ old('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="Dikembalikan" {{ old('status') == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                    <option value="Terlambat" {{ old('status') == 'Terlambat' ? 'selected' : '' }}>Terlambat</option>
                </select>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary btn-custom">Simpan</button>
                <a href="{{ route('pengembalian.index') }}" class="btn btn-secondary btn-custom">Batal</a>
            </div>
        </form>
    </div>

</body>

</html>
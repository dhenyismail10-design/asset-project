<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Data Aset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="p-4 bg-light">

    <div class="container my-3">
        
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-dark mb-1">
                    <i class="bi bi-box-seam me-2 text-primary"></i>Manajemen Data Aset
                </h2>
                <p class="text-muted mb-0">Kelola dan pantau seluruh inventaris serta aset organisasi secara terpusat.</p>
            </div>
            <a href="{{ route('aset.create') }}" class="btn btn-primary btn-lg fs-6 fw-semibold">
                <i class="bi bi-plus-lg me-1"></i> Tambah Aset Baru
            </a>
        </div>

        <!-- Alert Sukses -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Tabel Bergaris dengan Ukuran Proporsional (Tiga Utama: table-bordered, fs-5, py-3) -->
        <div class="card shadow-sm border-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0 fs-5">
                    <thead class="table-light text-uppercase">
                        <tr>
                            <th class="py-3 px-3 text-center" width="7%">No</th>
                            <th class="py-3 px-3 text-center" width="18%">Kode Barang</th>
                            <th class="py-3 px-3">Nama Barang</th>
                            <th class="py-3 px-3 text-center" width="18%">Kondisi</th>
                            <th class="py-3 px-3" width="22%">Lokasi</th>
                            <th class="py-3 px-3 text-center" width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($asets as $index => $item)
                        <tr>
                            <td class="py-3 px-3 text-center fw-bold text-muted">{{ $index + 1 }}</td>
                            <td class="py-3 px-3 text-center">
                                <span class="badge bg-light text-dark border font-monospace px-3 py-2 fs-6">
                                    {{ $item->kode_barang }}
                                </span>
                            </td>
                            <td class="py-3 px-3 fw-bold">{{ $item->nama_barang }}</td>
                            <td class="py-3 px-3 text-center fw-semibold">
                                @if($item->kondisi == 'Baik')
                                    <span class="text-success">BAIK</span>
                                @elseif($item->kondisi == 'Rusak Ringan')
                                    <span class="text-warning">RUSAK RINGAN</span>
                                @else
                                    <span class="text-danger">RUSAK BERAT</span>
                                @endif
                            </td>
                            <td class="py-3 px-3 text-muted">
                                <i class="bi bi-geo-alt me-1"></i>{{ $item->lokasi ?? '-' }}
                            </td>
                            <td class="py-3 px-3 text-center">
                                <a href="{{ route('aset.edit', $item->id) }}" class="btn btn-outline-warning border-0 fs-5 px-2 py-1 me-1" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('aset.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus aset ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger border-0 fs-5 px-2 py-1" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5 fs-6">
                                Belum ada data aset yang tersimpan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peminjaman Aset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="p-4 bg-light">

    <div class="container my-3">
        
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-dark mb-1">
                    <i class="bi bi-journal-text me-2 text-primary"></i>Riwayat Peminjaman Aset
                </h2>
                <p class="text-muted mb-0">Pantau dan kelola seluruh transaksi peminjaman barang.</p>
            </div>
            <div>
                <a href="{{ route('aset.index') }}" class="btn btn-outline-secondary me-2 fs-6 fw-semibold">
                    <i class="bi bi-box-seam me-1"></i> Data Aset
                </a>
                <a href="{{ route('peminjaman.create') }}" class="btn btn-primary fs-6 fw-semibold">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Peminjaman
                </a>
            </div>
        </div>

        <!-- Alert Sukses -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Tabel Data -->
        <div class="card shadow-sm border-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0 fs-6">
                    <thead class="table-light text-uppercase">
                        <tr>
                            <th class="py-3 px-3 text-center" width="5%">No</th>
                            <th class="py-3 px-3">Nama Aset</th>
                            <th class="py-3 px-3">Peminjam</th>
                            <th class="py-3 px-3 text-center">Tgl Pinjam</th>
                            <th class="py-3 px-3 text-center">Tgl Kembali</th>
                            <th class="py-3 px-3 text-center">Kondisi Awal</th>
                            <th class="py-3 px-3 text-center" width="12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peminjaman as $index => $item)
                        <tr>
                            <td class="py-3 px-3 text-center fw-bold text-muted">{{ $index + 1 }}</td>
                            <td class="py-3 px-3 fw-bold">
                                {{ $item->aset->nama_barang ?? 'Aset Dihapus' }}
                                <br><small class="text-muted font-monospace">{{ $item->aset->kode_barang ?? '-' }}</small>
                            </td>
                            <td class="py-3 px-3">{{ $item->peminjam }}</td>
                            <td class="py-3 px-3 text-center">{{ $item->tanggal_pinjam }}</td>
                            <td class="py-3 px-3 text-center">{{ $item->tanggal_kembali ?? '-' }}</td>
                            <td class="py-3 px-3 text-center fw-semibold">
                                @if($item->kondisi_awal == 'Baik')
                                    <span class="badge bg-success">BAIK</span>
                                @else
                                    <span class="badge bg-warning text-dark">RUSAK RINGAN</span>
                                @endif
                            </td>
                            <td class="py-3 px-3 text-center">
                                <form action="{{ route('peminjaman.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus riwayat peminjaman ini?')">
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
                            <td colspan="7" class="text-center text-muted py-5 fs-6">
                                Belum ada data peminjaman yang tersimpan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
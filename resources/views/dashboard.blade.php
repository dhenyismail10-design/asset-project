<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Manajemen Aset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        /* Layout Flexbox untuk Sidebar & Konten */
        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
            min-height: 100vh;
        }
        #sidebar {
            min-width: 260px;
            max-width: 260px;
            background: #212529;
            color: #fff;
            transition: all 0.3s;
        }
        #sidebar .sidebar-header {
            padding: 20px;
            background: #1a1d20;
            border-bottom: 1px solid #2d3238;
        }
        #sidebar ul.components {
            padding: 15px 0;
        }
        #sidebar ul p {
            color: #6c757d;
            padding: 10px 20px 5px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0;
        }
        #sidebar ul li a {
            padding: 12px 20px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            color: #ced4da;
            text-decoration: none;
            transition: 0.2s;
        }
        #sidebar ul li a:hover, #sidebar ul li a.active {
            color: #fff;
            background: #0d6efd;
        }
        #sidebar ul li a i {
            margin-right: 12px;
            font-size: 1.1rem;
        }
        #content {
            width: 100%;
            padding: 30px;
            min-height: 100vh;
        }
        .card-stat { transition: transform 0.2s; }
        .card-stat:hover { transform: translateY(-3px); }
    </style>
</head>
<body>

    <div class="wrapper">
        <!-- Sidebar Navigation -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h5 class="fw-bold mb-0 text-white">
                    <i class="bi bi-box-seam text-primary me-2"></i>Asset Management
                </h5>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="{{ route('dashboard') }}" class="active">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>

                <!-- Menu Master Aset -->
                <p>Master Aset</p>
                <li>
                    <a href="{{ Route::has('aset.index') ? route('aset.index') : url('/aset') }}">
                        <i class="bi bi-boxes"></i> Data Aset
                    </a>
                </li>
                <li>
                    <a href="{{ Route::has('aset.create') ? route('aset.create') : url('/aset/create') }}">
                        <i class="bi bi-plus-square"></i> Tambah Aset
                    </a>
                </li>

                <!-- Menu Transaksi Peminjaman -->
                <p>Peminjaman</p>
                <li>
                    <a href="{{ Route::has('peminjaman.index') ? route('peminjaman.index') : url('/peminjaman') }}">
                        <i class="bi bi-journal-text"></i> Riwayat Pinjam
                    </a>
                </li>
                <li>
                    <a href="{{ Route::has('peminjaman.create') ? route('peminjaman.create') : url('/peminjaman/create') }}">
                        <i class="bi bi-journal-plus"></i> Form Peminjaman
                    </a>
                </li>

                <!-- Menu Transaksi Pengembalian -->
                <p>Pengembalian</p>
                <li>
                    <a href="{{ Route::has('pengembalian.index') ? route('pengembalian.index') : url('/pengembalian') }}">
                        <i class="bi bi-arrow-return-left"></i> Riwayat Kembali
                    </a>
                </li>
                <li>
                    <a href="{{ Route::has('pengembalian.create') ? route('pengembalian.create') : url('/pengembalian/create') }}">
                        <i class="bi bi-box-arrow-in-down"></i> Form Pengembalian
                    </a>
                </li>

                <!-- Menu Master Lokasi -->
                <p>Pengaturan</p>
                <li>
                    <a href="{{ Route::has('lokasi.index') ? route('lokasi.index') : url('/lokasi') }}">
                        <i class="bi bi-geo-alt"></i> Data Lokasi
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content Area -->
        <div id="content">
            <!-- Header -->
            <div class="mb-4 d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="fw-bold text-dark mb-1">Dashboard</h2>
                    <p class="text-muted mb-0">Ringkasan status operasional dan statistik aset saat ini.</p>
                </div>
            </div>

            <!-- Kartu Ringkasan Statistik -->
            <div class="row g-3 mb-4">
                <!-- Total Aset -->
                <div class="col-md-3">
                    <div class="card card-stat border-0 shadow-sm border-start border-4 border-primary">
                        <div class="card-body p-3 d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted small fw-semibold text-uppercase">Total Aset</span>
                                <h3 class="fw-bold text-dark mb-0 mt-1">{{ $totalAset ?? 0 }}</h3>
                            </div>
                            <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-circle">
                                <i class="bi bi-boxes fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Peminjaman -->
                <div class="col-md-3">
                    <div class="card card-stat border-0 shadow-sm border-start border-4 border-warning">
                        <div class="card-body p-3 d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted small fw-semibold text-uppercase">Total Peminjaman</span>
                                <h3 class="fw-bold text-dark mb-0 mt-1">{{ $totalPeminjaman ?? 0 }}</h3>
                            </div>
                            <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-circle">
                                <i class="bi bi-journal-arrow-up fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Pengembalian -->
                <div class="col-md-3">
                    <div class="card card-stat border-0 shadow-sm border-start border-4 border-success">
                        <div class="card-body p-3 d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted small fw-semibold text-uppercase">Total Pengembalian</span>
                                <h3 class="fw-bold text-dark mb-0 mt-1">{{ $totalPengembalian ?? 0 }}</h3>
                            </div>
                            <div class="bg-success bg-opacity-10 text-success p-3 rounded-circle">
                                <i class="bi bi-journal-arrow-down fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Lokasi -->
                <div class="col-md-3">
                    <div class="card card-stat border-0 shadow-sm border-start border-4 border-info">
                        <div class="card-body p-3 d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted small fw-semibold text-uppercase">Total Lokasi</span>
                                <h3 class="fw-bold text-dark mb-0 mt-1">{{ $totalLokasi ?? 0 }}</h3>
                            </div>
                            <div class="bg-info bg-opacity-10 text-info p-3 rounded-circle">
                                <i class="bi bi-geo-alt fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Aktivitas Peminjaman Terbaru -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                    <h6 class="fw-bold mb-0 text-dark">
                        <i class="bi bi-clock-history me-2 text-primary"></i>Peminjaman Terbaru
                    </h6>
                    <a href="{{ Route::has('peminjaman.index') ? route('peminjaman.index') : url('/peminjaman') }}" class="btn btn-sm btn-link text-decoration-none">Lihat Semua</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Aset</th>
                                <th>Peminjam</th>
                                <th class="text-center">Tgl Pinjam</th>
                                <th class="text-center">Kondisi Awal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($peminjamanTerbaru ?? [] as $item)
                            <tr>
                                <td class="fw-semibold">
                                    {{ $item->aset->nama_barang ?? $item->aset->nama ?? 'Aset ID: '.$item->asset_id }}
                                </td>
                                <td>{{ $item->peminjam }}</td>
                                <td class="text-center">{{ $item->tanggal_pinjam }}</td>
                                <td class="text-center">
                                    @if($item->kondisi_awal == 'Baik')
                                        <span class="badge bg-success">Baik</span>
                                    @elseif($item->kondisi_awal == 'Rusak Ringan')
                                        <span class="badge bg-warning text-dark">Rusak Ringan</span>
                                    @else
                                        <span class="badge bg-danger">Rusak Berat</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Belum ada aktivitas peminjaman.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
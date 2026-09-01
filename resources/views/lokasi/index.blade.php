<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Lokasi - Asset Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        /* Layout Flexbox Sidebar & Konten */
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
                    <a href="{{ Route::has('dashboard') ? route('dashboard') : url('/dashboard') }}">
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
                    <a href="{{ Route::has('lokasi.index') ? route('lokasi.index') : url('/lokasi') }}" class="active">
                        <i class="bi bi-geo-alt"></i> Data Lokasi
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content Area -->
        <div id="content">
            
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold text-dark mb-1">
                        <i class="bi bi-geo-alt me-2 text-primary"></i>Data Lokasi
                    </h2>
                    <p class="text-muted mb-0">Kelola dan atur penempatan lokasi aset inventaris.</p>
                </div>
                <div>
                    <a href="{{ Route::has('lokasi.create') ? route('lokasi.create') : url('/lokasi/create') }}" class="btn btn-primary fw-semibold">
                        <i class="bi bi-plus-lg me-1"></i> Tambah Lokasi
                    </a>
                </div>
            </div>

            <!-- Alert Sukses -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Tabel Data Lokasi -->
            <div class="card border-0 shadow-sm">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead class="table-light text-uppercase">
                            <tr>
                                <th class="py-3 px-3 text-center" width="60">No</th>
                                <th class="py-3 px-3">Nama Lokasi</th>
                                <th class="py-3 px-3">Alamat</th>
                                <th class="py-3 px-3 text-center" width="120">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($lokasis as $lokasi)
                            <tr>
                                <td class="py-3 px-3 text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                <td class="py-3 px-3 fw-bold text-dark">
                                    {{ $lokasi->nama_lokasi ?? $lokasi->nama }}
                                </td>
                                <td class="py-3 px-3 text-secondary">
                                    {{ $lokasi->alamat ?? '-' }}
                                </td>
                                <td class="py-3 px-3 text-center">
                                    <a href="{{ Route::has('lokasi.edit') ? route('lokasi.edit', $lokasi->id) : url('/lokasi/'.$lokasi->id.'/edit') }}" 
                                       class="btn btn-outline-warning border-0 btn-sm me-1" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form action="{{ Route::has('lokasi.destroy') ? route('lokasi.destroy', $lokasi->id) : url('/lokasi/'.$lokasi->id) }}" 
                                          method="POST" class="d-inline" 
                                          onsubmit="return confirm('Yakin ingin menghapus lokasi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger border-0 btn-sm" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-5">
                                    Belum ada data lokasi.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
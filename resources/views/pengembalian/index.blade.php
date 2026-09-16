<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengembalian - Asset Project</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
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

        #sidebar ul li a:hover,
        #sidebar ul li a.active {
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
                    <a href="{{ Route::has('pengembalian.index') ? route('pengembalian.index') : url('/pengembalian') }}" class="active">
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
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold text-dark mb-1">
                        <i class="bi bi-arrow-return-left me-2 text-primary"></i>Data Pengembalian Asset
                    </h2>
                    <p class="text-muted mb-0">Kelola dan pantau seluruh data pengembalian aset terdaftar.</p>
                </div>
                <div>
                    <a href="{{ Route::has('pengembalian.create') ? route('pengembalian.create') : url('/pengembalian/create') }}"
                        class="btn btn-primary fw-semibold">
                        <i class="bi bi-plus-lg me-1"></i> Tambah Pengembalian
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

            <!-- Tabel Data Pengembalian -->
            <div class="card border-0 shadow-sm">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead class="table-light text-uppercase">
                            <tr>
                                <th class="py-3 px-3 text-center" width="5%">NO</th>
                                <th class="py-3 px-3">ID PEMINJAMAN</th>
                                <th class="py-3 px-3 text-center">TANGGAL PENGEMBALIAN</th>
                                <th class="py-3 px-3 text-center">STATUS</th>
                                <th class="py-3 px-3 text-center" width="12%">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pengembalian as $index => $item)
                                <tr>
                                    <td class="py-3 px-3 text-center fw-bold text-muted">{{ $index + 1 }}</td>
                                    <td class="py-3 px-3 fw-bold text-dark">
                                        <span class="badge bg-light text-dark border font-monospace px-2 py-1">
                                            #{{ $item->peminjaman_id }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-3 text-center">
                                        <i class="bi bi-calendar-check me-1 text-muted"></i>{{ $item->tanggal_pengembalian }}
                                    </td>
                                    <td class="py-3 px-3 text-center fw-semibold">
                                        @if($item->status == 'Selesai' || $item->status == 'Dikembalikan')
                                            <span class="badge bg-success">SELESAI</span>
                                        @else
                                            <span class="badge bg-warning text-dark">{{ strtoupper($item->status) }}</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-3 text-center">
                                        <a href="{{ Route::has('pengembalian.edit') ? route('pengembalian.edit', $item->id) : url('/pengembalian/' . $item->id . '/edit') }}"
                                            class="btn btn-outline-warning border-0 btn-sm me-1" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ Route::has('pengembalian.destroy') ? route('pengembalian.destroy', $item->id) : url('/pengembalian/' . $item->id) }}"
                                            method="POST" class="d-inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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
                                    <td colspan="5" class="text-center text-muted py-5">
                                        Belum ada data pengembalian yang tersimpan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
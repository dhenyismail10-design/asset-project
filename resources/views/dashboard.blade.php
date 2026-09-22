@extends('layouts.app')

@section('content')
<style>
    /* Metric Card Styling */
    .metric-card {
        background: #ffffff;
        border: 1px solid #f1f5f9;
        border-radius: 18px;
        box-shadow: var(--card-shadow);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .metric-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--card-shadow-hover);
    }

    .metric-icon-box {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
    }

    /* Gradient Backgrounds for Icons */
    .icon-indigo { background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%); color: #4338ca; }
    .icon-sky { background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%); color: #0369a1; }
    .icon-amber { background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); color: #b45309; }
    .icon-emerald { background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); color: #047857; }

    /* Custom Table Styling */
    .custom-table-card {
        background: #ffffff;
        border: 1px solid #f1f5f9;
        border-radius: 18px;
        box-shadow: var(--card-shadow);
    }

    .custom-table thead th {
        background-color: #f8fafc;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #64748b;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #f1f5f9;
    }

    .custom-table tbody td {
        padding: 1.1rem 1.5rem;
        color: #334155;
        font-size: 0.9rem;
        border-bottom: 1px solid #f8fafc;
    }

    .custom-table tbody tr:last-child td {
        border-bottom: none;
    }

    .custom-table tbody tr {
        transition: background-color 0.2s ease;
    }

    .custom-table tbody tr:hover {
        background-color: #f8fafc;
    }

    .badge-status {
        padding: 0.4em 0.8em;
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 8px;
        letter-spacing: 0.3px;
    }
</style>

<div class="container-fluid p-0">
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4 pb-2">
        <div>
            <h2 class="fw-800 text-slate-900 mb-1" style="font-weight: 800; letter-spacing: -0.5px;">Dashboard Management Aset</h2>
            <p class="text-muted mb-0 font-medium">Ringkasan real-time statistik data aset dan aktivitas transaksi.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ Route::has('aset.create') ? route('aset.create') : url('/aset/create') }}" class="btn btn-indigo text-white fw-semibold px-4 py-2 rounded-3 shadow-sm" style="background: #4f46e5; border: none;">
                <i class="bi bi-plus-lg me-1"></i> Tambah Aset Baru
            </a>
        </div>
    </div>

    <!-- Metric Cards Grid -->
    <div class="row g-4 mb-5">
        <!-- Total Aset -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card metric-card border-0 p-3">
                <div class="card-body p-2 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-uppercase fw-bold text-muted fs-7" style="letter-spacing: 0.5px; font-size: 0.75rem;">Total Aset</span>
                        <h2 class="fw-bold text-slate-900 mb-0 mt-2" style="font-size: 1.85rem;">{{ $totalAset ?? 0 }}</h2>
                    </div>
                    <div class="metric-icon-box icon-indigo">
                        <i class="bi bi-box-seam-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Kategori -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card metric-card border-0 p-3">
                <div class="card-body p-2 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-uppercase fw-bold text-muted fs-7" style="letter-spacing: 0.5px; font-size: 0.75rem;">Total Kategori</span>
                        <h2 class="fw-bold text-slate-900 mb-0 mt-2" style="font-size: 1.85rem;">{{ $totalKategori ?? 0 }}</h2>
                    </div>
                    <div class="metric-icon-box icon-sky">
                        <i class="bi bi-tags-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Peminjaman Active -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card metric-card border-0 p-3">
                <div class="card-body p-2 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-uppercase fw-bold text-muted fs-7" style="letter-spacing: 0.5px; font-size: 0.75rem;">Peminjaman</span>
                        <h2 class="fw-bold text-slate-900 mb-0 mt-2" style="font-size: 1.85rem;">{{ $totalPeminjaman ?? 0 }}</h2>
                    </div>
                    <div class="metric-icon-box icon-amber">
                        <i class="bi bi-arrow-left-right"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pengembalian -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card metric-card border-0 p-3">
                <div class="card-body p-2 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-uppercase fw-bold text-muted fs-7" style="letter-spacing: 0.5px; font-size: 0.75rem;">Pengembalian</span>
                        <h2 class="fw-bold text-slate-900 mb-0 mt-2" style="font-size: 1.85rem;">{{ $totalPengembalian ?? 0 }}</h2>
                    </div>
                    <div class="metric-icon-box icon-emerald">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="custom-table-card">
        <div class="p-4 d-flex justify-content-between align-items-center border-bottom border-light">
            <div>
                <h5 class="fw-bold text-slate-900 mb-0">Peminjaman Terbaru</h5>
                <small class="text-muted">Aktivitas transaksi peminjaman barang ter-update.</small>
            </div>
            <a href="{{ Route::has('peminjaman.index') ? route('peminjaman.index') : url('/peminjaman') }}" class="btn btn-sm btn-light text-indigo fw-semibold px-3 py-2 rounded-3" style="color: #4f46e5; background: #e0e7ff;">
                Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
        <div class="table-responsive">
            <table class="table custom-table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Peminjam</th>
                        <th>Nama Aset</th>
                        <th>Kategori</th>
                        <th>Tanggal Pinjam</th>
                        <th class="text-end">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peminjamanTerbaru as $item)
                        <tr>
                            <td>
                                <div class="fw-semibold text-slate-900">{{ $item->peminjam ?? '-' }}</div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-box text-muted"></i>
                                    <div>
                                        <div class="fw-semibold text-slate-900">
                                            {{ optional($item->aset)->nama_barang ?? optional($item->aset)->nama_aset ?? optional($item->aset)->nama ?? '-' }}
                                        </div>

                                        <!-- TAMPILAN LOKASI ASET AMAN -->
                                        <small class="text-muted d-block mt-0.5" style="font-size: 0.75rem;">
                                            <i class="bi bi-geo-alt me-1"></i>
                                            @if(optional($item->aset)->lokasi)
                                                {{ $item->aset->lokasi->nama_lokasi ?? $item->aset->lokasi->nama ?? $item->aset->lokasi->lokasi ?? '-' }}
                                            @else
                                                -
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border px-2 py-1 font-medium">
                                    {{ optional(optional($item->aset)->kategori)->nama_kategori ?? optional(optional($item->aset)->kategori)->nama ?? '-' }}
                                </span>
                            </td>
                            <td class="text-muted">
                                <i class="bi bi-calendar-event me-1"></i>
                                {{ $item->tanggal_pinjam ? \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') : '-' }}
                            </td>
                            <td class="text-end">
                                <span class="badge badge-status bg-warning bg-opacity-10 text-warning border border-warning border-opacity-20">
                                    {{ $item->status ?? 'Dipinjam' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="py-3">
                                    <i class="bi bi-inbox fs-1 text-muted opacity-50 d-block mb-2"></i>
                                    <span class="text-muted fw-medium">Belum ada transaksi peminjaman terbaru.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
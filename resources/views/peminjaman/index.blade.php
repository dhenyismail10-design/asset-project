@extends('layouts.app')

@section('content')
<style>
    /* Table Wrapper Card */
    .custom-table-card {
        background: #ffffff;
        border: 1px solid #f1f5f9;
        border-radius: 18px;
        box-shadow: var(--card-shadow);
        overflow: hidden;
    }

    .custom-table thead th {
        background-color: #f8fafc;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #64748b;
        padding: 1rem 1.25rem;
        border-bottom: 1px solid #f1f5f9;
    }

    .custom-table tbody td {
        padding: 1rem 1.25rem;
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

    .btn-action {
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .btn-action-delete {
        background-color: #fee2e2;
        color: #dc2626;
    }

    .btn-action-delete:hover {
        background-color: #fca5a5;
        color: #991b1b;
    }

    .badge-soft-success {
        background-color: #d1fae5;
        color: #065f46;
    }

    .badge-soft-warning {
        background-color: #fef3c7;
        color: #92400e;
    }

    .badge-soft-danger {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .badge-soft-secondary {
        background-color: #f1f5f9;
        color: #475569;
    }
</style>

<div class="container-fluid p-0">
    <!-- Header Halaman -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4 pb-2">
        <div>
            <h2 class="fw-800 text-slate-900 mb-1" style="font-weight: 800; letter-spacing: -0.5px;">Riwayat Peminjaman Aset</h2>
            <p class="text-muted mb-0 font-medium">Pantau dan kelola seluruh transaksi peminjaman barang.</p>
        </div>
        <div>
            <a href="{{ Route::has('peminjaman.create') ? route('peminjaman.create') : url('/peminjaman/create') }}" class="btn btn-indigo text-white fw-semibold px-4 py-2 rounded-3 shadow-sm" style="background: #4f46e5; border: none;">
                <i class="bi bi-plus-lg me-1"></i> Tambah Peminjaman
            </a>
        </div>
    </div>

    <!-- Alert Sukses -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 shadow-sm mb-4" role="alert" style="background-color: #d1fae5; color: #065f46;">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Tabel Data Peminjaman -->
    <div class="custom-table-card">
        <div class="table-responsive">
            <table class="table custom-table align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-center" width="5%">NO</th>
                        <th>NAMA ASET</th>
                        <th>PEMINJAM</th>
                        <th class="text-center">TGL PINJAM</th>
                        <th class="text-center">TGL KEMBALI</th>
                        <th class="text-center">KONDISI AWAL</th>
                        <th class="text-center" width="10%">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peminjaman as $key => $item)
                        <tr>
                            <td class="text-center fw-bold text-muted">
                                {{ method_exists($peminjaman, 'firstItem') ? $peminjaman->firstItem() + $key : $key + 1 }}
                            </td>
                            <td>
                                <div class="fw-semibold text-slate-900">
                                    {{ $item->aset->nama_barang ?? $item->aset->nama_aset ?? $item->aset->nama ?? 'Aset Dihapus / Tidak Ditemukan' }}
                                </div>
                                <small class="text-muted font-monospace" style="font-size: 0.8rem;">
                                    {{ $item->aset->kode_barang ?? $item->aset->kode_aset ?? $item->aset->kode ?? '-' }}
                                </small>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-person text-muted"></i>
                                    <span class="fw-medium text-slate-800">{{ $item->peminjam }}</span>
                                </div>
                            </td>
                            <td class="text-center text-secondary">
                                {{ $item->tanggal_pinjam ? \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') : '-' }}
                            </td>
                            <td class="text-center text-secondary">
                                {{ $item->tanggal_kembali ? \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') : '-' }}
                            </td>
                            <td class="text-center">
                                @if(strtolower($item->kondisi_awal) == 'baik')
                                    <span class="badge badge-soft-success px-3 py-2 rounded-pill fw-semibold" style="font-size: 0.75rem;">BAIK</span>
                                @elseif(strtolower($item->kondisi_awal) == 'rusak ringan')
                                    <span class="badge badge-soft-warning px-3 py-2 rounded-pill fw-semibold" style="font-size: 0.75rem;">RUSAK RINGAN</span>
                                @elseif(strtolower($item->kondisi_awal) == 'rusak berat')
                                    <span class="badge badge-soft-danger px-3 py-2 rounded-pill fw-semibold" style="font-size: 0.75rem;">RUSAK BERAT</span>
                                @else
                                    <span class="badge badge-soft-secondary px-3 py-2 rounded-pill fw-semibold" style="font-size: 0.75rem;">{{ strtoupper($item->kondisi_awal ?? '-') }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <form action="{{ Route::has('peminjaman.destroy') ? route('peminjaman.destroy', $item->id) : url('/peminjaman/'.$item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus riwayat peminjaman ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-action btn-action-delete border-0" title="Hapus Riwayat">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="py-3">
                                    <i class="bi bi-journal-x fs-1 text-muted opacity-50 d-block mb-2"></i>
                                    <span class="text-muted fw-medium">Belum ada data riwayat peminjaman.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($peminjaman, 'hasPages') && $peminjaman->hasPages())
            <div class="card-footer bg-white py-3 border-0">
                {{ $peminjaman->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
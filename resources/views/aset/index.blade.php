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

    .badge-code {
        background-color: #f1f5f9;
        color: #475569;
        font-family: monospace;
        font-weight: 600;
        padding: 0.35rem 0.65rem;
        border-radius: 6px;
        border: 1px solid #e2e8f0;
    }

    .badge-condition {
        padding: 0.4em 0.8em;
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 8px;
        letter-spacing: 0.3px;
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

    .btn-action-edit {
        background-color: #fef3c7;
        color: #d97706;
    }

    .btn-action-edit:hover {
        background-color: #fde68a;
        color: #b45309;
    }

    .btn-action-delete {
        background-color: #fee2e2;
        color: #dc2626;
    }

    .btn-action-delete:hover {
        background-color: #fca5a5;
        color: #991b1b;
    }
</style>

<div class="container-fluid p-0">
    <!-- Header Halaman -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4 pb-2">
        <div>
            <h2 class="fw-800 text-slate-900 mb-1" style="font-weight: 800; letter-spacing: -0.5px;">Manajemen Data Aset</h2>
            <p class="text-muted mb-0 font-medium">Kelola dan pantau seluruh inventaris serta aset organisasi secara terpusat.</p>
        </div>
        <div>
            <a href="{{ Route::has('aset.create') ? route('aset.create') : url('/aset/create') }}" class="btn btn-indigo text-white fw-semibold px-4 py-2 rounded-3 shadow-sm" style="background: #4f46e5; border: none;">
                <i class="bi bi-plus-lg me-1"></i> Tambah Aset Baru
            </a>
        </div>
    </div>

    <!-- Tabel Data Aset -->
    <div class="custom-table-card">
        <div class="table-responsive">
            <table class="table custom-table align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-center" width="5%">NO</th>
                        <th class="text-center">KODE BARANG</th>
                        <th>NAMA BARANG</th>
                        <th class="text-center">KONDISI</th>
                        <th class="text-center">LOKASI</th>
                        <th class="text-center" width="12%">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($asets as $index => $item)
                        <tr>
                            <td class="text-center fw-bold text-muted">{{ $index + 1 }}</td>
                            <td class="text-center">
                                <span class="badge-code">
                                    {{ $item->kode_barang ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <!-- Perbaikan utama: Mengambil $item->nama_aset atau $item->nama_barang -->
                                <div class="fw-semibold text-slate-900">
                                    {{ $item->nama_aset ?? $item->nama_barang ?? '-' }}
                                </div>
                            </td>
                            <td class="text-center">
                                @if($item->kondisi == 'Baik')
                                    <span class="badge badge-condition bg-success bg-opacity-10 text-success border border-success border-opacity-20">BAIK</span>
                                @elseif($item->kondisi == 'Rusak Ringan')
                                    <span class="badge badge-condition bg-warning bg-opacity-10 text-warning border border-warning border-opacity-20">RUSAK RINGAN</span>
                                @elseif($item->kondisi == 'Rusak Berat')
                                    <span class="badge badge-condition bg-danger bg-opacity-10 text-danger border border-danger border-opacity-20">RUSAK BERAT</span>
                                @else
                                    <span class="badge badge-condition bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-20">{{ strtoupper($item->kondisi ?? '-') }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-inline-flex align-items-center gap-1 text-muted">
                                    <i class="bi bi-geo-alt"></i>
                                    <span>{{ is_object($item->lokasi) ? ($item->lokasi->nama_lokasi ?? $item->lokasi->nama) : ($item->lokasi ?? '-') }}</span>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ Route::has('aset.edit') ? route('aset.edit', $item->id) : url('/aset/'.$item->id.'/edit') }}" class="btn btn-action btn-action-edit" title="Edit Data">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ Route::has('aset.destroy') ? route('aset.destroy', $item->id) : url('/aset/'.$item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus aset ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-action btn-action-delete" title="Hapus Data">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="py-3">
                                    <i class="bi bi-inbox fs-1 text-muted opacity-50 d-block mb-2"></i>
                                    <span class="text-muted fw-medium">Belum ada data aset yang tersimpan.</span>
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
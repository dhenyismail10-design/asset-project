@extends('layouts.app')

@section('content')
<style>
    .card-table {
        background: #ffffff;
        border: 1px solid #f1f5f9;
        border-radius: 16px;
        box-shadow: var(--card-shadow);
    }

    .table thead th {
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.05em;
        color: #64748b;
        background-color: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
    }

    .table tbody td {
        font-size: 0.875rem;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
    }

    .badge-status {
        padding: 0.35em 0.8em;
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 6px;
    }
</style>

<div class="container-fluid p-0">
    <!-- Header Halaman -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
        <div>
            <h2 class="fw-800 text-slate-900 mb-1" style="font-weight: 800; letter-spacing: -0.5px;">
                <i class="bi bi-arrow-return-left text-indigo me-2" style="color: #4f46e5;"></i>Data Pengembalian Aset
            </h2>
            <p class="text-muted mb-0 font-medium">Kelola dan pantau seluruh data pengembalian aset yang telah dicatat.</p>
        </div>
        <div>
            <a href="{{ Route::has('pengembalian.create') ? route('pengembalian.create') : url('/pengembalian/create') }}" 
               class="btn btn-indigo text-white fw-semibold px-4 py-2 rounded-3 shadow-sm" style="background: #4f46e5; border: none;">
                <i class="bi bi-plus-lg me-1"></i> Tambah Pengembalian
            </a>
        </div>
    </div>

    <!-- Alert Sukses -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 shadow-sm mb-4" role="alert" style="background-color: #d1fae5; color: #065f46;">
            <div class="d-flex align-items-center">
                <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                <div>{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Card Table -->
    <div class="card card-table border-0 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="py-3 px-4 text-center" width="5%">NO</th>
                        <th class="py-3 px-4">ID PEMINJAMAN</th>
                        <th class="py-3 px-4 text-center">TANGGAL PENGEMBALIAN</th>
                        <th class="py-3 px-4 text-center">STATUS</th>
                        <th class="py-3 px-4 text-center" width="12%">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pengembalian as $index => $item)
                        <tr>
                            <td class="py-3 px-4 text-center fw-bold text-muted">{{ $index + 1 }}</td>
                            <td class="py-3 px-4 fw-bold">
                                <span class="badge bg-light text-slate-700 border font-monospace px-2.5 py-1.5" style="border-color: #cbd5e1 !important; color: #334155;">
                                    #{{ $item->peminjaman_id }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <span class="text-slate-600">
                                    <i class="bi bi-calendar-check me-1 text-muted"></i>{{ $item->tanggal_pengembalian }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-center">
                                @if(in_array(strtolower($item->status), ['selesai', 'dikembalikan']))
                                    <span class="badge badge-status bg-emerald-100 text-emerald-800" style="background-color: #d1fae5; color: #065f46;">SELESAI</span>
                                @else
                                    <span class="badge badge-status bg-amber-100 text-amber-800" style="background-color: #fef3c7; color: #92400e;">{{ strtoupper($item->status) }}</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ Route::has('pengembalian.edit') ? route('pengembalian.edit', $item->id) : url('/pengembalian/' . $item->id . '/edit') }}"
                                       class="btn btn-sm btn-light text-amber-600 border-0 rounded-2" style="color: #d97706;" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ Route::has('pengembalian.destroy') ? route('pengembalian.destroy', $item->id) : url('/pengembalian/' . $item->id) }}"
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pengembalian ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light text-rose-600 border-0 rounded-2" style="color: #e11d48;" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">
                                <div class="py-3">
                                    <i class="bi bi-inbox fs-1 text-slate-300 d-block mb-2" style="color: #cbd5e1;"></i>
                                    <span>Belum ada data pengembalian yang tersimpan.</span>
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
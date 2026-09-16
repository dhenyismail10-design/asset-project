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
            <h2 class="fw-800 text-slate-900 mb-1" style="font-weight: 800; letter-spacing: -0.5px;">Data Kategori</h2>
            <p class="text-muted mb-0 font-medium">Kelola kelompok dan kategori pengelompokan aset inventaris.</p>
        </div>
        <div>
            <a href="{{ Route::has('kategori.create') ? route('kategori.create') : url('/kategori/create') }}" class="btn btn-indigo text-white fw-semibold px-4 py-2 rounded-3 shadow-sm" style="background: #4f46e5; border: none;">
                <i class="bi bi-plus-lg me-1"></i> Tambah Kategori
            </a>
        </div>
    </div>

    <!-- Tabel Data Kategori -->
    <div class="custom-table-card">
        <div class="table-responsive">
            <table class="table custom-table align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-center" width="8%">NO</th>
                        <th>NAMA KATEGORI</th>
                        <th class="text-center" width="15%">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategori as $key => $item)
                        <tr>
                            <td class="text-center fw-bold text-muted">
                                {{ method_exists($kategori, 'firstItem') ? $kategori->firstItem() + $key : $key + 1 }}
                            </td>
                            <td>
                                <div class="fw-semibold text-slate-900">{{ $item->nama_kategori ?? $item->nama }}</div>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ Route::has('kategori.edit') ? route('kategori.edit', $item->id) : url('/kategori/'.$item->id.'/edit') }}" class="btn btn-action btn-action-edit" title="Edit Data">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ Route::has('kategori.destroy') ? route('kategori.destroy', $item->id) : url('/kategori/'.$item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
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
                            <td colspan="3" class="text-center py-5">
                                <div class="py-3">
                                    <i class="bi bi-tags fs-1 text-muted opacity-50 d-block mb-2"></i>
                                    <span class="text-muted fw-medium">Belum ada data kategori yang tersimpan.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($kategori, 'hasPages') && $kategori->hasPages())
            <div class="card-footer bg-white py-3 border-0">
                {{ $kategori->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
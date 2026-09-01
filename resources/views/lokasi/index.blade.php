<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Lokasi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light py-4">

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Lokasi</h3>

        <a href="{{ route('lokasi.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Lokasi
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="card-title mb-0">Daftar Lokasi</h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">

                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th>Nama Lokasi</th>
                            <th>Alamat</th>
                            <th width="200">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($lokasis as $lokasi)

                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                {{ $lokasi->nama_lokasi }}
                            </td>

                            <td>
                                {{ $lokasi->alamat }}
                            </td>

                            <td>

                                <a href="{{ route('lokasi.show', $lokasi->id) }}"
                                   class="btn btn-info btn-sm text-white">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ route('lokasi.edit', $lokasi->id) }}"
                                   class="btn btn-warning btn-sm text-white">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('lokasi.destroy', $lokasi->id) }}"
                                      method="POST"
                                      style="display:inline">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus lokasi ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                </form>

                            </td>
                        </tr>

                        @empty

                        <tr>
                            <td colspan="4" class="text-center">
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
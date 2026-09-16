<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Aset</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        :root {
            --sidebar-bg: #0f172a;
            --sidebar-active: #6366f1;
            --body-bg: #f8fafc;
            --card-shadow: 0 10px 30px -5px rgba(15, 23, 42, 0.04), 0 4px 6px -2px rgba(15, 23, 42, 0.02);
            --card-shadow-hover: 0 20px 25px -5px rgba(15, 23, 42, 0.08), 0 8px 10px -6px rgba(15, 23, 42, 0.04);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--body-bg);
            color: #334155;
        }

        /* Premium Sidebar */
        .sidebar {
            width: 270px;
            min-height: 100vh;
            background-color: var(--sidebar-bg);
            border-right: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }

        .brand-logo {
            font-weight: 800;
            font-size: 1.15rem;
            letter-spacing: -0.5px;
            color: #ffffff;
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }

        .brand-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.35);
        }

        .nav-section-title {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: #64748b;
            padding: 1.5rem 1.5rem 0.5rem;
        }

        .sidebar .nav-link {
            color: #94a3b8;
            font-weight: 500;
            font-size: 0.9rem;
            padding: 0.75rem 1.25rem;
            margin: 0.2rem 1rem;
            border-radius: 10px;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
        }

        .sidebar .nav-link i {
            font-size: 1.15rem;
            margin-right: 0.85rem;
            transition: transform 0.2s ease;
        }

        .sidebar .nav-link:hover {
            color: #f8fafc;
            background-color: rgba(255, 255, 255, 0.05);
        }

        .sidebar .nav-link:hover i {
            transform: translateX(3px);
        }

        .sidebar .nav-link.active {
            color: #ffffff;
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
            font-weight: 600;
        }

        /* Top Bar Header */
        .top-navbar {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #e2e8f0;
            padding: 1rem 2rem;
        }

        /* Main Wrapper */
        .main-wrapper {
            flex: 1;
            overflow-y: auto;
            max-height: 100vh;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar Navigation -->
        <aside class="sidebar d-flex flex-column flex-shrink-0">
            <div class="brand-logo d-flex align-items-center gap-3">
                <div class="brand-icon">
                    <i class="bi bi-layers-fill text-white fs-5"></i>
                </div>
                <span>AssetHub<span class="text-indigo" style="color: #818cf8;">.</span></span>
            </div>

            <div class="nav-section-title">Menu Utama</div>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-grid-1x2-fill"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('aset.index') }}" class="nav-link {{ request()->routeIs('aset.*') ? 'active' : '' }}">
                        <i class="bi bi-box-seam-fill"></i> Data Aset
                    </a>
                </li>
                <li>
                    <a href="{{ route('kategori.index') }}" class="nav-link {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                        <i class="bi bi-tags-fill"></i> Kategori
                    </a>
                </li>
                <li>
                    <a href="{{ route('lokasi.index') }}" class="nav-link {{ request()->routeIs('lokasi.*') ? 'active' : '' }}">
                        <i class="bi bi-geo-alt-fill"></i> Lokasi
                    </a>
                </li>

                <div class="nav-section-title">Aktivitas</div>
                <li>
                    <a href="{{ route('peminjaman.index') }}" class="nav-link {{ request()->routeIs('peminjaman.*') ? 'active' : '' }}">
                        <i class="bi bi-arrow-left-right"></i> Peminjaman
                    </a>
                </li>
                <li>
                    <a href="{{ route('pengembalian.index') }}" class="nav-link {{ request()->routeIs('pengembalian.*') ? 'active' : '' }}">
                        <i class="bi bi-check-circle-fill"></i> Pengembalian
                    </a>
                </li>
            </ul>

            <div class="p-3 border-top border-secondary border-opacity-10">
                <div class="d-flex align-items-center gap-3 px-2 py-1">
                    <div class="rounded-circle bg-indigo text-white d-flex align-items-center justify-content-center fw-bold" style="width: 38px; height: 38px; background: #6366f1;">
                        A
                    </div>
                    <div class="lh-sm">
                        <div class="fw-semibold text-white fs-7">Administrator</div>
                        <small class="text-muted" style="font-size: 0.75rem;">admin@assethub.com</small>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="main-wrapper d-flex flex-column">
            <header class="top-navbar d-flex justify-content-between align-items-center sticky-top">
                <div class="fw-semibold text-slate-800">
                    <i class="bi bi-calendar3 me-2 text-muted"></i>{{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY') }}
                </div>
                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-light rounded-circle position-relative p-2" style="width: 40px; height: 40px;">
                        <i class="bi bi-bell text-secondary"></i>
                        <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
                    </button>
                </div>
            </header>

            <div class="p-4 p-md-5 flex-grow-1">
                @if(session('success'))
                    <div class="alert alert-emerald alert-dismissible fade show border-0 shadow-sm rounded-4 p-3 mb-4 text-white" style="background: #10b981;" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
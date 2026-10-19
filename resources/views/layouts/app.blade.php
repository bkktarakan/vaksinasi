<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Vaksinasi Internasional') - BKK Tarakan</title>
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #0284c7;
            --primary-hover: #0369a1;
            --primary-light: #e0f2fe;
            --accent: #06b6d4;
            --emerald: #10b981;
            --emerald-light: #d1fae5;
            --amber: #f59e0b;
            --amber-light: #fef3c7;
            --rose: #f43f5e;
            --rose-light: #ffe4e6;
            --dark: #0f172a;
            --slate-800: #1e293b;
            --slate-700: #334155;
            --slate-600: #475569;
            --slate-400: #94a3b8;
            --slate-200: #e2e8f0;
            --slate-100: #f1f5f9;
            --bg-canvas: #f8fafc;
            --sidebar-width: 270px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--bg-canvas);
            color: var(--slate-700);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Ambient background subtle gradient */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            height: 280px;
            background: linear-gradient(180deg, rgba(224, 242, 254, 0.4) 0%, rgba(248, 250, 252, 0) 100%);
            pointer-events: none;
            z-index: 0;
        }

        /* Modern Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(180deg, #0b1329 0%, #0f172a 100%);
            box-shadow: 4px 0 25px rgba(0, 0, 0, 0.15);
            z-index: 1050;
            display: flex;
            flex-direction: column;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow-y: auto;
        }

        .sidebar-brand-wrapper {
            padding: 24px 20px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            margin-bottom: 15px;
        }

        .sidebar-brand-card {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 14px;
            padding: 10px 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .sidebar-brand-card img {
            max-height: 38px;
            width: auto;
        }

        .sidebar-brand-text h6 {
            font-size: 0.88rem;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 0;
            letter-spacing: -0.3px;
        }

        .sidebar-brand-text span {
            font-size: 0.68rem;
            font-weight: 600;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: block;
        }

        /* Navigation Groups */
        .sidebar-menu {
            padding: 0 12px;
            flex: 1;
        }

        .menu-category-title {
            padding: 16px 14px 6px;
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #64748b;
        }

        .sidebar .nav-link {
            color: #94a3b8;
            padding: 11px 16px;
            margin: 3px 0;
            border-radius: 12px;
            font-size: 0.88rem;
            font-weight: 600;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            text-decoration: none;
            position: relative;
        }

        .sidebar .nav-link .nav-icon-label {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar .nav-link i {
            width: 20px;
            font-size: 1.05rem;
            text-align: center;
            color: #64748b;
            transition: all 0.2s ease;
        }

        .sidebar .nav-link:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.06);
            transform: translateX(4px);
        }

        .sidebar .nav-link:hover i {
            color: #38bdf8;
        }

        .sidebar .nav-link.active {
            color: #ffffff;
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            box-shadow: 0 4px 15px rgba(2, 132, 199, 0.4);
        }

        .sidebar .nav-link.active i {
            color: #ffffff;
        }

        .sidebar .nav-link .badge-new {
            background: rgba(6, 182, 212, 0.2);
            color: #38bdf8;
            border: 1px solid rgba(56, 189, 248, 0.3);
            font-size: 0.65rem;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 100px;
        }

        /* Sidebar User Profile Card */
        .sidebar-footer {
            padding: 16px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            background: rgba(0, 0, 0, 0.2);
        }

        .user-profile-badge {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            margin-bottom: 12px;
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: linear-gradient(135deg, #0284c7 0%, #06b6d4 100%);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.95rem;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(2, 132, 199, 0.4);
        }

        .user-info {
            overflow: hidden;
            flex: 1;
        }

        .user-name {
            font-size: 0.85rem;
            font-weight: 700;
            color: #ffffff;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 2px;
        }

        .user-wilker {
            font-size: 0.72rem;
            font-weight: 500;
            color: #7dd3fc;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .btn-sidebar-logout {
            width: 100%;
            background: rgba(239, 68, 68, 0.12);
            border: 1px solid rgba(239, 68, 68, 0.25);
            color: #f87171;
            font-size: 0.82rem;
            font-weight: 600;
            padding: 8px 12px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s ease;
        }

        .btn-sidebar-logout:hover {
            background: #ef4444;
            color: #ffffff;
            border-color: #ef4444;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        /* Topbar Header */
        .topbar {
            margin-left: var(--sidebar-width);
            height: 72px;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            position: sticky;
            top: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            transition: margin-left 0.3s ease;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .live-clock-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--slate-100);
            border: 1px solid var(--slate-200);
            padding: 6px 14px;
            border-radius: 100px;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--slate-600);
        }

        .live-clock-badge .status-ping {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: var(--emerald);
            box-shadow: 0 0 0 rgba(16, 185, 129, 0.4);
            animation: pingDot 2s infinite;
        }

        @keyframes pingDot {
            0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
            70% { box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); }
            100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }

        .btn-topbar-action {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-hover) 100%);
            color: #ffffff;
            border: none;
            padding: 8px 18px;
            border-radius: 100px;
            font-size: 0.85rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.3);
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .btn-topbar-action:hover {
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(2, 132, 199, 0.4);
        }

        /* Mobile Hamburger */
        .mobile-toggle-btn {
            display: none;
            background: transparent;
            border: none;
            font-size: 1.25rem;
            color: var(--slate-700);
            padding: 6px;
            cursor: pointer;
        }

        /* Main Content Wrapper */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            padding: 32px;
            min-height: calc(100vh - 72px);
            position: relative;
            z-index: 1;
            transition: margin-left 0.3s ease;
        }

        /* Modern Cards */
        .card {
            border: 1px solid rgba(226, 232, 240, 0.9);
            border-radius: 20px;
            box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.04);
            background: #ffffff;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 36px -6px rgba(15, 23, 42, 0.08);
            border-color: rgba(2, 132, 199, 0.25);
        }

        /* Forms and Inputs */
        .form-control, .form-select {
            border-radius: 12px;
            padding: 12px 16px;
            border: 1.5px solid var(--slate-200);
            background-color: var(--slate-50);
            font-size: 0.92rem;
            color: var(--dark);
            transition: all 0.2s ease;
        }

        .form-control:focus, .form-select:focus {
            background-color: #ffffff;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(2, 132, 199, 0.12);
        }

        .form-label {
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--slate-700);
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Tables */
        .table {
            vertical-align: middle;
            margin-bottom: 0;
        }

        .table thead th {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            color: var(--slate-400);
            background: var(--slate-50);
            padding: 14px 18px;
            border-bottom: 1px solid var(--slate-200);
        }

        .table tbody td {
            padding: 16px 18px;
            font-size: 0.9rem;
            color: var(--slate-700);
            border-bottom: 1px solid var(--slate-100);
        }

        .table-hover tbody tr {
            transition: background-color 0.15s ease;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(2, 132, 199, 0.03);
        }

        /* Badges */
        .badge-soft-primary {
            background-color: var(--primary-light);
            color: var(--primary);
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 100px;
        }

        .badge-soft-emerald {
            background-color: var(--emerald-light);
            color: #059669;
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 100px;
        }

        .badge-soft-amber {
            background-color: var(--amber-light);
            color: #d97706;
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 100px;
        }

        .badge-soft-rose {
            background-color: var(--rose-light);
            color: #e11d48;
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 100px;
        }

        /* Action Buttons */
        .btn-action-icon {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            border: 1px solid transparent;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .btn-action-icon.view {
            background: var(--primary-light);
            color: var(--primary);
        }
        .btn-action-icon.view:hover {
            background: var(--primary);
            color: #ffffff;
        }

        .btn-action-icon.edit {
            background: var(--amber-light);
            color: #d97706;
        }
        .btn-action-icon.edit:hover {
            background: #d97706;
            color: #ffffff;
        }

        .btn-action-icon.delete {
            background: var(--rose-light);
            color: #e11d48;
        }
        .btn-action-icon.delete:hover {
            background: #e11d48;
            color: #ffffff;
        }

        /* Modern Notification Alerts */
        .alert-modern {
            border: none;
            border-radius: 16px;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            box-shadow: 0 6px 20px -4px rgba(0, 0, 0, 0.06);
            margin-bottom: 24px;
            position: relative;
        }

        .alert-modern.success {
            background: #f0fdf4;
            color: #166534;
            border-left: 5px solid #22c55e;
        }

        .alert-modern.error {
            background: #fef2f2;
            color: #991b1b;
            border-left: 5px solid #ef4444;
        }

        /* Responsive Mobile Styles */
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .sidebar-backdrop {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(15, 23, 42, 0.6);
                backdrop-filter: blur(4px);
                z-index: 1040;
            }

            .sidebar-backdrop.show {
                display: block;
            }

            .topbar {
                margin-left: 0;
                padding: 0 16px;
            }

            .main-wrapper {
                margin-left: 0;
                padding: 20px 16px;
            }

            body::before {
                left: 0;
            }

            .mobile-toggle-btn {
                display: inline-block;
            }

            .live-clock-badge span.d-none-mobile {
                display: none;
            }
        }
    </style>
</head>
<body>

    <!-- Mobile Sidebar Backdrop -->
    <div class="sidebar-backdrop" id="sidebarBackdrop" onclick="toggleSidebar()"></div>

    <!-- Modern Sidebar -->
    <aside class="sidebar" id="sidebar">
        <!-- Brand Header -->
        <div class="sidebar-brand-wrapper">
            <div class="sidebar-brand-card">
                <img src="{{ asset('images/logo-bkk.png') }}" alt="BKK Tarakan Logo">
                <div class="sidebar-brand-text">
                    <h6>VAKSIN BKK</h6>
                    <span>Tarakan • e-ICV</span>
                </div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="sidebar-menu">
            <div class="menu-category-title">Menu Utama</div>
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span class="nav-icon-label">
                    <i class="fas fa-chart-pie"></i>
                    <span>Dashboard</span>
                </span>
            </a>
            <a href="{{ route('patients.create') }}" class="nav-link {{ request()->routeIs('patients.create') ? 'active' : '' }}">
                <span class="nav-icon-label">
                    <i class="fas fa-user-plus"></i>
                    <span>Registrasi Baru</span>
                </span>
                <span class="badge-new">New</span>
            </a>
            <a href="{{ route('patients.index') }}" class="nav-link {{ request()->routeIs('patients.index') && !request()->routeIs('patients.create') ? 'active' : '' }}">
                <span class="nav-icon-label">
                    <i class="fas fa-users"></i>
                    <span>Data Pasien</span>
                </span>
            </a>

            <div class="menu-category-title">Logistik & Medis</div>
            <a href="{{ route('vaccines.index') }}" class="nav-link {{ request()->routeIs('vaccines.*') ? 'active' : '' }}">
                <span class="nav-icon-label">
                    <i class="fas fa-vial-virus"></i>
                    <span>Master Vaksin</span>
                </span>
            </a>

            <div class="menu-category-title">Pelaporan</div>
            <a href="{{ route('reports.monthly') }}" class="nav-link {{ request()->routeIs('reports.monthly') ? 'active' : '' }}">
                <span class="nav-icon-label">
                    <i class="fas fa-file-invoice"></i>
                    <span>Laporan Bulanan</span>
                </span>
            </a>
        </nav>

        <!-- Sidebar User Profile Footer -->
        @auth
        <div class="sidebar-footer">
            <div class="user-profile-badge">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="user-info">
                    <div class="user-name">{{ auth()->user()->name }}</div>
                    <div class="user-wilker"><i class="fas fa-location-dot me-1"></i>{{ auth()->user()->wilker }}</div>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sidebar-logout">
                    <i class="fas fa-arrow-right-from-bracket"></i>
                    <span>Keluar dari Sistem</span>
                </button>
            </form>
        </div>
        @endauth
    </aside>

    <!-- Topbar Navigation -->
    <header class="topbar">
        <div class="topbar-left">
            <button type="button" class="mobile-toggle-btn" onclick="toggleSidebar()" aria-label="Toggle Menu">
                <i class="fas fa-bars"></i>
            </button>
            <div class="d-none d-sm-block">
                <span class="text-muted small fw-semibold text-uppercase" style="letter-spacing: 0.5px;">Sistem Informasi Vaksinasi Internasional</span>
            </div>
        </div>

        <div class="topbar-right">
            <!-- Live Clock / Location Pill -->
            <div class="live-clock-badge">
                <span class="status-ping"></span>
                <span id="liveClockDisplay">WITA • BKK Tarakan</span>
            </div>

            <!-- Quick Action Button -->
            <a href="{{ route('patients.create') }}" class="btn-topbar-action d-none d-md-inline-flex">
                <i class="fas fa-plus-circle"></i>
                <span>Registrasi Pasien</span>
            </a>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="main-wrapper">
        <!-- Flash Alert Success -->
        @if(session('success'))
            <div class="alert-modern success alert-dismissible fade show" role="alert">
                <i class="fas fa-circle-check fs-5 me-3 text-success"></i>
                <div class="flex-grow-1 fw-semibold">{{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Flash Alert Error -->
        @if(session('error'))
            <div class="alert-modern error alert-dismissible fade show" role="alert">
                <i class="fas fa-circle-exclamation fs-5 me-3 text-danger"></i>
                <div class="flex-grow-1 fw-semibold">{{ session('error') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    @yield('modals')

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Live Tarakan WITA Clock & Sidebar Toggle Script -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const backdrop = document.getElementById('sidebarBackdrop');
            sidebar.classList.toggle('show');
            backdrop.classList.toggle('show');
        }

        // Live Clock Updater (Tarakan / WITA: UTC+8)
        function updateLiveClock() {
            const options = { 
                timeZone: 'Asia/Makassar', 
                weekday: 'short', 
                day: 'numeric', 
                month: 'short', 
                hour: '2-digit', 
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            };
            const now = new Date();
            const timeString = new Intl.DateTimeFormat('id-ID', options).format(now);
            const el = document.getElementById('liveClockDisplay');
            if (el) {
                el.innerHTML = `<span class="d-none d-sm-inline">Tarakan:</span> ${timeString} WITA`;
            }
        }
        setInterval(updateLiveClock, 1000);
        updateLiveClock();
    </script>
</body>
</html>

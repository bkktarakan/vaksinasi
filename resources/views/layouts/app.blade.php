<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BKK Tarakan - Registrasi Vaksin Internasional</title>
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --primary-hover: #3f37c9;
            --secondary: #4cc9f0;
            --dark: #2b2d42;
            --light-bg: #f8f9fa;
            --sidebar-bg: #ffffff;
            --text-main: #333333;
            --text-muted: #8d99ae;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-bg);
            color: var(--text-main);
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            background: var(--sidebar-bg);
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.03);
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .sidebar-brand {
            padding: 30px 20px;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary);
            text-align: center;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            margin-bottom: 20px;
            letter-spacing: -0.5px;
        }

        .sidebar .nav-link {
            color: var(--text-muted);
            padding: 12px 25px;
            margin: 5px 15px;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
        }

        .sidebar .nav-link i {
            width: 24px;
            font-size: 1.1rem;
            margin-right: 10px;
            transition: all 0.2s ease;
        }

        .sidebar .nav-link:hover {
            color: var(--primary);
            background: rgba(67, 97, 238, 0.05);
            transform: translateX(5px);
        }

        .sidebar .nav-link.active {
            color: white;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
        }

        /* Main Content */
        .main-wrapper {
            margin-left: 260px;
            padding: 40px;
            min-height: 100vh;
        }

        /* Cards & Glassmorphism */
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.04);
            background: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.08);
        }

        /* Forms & Buttons */
        .form-control, .form-select {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #e9ecef;
            background-color: #f8f9fa;
            transition: all 0.2s ease;
        }

        .form-control:focus, .form-select:focus {
            background-color: white;
            border-color: var(--secondary);
            box-shadow: 0 0 0 4px rgba(76, 201, 240, 0.1);
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(67, 97, 238, 0.3);
        }

        /* Page Headers */
        .page-header {
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 30px;
            letter-spacing: -0.5px;
        }

        /* Table Styling */
        .table {
            vertical-align: middle;
        }
        
        .table th {
            font-weight: 600;
            color: var(--text-muted);
            border-bottom-width: 1px;
            padding: 15px;
        }

        .table td {
            padding: 15px;
            color: var(--text-main);
        }

        .table-hover tbody tr {
            transition: all 0.2s ease;
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.02);
            transform: scale(1.002);
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fadeIn 0.4s ease forwards;
        }
    </style>
</head>
<body>
    
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand p-3 d-flex justify-content-center align-items-center" style="border-bottom: 1px solid rgba(0,0,0,0.05); margin-bottom: 20px;">
            <img src="{{ asset('images/logo-bkk.png') }}" alt="BKK Tarakan" class="img-fluid" style="max-height: 50px;">
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-pie"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('vaccines.index') }}" class="nav-link {{ request()->routeIs('vaccines.*') ? 'active' : '' }}">
                    <i class="fas fa-vials"></i> Master Vaksin
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('patients.create') }}" class="nav-link {{ request()->routeIs('patients.create') ? 'active' : '' }}">
                    <i class="fas fa-user-plus"></i> Registrasi
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('patients.index') }}" class="nav-link {{ request()->routeIs('patients.index') && !request()->routeIs('patients.create') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> Data Pasien
                </a>
            </li>
            <li class="nav-item mt-4">
                <a href="{{ route('reports.monthly') }}" class="nav-link {{ request()->routeIs('reports.monthly') ? 'active' : '' }}">
                    <i class="fas fa-file-alt"></i> Laporan Bulanan
                </a>
            </li>
        </ul>
        
        @auth
        <div class="mt-auto px-4 pb-4" style="position: absolute; bottom: 0; width: 100%;">
            <hr class="border-secondary opacity-25">
            <div class="d-flex align-items-center mb-3">
                <div class="bg-primary bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">
                    <i class="fas fa-user-circle text-primary"></i>
                </div>
                <div>
                    <div class="fw-bold text-dark" style="font-size: 0.9rem;">{{ auth()->user()->name }}</div>
                    <div class="text-muted" style="font-size: 0.8rem;">{{ auth()->user()->wilker }}</div>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger w-100 rounded-pill">
                    <i class="fas fa-sign-out-alt me-1"></i> Keluar
                </button>
            </form>
        </div>
        @endauth
    </div>

    <!-- Main Content -->
    <div class="main-wrapper">
        <div class="container-fluid p-0 animate-fade-in">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 bg-white" role="alert" style="border-left: 4px solid #10b981 !important;">
                    <i class="fas fa-check-circle text-success me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 bg-white" role="alert" style="border-left: 4px solid #ef4444 !important;">
                    <i class="fas fa-exclamation-circle text-danger me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
    @yield('modals')

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

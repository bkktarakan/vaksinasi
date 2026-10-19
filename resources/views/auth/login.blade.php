<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Sistem Vaksinasi BKK Tarakan</title>
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #0284c7;
            --primary-hover: #0369a1;
            --primary-light: #e0f2fe;
            --accent: #06b6d4;
            --emerald: #10b981;
            --dark: #0f172a;
            --slate-600: #475569;
            --slate-400: #94a3b8;
            --slate-100: #f1f5f9;
            --slate-50: #f8fafc;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #0b1329;
            background-image: 
                radial-gradient(at 0% 0%, rgba(2, 132, 199, 0.25) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(6, 182, 212, 0.2) 0px, transparent 50%),
                radial-gradient(at 50% 50%, rgba(15, 23, 42, 0.9) 0px, transparent 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            color: #1e293b;
            position: relative;
            overflow-x: hidden;
        }

        /* Ambient Glow Spheres */
        body::before {
            content: '';
            position: absolute;
            width: 450px;
            height: 450px;
            background: radial-gradient(circle, rgba(14, 165, 233, 0.2) 0%, transparent 70%);
            top: -100px;
            left: -100px;
            border-radius: 50%;
            pointer-events: none;
            filter: blur(40px);
        }

        body::after {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.15) 0%, transparent 70%);
            bottom: -100px;
            right: -100px;
            border-radius: 50%;
            pointer-events: none;
            filter: blur(40px);
        }

        .login-wrapper {
            width: 100%;
            max-width: 1060px;
            position: relative;
            z-index: 10;
        }

        .login-card {
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 
                0 25px 60px -15px rgba(0, 0, 0, 0.35),
                0 0 0 1px rgba(255, 255, 255, 0.15);
            overflow: hidden;
            border: none;
        }

        /* Left Hero Column */
        .login-hero {
            background: linear-gradient(145deg, #0f172a 0%, #0c2340 50%, #034870 100%);
            color: #ffffff;
            padding: 56px 44px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .login-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: radial-gradient(rgba(255, 255, 255, 0.08) 1px, transparent 1px);
            background-size: 24px 24px;
            opacity: 0.7;
            pointer-events: none;
        }

        .login-hero-content {
            position: relative;
            z-index: 2;
        }

        .org-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 6px 14px;
            border-radius: 100px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            color: #7dd3fc;
            margin-bottom: 30px;
        }

        .org-badge .pulse-dot {
            width: 7px;
            height: 7px;
            background-color: #38bdf8;
            border-radius: 50%;
            box-shadow: 0 0 10px #38bdf8;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(56, 189, 248, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 8px rgba(56, 189, 248, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(56, 189, 248, 0); }
        }

        .brand-logo-container {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 18px;
            padding: 14px 20px;
            display: inline-block;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
            margin-bottom: 28px;
        }

        .brand-logo-container img {
            max-height: 52px;
            width: auto;
            display: block;
        }

        .login-hero h1 {
            font-size: 1.85rem;
            font-weight: 800;
            line-height: 1.25;
            letter-spacing: -0.5px;
            margin-bottom: 14px;
            background: linear-gradient(135deg, #ffffff 0%, #e0f2fe 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .login-hero p.lead-text {
            color: #94a3b8;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 36px;
        }

        /* Feature List */
        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            margin-bottom: 18px;
        }

        .feature-icon-box {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: rgba(2, 132, 199, 0.25);
            border: 1px solid rgba(56, 189, 248, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #38bdf8;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .feature-text h6 {
            font-size: 0.88rem;
            font-weight: 700;
            margin-bottom: 2px;
            color: #f1f5f9;
        }

        .feature-text p {
            font-size: 0.78rem;
            color: #94a3b8;
            margin-bottom: 0;
            line-height: 1.4;
        }

        .hero-footer {
            position: relative;
            z-index: 2;
            padding-top: 24px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.78rem;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* Right Form Area */
        .login-form-area {
            padding: 56px 48px;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        @media (max-width: 576px) {
            .login-form-area {
                padding: 36px 24px;
            }
        }

        .form-header-badge {
            width: 44px;
            height: 44px;
            background: #f0f9ff;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.25rem;
            margin-bottom: 16px;
        }

        .form-title {
            font-size: 1.7rem;
            font-weight: 800;
            color: var(--dark);
            letter-spacing: -0.5px;
            margin-bottom: 6px;
        }

        .form-subtitle {
            color: var(--slate-600);
            font-size: 0.92rem;
            margin-bottom: 26px;
        }

        /* Quick Account Chips */
        .quick-accounts-box {
            background: var(--slate-50);
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 12px 14px;
            margin-bottom: 26px;
        }

        .quick-accounts-title {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--slate-400);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .quick-chips-container {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .account-chip {
            border: 1px solid #cbd5e1;
            background: #ffffff;
            color: #334155;
            font-size: 0.78rem;
            font-weight: 600;
            padding: 5px 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .account-chip:hover {
            border-color: var(--primary);
            background: var(--primary-light);
            color: var(--primary);
            transform: translateY(-1px);
        }

        .account-chip.active {
            border-color: var(--primary);
            background: var(--primary);
            color: #ffffff;
            box-shadow: 0 4px 10px rgba(2, 132, 199, 0.3);
        }

        /* Modern Input Group */
        .input-group-modern {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group-modern label {
            display: block;
            font-size: 0.8rem;
            font-weight: 700;
            color: #334155;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .input-box {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon-left {
            position: absolute;
            left: 16px;
            color: #94a3b8;
            font-size: 1rem;
            transition: color 0.2s ease;
            pointer-events: none;
        }

        .input-box .form-control {
            height: 52px;
            padding: 12px 16px 12px 46px;
            border-radius: 12px;
            border: 1.5px solid #e2e8f0;
            background-color: #f8fafc;
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--dark);
            transition: all 0.25s ease;
        }

        .input-box .form-control:focus {
            background-color: #ffffff;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(2, 132, 199, 0.12);
            outline: none;
        }

        .input-box .form-control:focus + .input-icon-left,
        .input-box:focus-within .input-icon-left {
            color: var(--primary);
        }

        .password-toggle-btn {
            position: absolute;
            right: 14px;
            background: transparent;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            padding: 8px;
            font-size: 0.95rem;
            transition: color 0.2s ease;
        }

        .password-toggle-btn:hover {
            color: var(--dark);
        }

        /* Submit Button */
        .btn-submit-login {
            height: 54px;
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            border: none;
            border-radius: 12px;
            color: #ffffff;
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: 0.2px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 20px -5px rgba(2, 132, 199, 0.4);
            margin-top: 10px;
        }

        .btn-submit-login:hover {
            background: linear-gradient(135deg, #0369a1 0%, #075985 100%);
            transform: translateY(-2px);
            box-shadow: 0 14px 28px -5px rgba(2, 132, 199, 0.5);
            color: #ffffff;
        }

        .btn-submit-login:active {
            transform: translateY(0);
        }

        .security-badge {
            margin-top: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 0.78rem;
            color: #94a3b8;
        }

        .security-badge i {
            color: var(--emerald);
        }
    </style>
</head>
<body>

    <div class="login-wrapper">
        <div class="card login-card">
            <div class="row g-0">
                <!-- Left Hero Section -->
                <div class="col-lg-5 d-none d-lg-flex login-hero">
                    <div class="login-hero-content">
                        <div class="org-badge">
                            <span class="pulse-dot"></span>
                            BKK Tarakan • Kemenkes RI
                        </div>

                        <div class="brand-logo-container">
                            <img src="{{ asset('images/logo-bkk.png') }}" alt="Logo BKK Tarakan">
                        </div>

                        <h1>Sistem Vaksinasi Internasional</h1>
                        <p class="lead-text">
                            Pencatatan data pasien, pengawasan logistik vaksin, dan penerbitan sertifikat vaksinasi internasional (e-ICV) resmi.
                        </p>

                        <!-- Feature highlights -->
                        <div class="feature-item">
                            <div class="feature-icon-box">
                                <i class="fas fa-shield-virus"></i>
                            </div>
                            <div class="feature-text">
                                <h6>Standar e-ICV Kemenkes</h6>
                                <p>Format penerbitan sertifikat valid dan terverifikasi internasional.</p>
                            </div>
                        </div>

                        <div class="feature-item">
                            <div class="feature-icon-box">
                                <i class="fas fa-network-wired"></i>
                            </div>
                            <div class="feature-text">
                                <h6>Sinkronisasi Antar Wilker</h6>
                                <p>Terhubung langsung antara Kantor Induk dan seluruh Wilker operasional.</p>
                            </div>
                        </div>

                        <div class="feature-item">
                            <div class="feature-icon-box">
                                <i class="fas fa-boxes-stacked"></i>
                            </div>
                            <div class="feature-text">
                                <h6>Manajemen Stok Real-time</h6>
                                <p>Pemantauan akurat ketersediaan vaksin Yellow Fever, Meningitis, dll.</p>
                            </div>
                        </div>
                    </div>

                    <div class="hero-footer">
                        <span><i class="fas fa-lock me-1"></i> 256-Bit SSL Secured</span>
                        <span>v1.2 Enterprise</span>
                    </div>
                </div>

                <!-- Right Form Section -->
                <div class="col-lg-7 login-form-area">
                    <!-- Mobile Brand Display -->
                    <div class="d-lg-none text-center mb-4">
                        <img src="{{ asset('images/logo-bkk.png') }}" alt="Logo BKK Tarakan" style="max-height: 48px;" class="mb-3">
                        <h4 class="fw-bold text-dark mb-1">Vaksin BKK Tarakan</h4>
                        <p class="text-muted small">Sistem Registrasi Vaksinasi Internasional</p>
                    </div>

                    <div class="form-header-badge d-none d-lg-flex">
                        <i class="fas fa-user-lock"></i>
                    </div>

                    <h2 class="form-title">Masuk ke Sistem</h2>
                    <p class="form-subtitle">Silakan masukkan username dan kata sandi akun Wilker Anda.</p>

                    @if(session('error'))
                        <div class="alert alert-danger border-0 shadow-sm rounded-3 py-3 px-3 mb-4 d-flex align-items-center" role="alert" style="background-color: #fef2f2; border-left: 4px solid #ef4444 !important;">
                            <i class="fas fa-exclamation-circle text-danger fs-5 me-2"></i>
                            <div class="text-danger fw-semibold small">{{ session('error') }}</div>
                        </div>
                    @endif

                    <!-- Quick Account Selector Chips -->
                    <div class="quick-accounts-box">
                        <div class="quick-accounts-title">
                            <i class="fas fa-bolt text-warning"></i> Pilih Cepat Akun Wilker:
                        </div>
                        <div class="quick-chips-container">
                            <button type="button" class="account-chip" onclick="fillAccount('induk', 'password', this)">
                                <i class="fas fa-building text-primary"></i> Kantor Induk
                            </button>
                            <button type="button" class="account-chip" onclick="fillAccount('nunukan', 'password', this)">
                                <i class="fas fa-anchor text-info"></i> Nunukan
                            </button>
                            <button type="button" class="account-chip" onclick="fillAccount('tanjung_selor', 'password', this)">
                                <i class="fas fa-landmark text-success"></i> Tj. Selor
                            </button>
                            <button type="button" class="account-chip" onclick="fillAccount('berau', 'password', this)">
                                <i class="fas fa-water text-cyan"></i> Berau
                            </button>
                        </div>
                    </div>

                    <form action="{{ route('login.post') }}" method="POST" id="loginForm">
                        @csrf
                        
                        <!-- Username -->
                        <div class="input-group-modern">
                            <label for="usernameInput">Username</label>
                            <div class="input-box">
                                <i class="fas fa-user-shield input-icon-left"></i>
                                <input type="text" 
                                       id="usernameInput" 
                                       name="username" 
                                       class="form-control @error('username') is-invalid @enderror" 
                                       value="{{ old('username') }}" 
                                       placeholder="Ketik username Anda" 
                                       required 
                                       autofocus 
                                       autocomplete="username">
                            </div>
                            @error('username')
                                <div class="text-danger small mt-1 fw-semibold">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="input-group-modern">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label for="passwordInput" class="mb-0">Kata Sandi</label>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock input-icon-left"></i>
                                <input type="password" 
                                       id="passwordInput" 
                                       name="password" 
                                       class="form-control" 
                                       placeholder="••••••••" 
                                       required 
                                       autocomplete="current-password">
                                <button type="button" class="password-toggle-btn" id="passwordToggleBtn" onclick="togglePasswordVisibility()" title="Lihat Kata Sandi">
                                    <i class="far fa-eye" id="passwordToggleIcon"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-submit-login" id="submitBtn">
                                <span>Masuk ke Dashboard</span>
                                <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </form>

                    <div class="security-badge">
                        <i class="fas fa-shield-alt"></i>
                        <span>Sistem Resmi Balai Kekarantinaan Kesehatan Tarakan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script for interactive quick filling & password toggle -->
    <script>
        function fillAccount(username, password, buttonElement) {
            const usernameInput = document.getElementById('usernameInput');
            const passwordInput = document.getElementById('passwordInput');
            
            usernameInput.value = username;
            passwordInput.value = password;

            // Highlight chips
            document.querySelectorAll('.account-chip').forEach(chip => chip.classList.remove('active'));
            if (buttonElement) {
                buttonElement.classList.add('active');
            }

            // Animate focus
            usernameInput.focus();
        }

        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('passwordInput');
            const icon = document.getElementById('passwordToggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>

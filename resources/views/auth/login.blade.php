<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Vaksin BKK</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .login-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .login-sidebar {
            background: linear-gradient(135deg, #4361ee 0%, #4cc9f0 100%);
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .login-form-area {
            padding: 50px;
            background: white;
        }
        .form-control {
            padding: 12px 20px;
            border-radius: 10px;
            border: 1px solid #e0e0e0;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
            border-color: #4361ee;
        }
        .btn-primary {
            background-color: #4361ee;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
        }
        .btn-primary:hover {
            background-color: #3a56d4;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-xl-8">
                <div class="card login-card">
                    <div class="row g-0">
                        <div class="col-md-5 d-none d-md-flex p-0 login-sidebar">
                            <div class="text-center w-100">
                                <img src="{{ asset('images/logo-bkk.png') }}" alt="Logo BKK" style="max-width: 80%; max-height: 80px; object-fit: contain;" class="mb-4">
                                <h2 class="fw-bold mb-3">Vaksin BKK</h2>
                                <p class="mb-0" style="color: rgba(255,255,255,0.9); font-size: 1.05rem; line-height: 1.5;">Sistem Registrasi & Inventori<br>Vaksinasi Internasional</p>
                            </div>
                        </div>
                        <div class="col-md-7 login-form-area">
                            <div class="text-center d-md-none mb-4">
                                <img src="{{ asset('images/logo-bkk.png') }}" alt="Logo BKK" style="height: 60px;" class="mb-3">
                                <h3 class="fw-bold">Vaksin BKK</h3>
                            </div>
                            <h4 class="fw-bold text-dark mb-1">Selamat Datang</h4>
                            <p class="text-muted mb-4">Silakan masuk menggunakan akun Wilker Anda.</p>

                            @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <form action="{{ route('login.post') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label class="form-label fw-semibold text-muted small text-uppercase">Username</label>
                                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" placeholder="Masukkan username" required autofocus>
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-semibold text-muted small text-uppercase">Kata Sandi</label>
                                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                                </div>
                                <div class="d-grid mt-5">
                                    <button type="submit" class="btn btn-primary btn-lg">Masuk ke Sistem</button>
                                </div>
                            </form>
                            
                            <div class="text-center mt-4">
                                <p class="text-muted small mb-0">Daftar Akun: <b>induk, nunukan, tanjung_selor, berau</b><br>Password: <b>password</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Welcome Hero Banner -->
<div class="card border-0 mb-4 overflow-hidden" style="background: linear-gradient(135deg, #0284c7 0%, #0369a1 60%, #0c4a6e 100%); border-radius: 24px; box-shadow: 0 10px 30px -5px rgba(2, 132, 199, 0.4);">
    <div class="card-body p-4 p-lg-5 position-relative text-white">
        <!-- Ambient decorative shapes -->
        <div style="position: absolute; right: -30px; bottom: -30px; width: 260px; height: 260px; background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%); border-radius: 50%; pointer-events: none;"></div>
        <div style="position: absolute; right: 180px; top: -50px; width: 180px; height: 180px; background: radial-gradient(circle, rgba(6,182,212,0.2) 0%, transparent 70%); border-radius: 50%; pointer-events: none;"></div>

        <div class="row align-items-center position-relative" style="z-index: 2;">
            <div class="col-lg-8 mb-4 mb-lg-0">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-3" style="background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.25); font-size: 0.8rem; font-weight: 600;">
                    <i class="fas fa-location-dot text-info"></i>
                    <span>{{ auth()->user()->wilker }}</span>
                    <span class="mx-1">•</span>
                    <span>Wilker Terverifikasi</span>
                </div>
                <h2 class="fw-bold mb-2" style="letter-spacing: -0.5px; font-size: 1.85rem;">
                    Selamat Bertugas, {{ auth()->user()->name }}! 👋
                </h2>
                <p class="mb-0 text-white-50" style="font-size: 0.95rem; line-height: 1.6; max-width: 600px;">
                    Kelola data registrasi pasien internasional, monitoring ketersediaan stok vaksin, dan pantau rekapitulasi pelayanan vaksinasi secara real-time.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <div class="d-flex flex-column flex-sm-row justify-content-lg-end gap-2">
                    <a href="{{ route('patients.create') }}" class="btn btn-light shadow-sm fw-bold px-4 py-2" style="border-radius: 12px; color: var(--primary);">
                        <i class="fas fa-user-plus me-2"></i>Registrasi Baru
                    </a>
                    <a href="{{ route('vaccines.create') }}" class="btn btn-outline-light fw-bold px-4 py-2" style="border-radius: 12px;">
                        <i class="fas fa-plus me-2"></i>Tambah Stok
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 4 Key Stat Metric Cards -->
<div class="row g-4 mb-4">
    <!-- Stat 1: Total Patients This Month -->
    <div class="col-sm-6 col-xl-3">
        <div class="card card-hover h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-muted small fw-bold text-uppercase" style="letter-spacing: 0.5px;">Pasien Bulan Ini</span>
                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: rgba(2, 132, 199, 0.1); color: var(--primary);">
                        <i class="fas fa-users fs-5"></i>
                    </div>
                </div>
                <div class="d-flex align-items-baseline gap-2 mb-1">
                    <h2 class="fw-bold mb-0 text-dark" style="font-size: 2.2rem;">{{ $totalPatientsThisMonth }}</h2>
                    <span class="text-muted small">orang</span>
                </div>
                <div class="d-flex align-items-center text-muted small">
                    <i class="far fa-calendar-check text-primary me-1"></i>
                    <span>Periode {{ \Carbon\Carbon::now()->format('F Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat 2: Total Vaccine Types -->
    <div class="col-sm-6 col-xl-3">
        <div class="card card-hover h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-muted small fw-bold text-uppercase" style="letter-spacing: 0.5px;">Varian Vaksin</span>
                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: rgba(99, 102, 241, 0.1); color: #6366f1;">
                        <i class="fas fa-vials fs-5"></i>
                    </div>
                </div>
                <div class="d-flex align-items-baseline gap-2 mb-1">
                    <h2 class="fw-bold mb-0 text-dark" style="font-size: 2.2rem;">{{ $vaccines->count() }}</h2>
                    <span class="text-muted small">jenis</span>
                </div>
                <div class="d-flex align-items-center text-muted small">
                    <i class="fas fa-check-double text-indigo me-1"></i>
                    <span>Tersedia di master sistem</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat 3: Total Available Doses -->
    <div class="col-sm-6 col-xl-3">
        <div class="card card-hover h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-muted small fw-bold text-uppercase" style="letter-spacing: 0.5px;">Total Stok Dosis</span>
                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: rgba(16, 185, 129, 0.1); color: #10b981;">
                        <i class="fas fa-boxes-stacked fs-5"></i>
                    </div>
                </div>
                <div class="d-flex align-items-baseline gap-2 mb-1">
                    <h2 class="fw-bold mb-0 text-dark" style="font-size: 2.2rem;">{{ $vaccines->sum('stock') }}</h2>
                    <span class="text-muted small">dosis</span>
                </div>
                <div class="d-flex align-items-center text-muted small">
                    <i class="fas fa-shield-virus text-success me-1"></i>
                    <span>Akumulasi semua vaksin</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat 4: Inventory Alert Status -->
    @php
        $lowStockVaccines = $vaccines->where('stock', '<', 10);
    @endphp
    <div class="col-sm-6 col-xl-3">
        <div class="card card-hover h-100 {{ $lowStockVaccines->isNotEmpty() ? 'border-danger' : '' }}" style="{{ $lowStockVaccines->isNotEmpty() ? 'background: #fff5f5;' : '' }}">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-muted small fw-bold text-uppercase" style="letter-spacing: 0.5px;">Status Logistik</span>
                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; {{ $lowStockVaccines->isNotEmpty() ? 'background: rgba(239, 68, 68, 0.15); color: #ef4444;' : 'background: rgba(16, 185, 129, 0.1); color: #10b981;' }}">
                        <i class="fas {{ $lowStockVaccines->isNotEmpty() ? 'fa-triangle-exclamation' : 'fa-circle-check' }} fs-5"></i>
                    </div>
                </div>
                @if($lowStockVaccines->isNotEmpty())
                    <div class="d-flex align-items-baseline gap-2 mb-1">
                        <h2 class="fw-bold mb-0 text-danger" style="font-size: 2.2rem;">{{ $lowStockVaccines->count() }}</h2>
                        <span class="text-danger fw-semibold small">kritis (&lt;10)</span>
                    </div>
                    <div class="text-danger small fw-semibold">
                        <i class="fas fa-bell me-1"></i> Segera lakukan pengadaan
                    </div>
                @else
                    <div class="d-flex align-items-baseline gap-2 mb-1">
                        <h4 class="fw-bold mb-0 text-success" style="font-size: 1.5rem;">Aman Terkendali</h4>
                    </div>
                    <div class="text-muted small">
                        <i class="fas fa-check text-success me-1"></i> Tidak ada stok di bawah 10
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Main Split: Recent Vaccinations & Stock Inventory Progress -->
<div class="row g-4">
    <!-- Left: Recent Vaccinations Table -->
    <div class="col-lg-8">
        <div class="card border-0 h-100">
            <div class="card-header bg-white border-0 pt-4 pb-2 px-4 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="fw-bold mb-1 text-dark" style="letter-spacing: -0.3px;">
                        <i class="fas fa-clock-rotate-left text-primary me-2"></i>Pelayanan Vaksinasi Terkini
                    </h5>
                    <p class="text-muted small mb-0">Daftar pasien yang baru saja divaksinasi pada sistem.</p>
                </div>
                <a href="{{ route('patients.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-semibold">
                    Semua Pasien <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Data Pasien</th>
                                <th>Jenis Vaksin</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentRecords as $record)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="rounded-3 bg-light text-center p-2" style="min-width: 48px; border: 1px solid var(--slate-200);">
                                                <span class="d-block fw-bold text-primary fs-6">{{ \Carbon\Carbon::parse($record->vaccination_date)->format('d') }}</span>
                                                <span class="d-block text-muted" style="font-size: 0.7rem; text-transform: uppercase;">{{ \Carbon\Carbon::parse($record->vaccination_date)->format('M') }}</span>
                                            </div>
                                            <span class="text-muted small">{{ \Carbon\Carbon::parse($record->vaccination_date)->format('Y') }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width: 38px; height: 38px; background: linear-gradient(135deg, #0284c7 0%, #06b6d4 100%); font-size: 0.85rem;">
                                                {{ strtoupper(substr($record->patient->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <a href="{{ route('patients.show', $record->patient->id) }}" class="fw-bold text-dark text-decoration-none d-block hover-primary">
                                                    {{ $record->patient->name }}
                                                </a>
                                                <span class="text-muted small">
                                                    <i class="far fa-id-card me-1"></i>{{ $record->patient->passport_number }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-soft-primary">
                                            <i class="fas fa-vial me-1"></i> {{ $record->vaccine->name }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('patients.show', $record->patient->id) }}" class="btn-action-icon view" title="Lihat Detail Pasien">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        <div class="mb-3">
                                            <i class="fas fa-inbox fa-3x opacity-25"></i>
                                        </div>
                                        <h6 class="fw-bold mb-1">Belum Ada Pelayanan Vaksinasi</h6>
                                        <p class="small text-muted mb-3">Mulai layani pasien baru dengan menekan tombol di bawah.</p>
                                        <a href="{{ route('patients.create') }}" class="btn btn-primary btn-sm rounded-pill px-4">
                                            <i class="fas fa-plus me-1"></i> Registrasi Pasien Sekarang
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Right: Vaccine Stock Inventory Progress -->
    <div class="col-lg-4">
        <div class="card border-0 h-100">
            <div class="card-header bg-white border-0 pt-4 pb-2 px-4 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="fw-bold mb-1 text-dark" style="letter-spacing: -0.3px;">
                        <i class="fas fa-boxes-stacked text-primary me-2"></i>Monitoring Stok
                    </h5>
                    <p class="text-muted small mb-0">Status ketersediaan dosis per vaksin.</p>
                </div>
                <a href="{{ route('vaccines.index') }}" class="btn btn-sm btn-light rounded-pill px-3 fw-semibold">
                    Kelola <i class="fas fa-cog ms-1"></i>
                </a>
            </div>
            <div class="card-body p-4">
                <div class="d-flex flex-column gap-4">
                    @forelse($vaccines as $vaccine)
                        @php
                            $stockPercentage = min(100, max(5, ($vaccine->stock / 50) * 100));
                            if ($vaccine->stock >= 20) {
                                $barColor = 'bg-success';
                                $badgeClass = 'badge-soft-emerald';
                                $statusLabel = 'Aman';
                            } elseif ($vaccine->stock >= 10) {
                                $barColor = 'bg-warning';
                                $badgeClass = 'badge-soft-amber';
                                $statusLabel = 'Perlu Pantau';
                            } else {
                                $barColor = 'bg-danger';
                                $badgeClass = 'badge-soft-rose';
                                $statusLabel = 'Kritis';
                            }
                        @endphp
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center text-muted" style="width: 28px; height: 28px; background: var(--slate-100);">
                                        <i class="fas fa-vial" style="font-size: 0.75rem;"></i>
                                    </div>
                                    <span class="fw-bold text-dark" style="font-size: 0.92rem;">{{ $vaccine->name }}</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge {{ $badgeClass }}">{{ $statusLabel }}</span>
                                    <span class="fw-bold text-dark fs-6">{{ $vaccine->stock }}</span>
                                    <span class="text-muted small">dosis</span>
                                </div>
                            </div>
                            <div class="progress" style="height: 8px; border-radius: 100px; background-color: var(--slate-100);">
                                <div class="progress-bar {{ $barColor }} rounded-pill" role="progressbar" style="width: {{ $stockPercentage }}%" aria-valuenow="{{ $vaccine->stock }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4 text-muted">
                            <i class="fas fa-box-open fa-2x opacity-25 mb-2"></i>
                            <p class="small mb-0">Belum ada master data vaksin</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-4 pt-3 border-top text-center">
                    <a href="{{ route('vaccines.create') }}" class="btn btn-outline-primary btn-sm rounded-pill w-100 py-2 fw-semibold">
                        <i class="fas fa-plus me-1"></i> Tambah Master Vaksin Baru
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

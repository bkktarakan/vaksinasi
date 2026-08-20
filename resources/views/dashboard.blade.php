@extends('layouts.app')

@section('content')
<h2 class="page-header">Dashboard BKK Tarakan</h2>

<div class="row g-4 mb-5">
    <!-- Total Patients -->
    <div class="col-md-4">
        <div class="card card-hover h-100" style="background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%); color: white;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-uppercase mb-2 text-white-50 fw-bold" style="font-size: 0.85rem; letter-spacing: 1px;">Total Pasien Bulan Ini</p>
                        <h1 class="display-4 fw-bold mb-0">{{ $totalPatientsThisMonth }}</h1>
                    </div>
                    <div class="bg-white bg-opacity-25 rounded-circle p-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Warning Stock -->
    @foreach($vaccines as $vaccine)
        @if($vaccine->stock < 10)
        <div class="col-md-4">
            <div class="card card-hover h-100" style="background: linear-gradient(135deg, #ff4d4d 0%, #f9cb28 100%); color: white;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-uppercase mb-2 text-white-50 fw-bold" style="font-size: 0.85rem; letter-spacing: 1px;">Stok Menipis: {{ $vaccine->name }}</p>
                            <h1 class="display-4 fw-bold mb-0">{{ $vaccine->stock }}</h1>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-circle p-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <i class="fas fa-exclamation-triangle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endforeach
</div>

<div class="row g-4">
    <!-- Recent Vaccinations -->
    <div class="col-lg-8">
        <div class="card card-hover border-0">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <h5 class="fw-bold mb-0" style="color: var(--dark);"><i class="fas fa-history text-primary me-2"></i> Vaksinasi Terakhir</h5>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0 rounded-start">Tanggal</th>
                                <th class="border-0">Nama Pasien</th>
                                <th class="border-0 rounded-end">Jenis Vaksin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentRecords as $record)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light rounded p-2 me-3 text-center" style="width: 50px;">
                                                <span class="d-block fw-bold text-primary">{{ \Carbon\Carbon::parse($record->vaccination_date)->format('d') }}</span>
                                                <span class="d-block text-muted" style="font-size: 0.75rem;">{{ \Carbon\Carbon::parse($record->vaccination_date)->format('M') }}</span>
                                            </div>
                                            <span class="text-muted" style="font-size: 0.85rem;">{{ \Carbon\Carbon::parse($record->vaccination_date)->format('Y') }}</span>
                                        </div>
                                    </td>
                                    <td class="fw-medium">{{ $record->patient->name }}</td>
                                    <td>
                                        <span class="badge rounded-pill" style="background-color: rgba(76, 201, 240, 0.1); color: var(--secondary); border: 1px solid rgba(76, 201, 240, 0.2); padding: 8px 15px;">
                                            {{ $record->vaccine->name }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-5">
                                        <div class="mb-3"><i class="fas fa-inbox fa-3x opacity-25"></i></div>
                                        Belum ada data vaksinasi bulan ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Vaccine Stock List -->
    <div class="col-lg-4">
        <div class="card card-hover border-0">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <h5 class="fw-bold mb-0" style="color: var(--dark);"><i class="fas fa-box text-primary me-2"></i> Sisa Stok Vaksin</h5>
            </div>
            <div class="card-body p-4">
                <ul class="list-group list-group-flush">
                    @forelse($vaccines as $vaccine)
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3 border-light">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                    <i class="fas fa-vial text-muted"></i>
                                </div>
                                <span class="fw-medium">{{ $vaccine->name }}</span>
                            </div>
                            <span class="badge rounded-pill {{ $vaccine->stock > 10 ? 'bg-success' : 'bg-danger' }}" style="font-size: 0.9rem; padding: 6px 12px;">
                                {{ $vaccine->stock }}
                            </span>
                        </li>
                    @empty
                        <li class="list-group-item text-muted text-center py-4 border-0">
                            <i class="fas fa-box-open fa-2x opacity-25 mb-2"></i><br>
                            Belum ada data vaksin
                        </li>
                    @endforelse
                </ul>
                <div class="mt-4 text-center">
                    <a href="{{ route('vaccines.create') }}" class="btn btn-outline-primary btn-sm rounded-pill px-4">
                        <i class="fas fa-plus me-1"></i> Tambah Stok
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

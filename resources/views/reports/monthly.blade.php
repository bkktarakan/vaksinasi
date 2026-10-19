@extends('layouts.app')

@section('title', 'Laporan Bulanan Vaksinasi')

@section('content')
<!-- Page Header -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h2 class="fw-bold mb-1 text-dark" style="letter-spacing: -0.5px;">Laporan Bulanan Pelayanan</h2>
        <p class="text-muted small mb-0">Rekapitulasi berkala pelayanan vaksinasi internasional dan penerbitan sertifikat e-ICV.</p>
    </div>
    @if($groupedRecords->isNotEmpty())
    <div>
        <a href="{{ route('reports.download', request()->all()) }}" class="btn btn-success rounded-pill px-4 py-2 fw-bold shadow-sm d-inline-flex align-items-center gap-2">
            <i class="fas fa-file-csv"></i>
            <span>Export Laporan (CSV)</span>
        </a>
    </div>
    @endif
</div>

<!-- Filter Selection Card -->
<div class="card border-0 mb-4" style="background: linear-gradient(135deg, rgba(2, 132, 199, 0.04) 0%, rgba(6, 182, 212, 0.04) 100%); border: 1px solid rgba(2, 132, 199, 0.15) !important;">
    <div class="card-body p-4">
        <form action="{{ route('reports.monthly') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Pilih Bulan Pelaporan</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-primary"><i class="far fa-calendar-alt"></i></span>
                    <select name="month" class="form-select border-start-0 ps-0">
                        @for($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ $month == $i ? 'selected' : '' }}>
                                {{ date('F', mktime(0, 0, 0, $i, 10)) }}
                            </option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <label class="form-label">Tahun</label>
                <select name="year" class="form-select">
                    @for($i = \Carbon\Carbon::now()->year; $i >= 2020; $i--)
                        <option value="{{ $i }}" {{ $year == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="col-md-5 d-flex gap-2">
                <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm d-inline-flex align-items-center gap-2">
                    <i class="fas fa-filter"></i>
                    <span>Tampilkan Data</span>
                </button>
                @if($groupedRecords->isNotEmpty())
                <a href="{{ route('reports.download', request()->all()) }}" class="btn btn-outline-success rounded-pill px-3 fw-bold d-inline-flex align-items-center gap-1 d-md-none">
                    <i class="fas fa-download"></i> CSV
                </a>
                @endif
            </div>
        </form>
    </div>
</div>

<!-- Vaccine Summary Metric Cards -->
@if($vaccineSummary->isNotEmpty())
<div class="mb-4">
    <div class="d-flex align-items-center gap-2 mb-3">
        <h5 class="fw-bold mb-0 text-dark"><i class="fas fa-chart-pie text-primary me-2"></i>Rekapitulasi Dosis per Jenis Vaksin</h5>
    </div>
    <div class="row g-3">
        @foreach($vaccineSummary as $vaccineName => $count)
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card card-hover border-0 h-100">
                <div class="card-body p-3 d-flex align-items-center gap-3">
                    <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 44px; height: 44px; background: rgba(2, 132, 199, 0.1); color: var(--primary);">
                        <i class="fas fa-syringe fs-5"></i>
                    </div>
                    <div>
                        <span class="text-muted small fw-bold text-uppercase d-block" style="font-size: 0.72rem; letter-spacing: 0.5px;">{{ $vaccineName }}</span>
                        <div class="d-flex align-items-baseline gap-1">
                            <h4 class="fw-bold mb-0 text-dark">{{ $count }}</h4>
                            <span class="text-muted small">dosis</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

<!-- Grouped Records Table -->
<div class="card border-0">
    <div class="card-header bg-white border-0 pt-4 pb-2 px-4 d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold mb-1 text-dark" style="letter-spacing: -0.3px;">Rincian Pasien Divaksinasi</h5>
            <p class="text-muted small mb-0">Periode: {{ date('F', mktime(0, 0, 0, $month, 10)) }} {{ $year }}</p>
        </div>
        @if($groupedRecords->isNotEmpty())
            <span class="badge badge-soft-emerald px-3 py-2 fw-semibold">
                Total: {{ $groupedRecords->count() }} Pasien
            </span>
        @endif
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th width="4%" class="text-center">No</th>
                        <th>Tanggal</th>
                        <th>No. Barcode</th>
                        <th>No. Paspor</th>
                        <th>Nama Pasien</th>
                        <th>Jenis Vaksin yang Diberikan</th>
                        <th class="text-center">Tes HCG</th>
                        <th>Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($groupedRecords as $index => $group)
                    @php $firstRecord = $group->first(); @endphp
                    <tr>
                        <td class="text-center text-muted fw-bold">{{ $loop->iteration }}</td>
                        <td>
                            <div class="fw-bold text-dark">{{ \Carbon\Carbon::parse($firstRecord->vaccination_date)->format('d M Y') }}</div>
                        </td>
                        <td>
                            @if($firstRecord->patient->barcode_number)
                                <span class="badge badge-soft-primary">{{ $firstRecord->patient->barcode_number }}</span>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border px-2 py-1">
                                <i class="far fa-id-card me-1 text-primary"></i>{{ $firstRecord->patient->passport_number }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('patients.show', $firstRecord->patient->id) }}" class="fw-bold text-dark text-decoration-none hover-primary">
                                {{ $firstRecord->patient->name }}
                            </a>
                        </td>
                        <td>
                            <div class="d-flex flex-wrap gap-1">
                                @foreach($group as $record)
                                <span class="badge badge-soft-primary">
                                    <i class="fas fa-check-circle me-1"></i>{{ $record->vaccine->name }}
                                </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="text-center">
                            @if($firstRecord->hcg_done)
                                @if($firstRecord->hcg_result == 'Positif')
                                    <span class="badge badge-soft-rose">Positif</span>
                                @else
                                    <span class="badge badge-soft-emerald">Negatif</span>
                                @endif
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                        <td>
                            <span class="text-muted small fw-medium">{{ $firstRecord->officer_name ?? '-' }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <div class="mb-3">
                                <i class="fas fa-calendar-xmark fa-3x text-muted opacity-25"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-1">Tidak Ada Data Pelayanan</h5>
                            <p class="text-muted small mb-0">Belum ada catatan vaksinasi pada bulan {{ date('F', mktime(0, 0, 0, $month, 10)) }} {{ $year }}.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

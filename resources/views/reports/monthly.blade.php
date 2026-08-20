@extends('layouts.app')

@section('content')
<h2 class="page-header mb-4">Laporan Bulanan Vaksinasi</h2>

<div class="card card-hover border-0 mb-4">
    <div class="card-body p-4" style="background: linear-gradient(135deg, rgba(67, 97, 238, 0.03) 0%, rgba(76, 201, 240, 0.03) 100%);">
        <form action="{{ route('reports.monthly') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label fw-bold text-muted small text-uppercase">Pilih Bulan</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="far fa-calendar-alt text-primary"></i></span>
                    <select name="month" class="form-select border-start-0 ps-0 form-select-lg fs-6 shadow-sm">
                        @for($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ $month == $i ? 'selected' : '' }}>
                                {{ date('F', mktime(0, 0, 0, $i, 10)) }}
                            </option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-bold text-muted small text-uppercase">Tahun</label>
                <select name="year" class="form-select form-select-lg fs-6 shadow-sm">
                    @for($i = \Carbon\Carbon::now()->year; $i >= 2020; $i--)
                        <option value="{{ $i }}" {{ $year == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-5 d-flex gap-2">
                <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm px-4">
                    <i class="fas fa-filter me-2"></i> Tampilkan Laporan
                </button>
                <a href="{{ route('reports.download', request()->all()) }}" class="btn btn-success btn-lg rounded-pill shadow-sm px-4 d-flex align-items-center">
                    <i class="fas fa-file-csv me-2"></i> Download CSV
                </a>
            </div>
        </form>
    </div>
</div>

@if($vaccineSummary->isNotEmpty())
<div class="row mb-4">
    <div class="col-12">
        <h5 class="fw-bold mb-3"><i class="fas fa-chart-pie text-primary me-2"></i> Rekapitulasi Berdasarkan Jenis Vaksin</h5>
        <div class="d-flex flex-wrap gap-3">
            @foreach($vaccineSummary as $vaccineName => $count)
            <div class="card border-0 shadow-sm flex-fill" style="min-width: 200px;">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; color: var(--primary);">
                        <i class="fas fa-syringe fs-5"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-semibold text-uppercase mb-1">{{ $vaccineName }}</div>
                        <h4 class="mb-0 fw-bold">{{ $count }} <span class="fs-6 text-muted fw-normal">Dosis</span></h4>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<div class="card card-hover border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" style="white-space: nowrap;">
                <thead class="table-light">
                    <tr>
                        <th width="5%" class="border-0 rounded-start text-center">No</th>
                        <th class="border-0">Tanggal</th>
                        <th class="border-0">No. Barcode</th>
                        <th class="border-0">No. Paspor</th>
                        <th class="border-0">Nama Pasien</th>
                        <th class="border-0 text-center">Jenis Vaksin</th>
                        <th class="border-0 text-center">Hasil HCG</th>
                        <th class="border-0 rounded-end">Nama Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($groupedRecords as $index => $group)
                    @php $firstRecord = $group->first(); @endphp
                    <tr>
                        <td class="text-center text-muted fw-bold">{{ $loop->iteration }}</td>
                        <td>
                            <span class="text-dark fw-medium">{{ \Carbon\Carbon::parse($firstRecord->vaccination_date)->format('d') }}</span>
                            <span class="text-muted small">{{ \Carbon\Carbon::parse($firstRecord->vaccination_date)->format('M Y') }}</span>
                        </td>
                        <td>{{ $firstRecord->patient->barcode_number ?? '-' }}</td>
                        <td class="text-muted">{{ $firstRecord->patient->passport_number }}</td>
                        <td class="fw-medium">{{ $firstRecord->patient->name }}</td>
                        <td class="text-center">
                            @foreach($group as $record)
                            <span class="badge rounded-pill mb-1" style="background-color: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.2); padding: 8px 15px; display: inline-block;">
                                <i class="fas fa-check-circle me-1"></i> {{ $record->vaccine->name }}
                            </span>
                            @endforeach
                        </td>
                        <td class="text-center">
                            @if($firstRecord->hcg_done)
                                @if($firstRecord->hcg_result == 'Positif')
                                    <span class="badge bg-danger rounded-pill">Positif</span>
                                @else
                                    <span class="badge bg-success rounded-pill">Negatif</span>
                                @endif
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                        <td>{{ $firstRecord->officer_name ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <div class="mb-3">
                                <img src="https://cdn-icons-png.flaticon.com/512/7486/7486747.png" alt="No data" width="80" class="opacity-50 grayscale">
                            </div>
                            <h5 class="text-muted">Tidak ada data vaksinasi</h5>
                            <p class="text-muted small">Belum ada pasien yang mendaftar pada bulan dan tahun yang dipilih.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($groupedRecords->isNotEmpty())
    <div class="card-footer bg-white border-top-0 pt-4 pb-4 px-4 text-end">
        <div class="d-inline-flex align-items-center bg-light rounded-pill px-4 py-2 border">
            <span class="text-muted me-2">Total Pasien Divaksin:</span>
            <h4 class="mb-0 fw-bold text-primary">{{ $groupedRecords->count() }}</h4>
        </div>
    </div>
    @endif
</div>
@endsection

@extends('layouts.app')

@section('title', 'Data Pasien')

@section('content')
<!-- Header Page -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1">
            <h2 class="fw-bold mb-0 text-dark" style="letter-spacing: -0.5px;">Data Pasien</h2>
            <span class="badge badge-soft-primary fs-6">{{ $patients->count() }} Terdaftar</span>
        </div>
        <p class="text-muted small mb-0">Kelola informasi pasien dan riwayat sertifikat vaksinasi internasional (e-ICV).</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('patients.create') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-bold shadow-sm d-inline-flex align-items-center gap-2">
            <i class="fas fa-user-plus"></i>
            <span>Registrasi Baru</span>
        </a>
    </div>
</div>

<!-- Search & Filter Card -->
<div class="card border-0 mb-4">
    <div class="card-body p-3">
        <div class="row g-2 align-items-center">
            <div class="col-md-6 col-lg-5">
                <div class="position-relative">
                    <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                    <input type="text" id="patientSearchInput" class="form-control ps-5 rounded-pill" placeholder="Cari nama, no. paspor, atau no. barcode..." onkeyup="filterPatientTable()">
                </div>
            </div>
            <div class="col-md-6 col-lg-7 text-md-end text-muted small">
                <span><i class="fas fa-info-circle me-1 text-primary"></i> Menampilkan seluruh riwayat pasien yang tercatat.</span>
            </div>
        </div>
    </div>
</div>

<!-- Patients Table Card -->
<div class="card border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="patientTable">
                <thead>
                    <tr>
                        <th width="4%" class="text-center">No</th>
                        <th>Identitas Pasien</th>
                        <th>No. Paspor</th>
                        <th>No. Barcode</th>
                        <th>Tgl Terbit e-ICV</th>
                        <th>Kontak</th>
                        <th class="text-end" width="12%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($patients as $index => $patient)
                    <tr class="patient-row">
                        <td class="text-center text-muted fw-bold">{{ $index + 1 }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold flex-shrink-0" style="width: 40px; height: 40px; background: linear-gradient(135deg, #0284c7 0%, #0ea5e9 100%); font-size: 0.9rem;">
                                    {{ strtoupper(substr($patient->name, 0, 1)) }}
                                </div>
                                <div>
                                    <a href="{{ route('patients.show', $patient->id) }}" class="fw-bold text-dark text-decoration-none d-block hover-primary patient-name">
                                        {{ $patient->name }}
                                    </a>
                                    <div class="text-muted small">
                                        <i class="fas fa-venus-mars me-1" style="font-size: 0.75rem;"></i>{{ $patient->gender }} 
                                        @if($patient->date_of_birth)
                                            • {{ \Carbon\Carbon::parse($patient->date_of_birth)->age }} thn
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border px-3 py-2 fw-semibold patient-passport">
                                <i class="far fa-id-card me-1 text-primary"></i>{{ $patient->passport_number }}
                            </span>
                        </td>
                        <td>
                            @if($patient->barcode_number)
                                <span class="badge badge-soft-primary px-3 py-2 patient-barcode">
                                    <i class="fas fa-barcode me-1"></i>{{ $patient->barcode_number }}
                                </span>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                        <td>
                            @if($patient->e_icv_issue_date)
                                <div class="fw-medium text-dark">{{ \Carbon\Carbon::parse($patient->e_icv_issue_date)->format('d M Y') }}</div>
                                <span class="text-muted small">{{ \Carbon\Carbon::parse($patient->e_icv_issue_date)->diffForHumans() }}</span>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                        <td>
                            @if($patient->phone)
                                <div class="small mb-1">
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $patient->phone) }}" target="_blank" class="text-decoration-none text-success fw-medium">
                                        <i class="fab fa-whatsapp me-1"></i>{{ $patient->phone }}
                                    </a>
                                </div>
                            @endif
                            @if($patient->email)
                                <div class="text-muted small">
                                    <i class="far fa-envelope me-1"></i>{{ $patient->email }}
                                </div>
                            @endif
                            @if(!$patient->phone && !$patient->email)
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-1">
                                <a href="{{ route('patients.show', $patient->id) }}" class="btn-action-icon view" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('patients.edit', $patient->id) }}" class="btn-action-icon edit" title="Edit Data">
                                    <i class="fas fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pasien {{ $patient->name }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action-icon delete" title="Hapus Pasien">
                                        <i class="fas fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <div class="mb-3">
                                <i class="fas fa-users-slash fa-3x text-muted opacity-25"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-1">Belum Ada Data Pasien</h5>
                            <p class="text-muted small mb-3">Mulai daftarkan pasien baru untuk merekam riwayat vaksinasi internasional.</p>
                            <a href="{{ route('patients.create') }}" class="btn btn-primary rounded-pill px-4">
                                <i class="fas fa-user-plus me-1"></i> Registrasi Pasien Baru
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function filterPatientTable() {
        const input = document.getElementById('patientSearchInput');
        const filter = input.value.toLowerCase();
        const rows = document.querySelectorAll('.patient-row');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            if (text.includes(filter)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>
@endsection

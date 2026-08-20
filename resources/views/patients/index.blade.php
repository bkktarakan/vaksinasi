@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="page-header mb-1">Data Pasien</h2>
        <p class="text-muted">Informasi lengkap seluruh pasien yang terdaftar.</p>
    </div>
    <a href="{{ route('patients.create') }}" class="btn btn-primary shadow-sm rounded-pill px-4">
        <i class="fas fa-user-plus me-2"></i> Registrasi Baru
    </a>
</div>

<div class="card card-hover border-0">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%" class="border-0 rounded-start">No</th>
                        <th class="border-0">No. Barcode</th>
                        <th class="border-0">No. Paspor</th>
                        <th class="border-0">Nama Pasien</th>
                        <th class="border-0">Tgl. Terbit e-ICV</th>
                        <th class="border-0">Kontak / Email</th>
                        <th class="border-0 rounded-end text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($patients as $index => $patient)
                    <tr>
                        <td class="text-muted fw-bold">{{ $index + 1 }}</td>
                        <td>{{ $patient->barcode_number ?? '-' }}</td>
                        <td><span class="text-muted"><i class="far fa-id-card me-2 text-primary opacity-50"></i>{{ $patient->passport_number }}</span></td>
                        <td class="fw-medium">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; color: var(--primary);">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">{{ $patient->name }}</div>
                                    <div class="small text-muted">{{ $patient->place_of_birth ? $patient->place_of_birth . ', ' : '' }}{{ \Carbon\Carbon::parse($patient->date_of_birth)->format('d M Y') }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $patient->e_icv_issue_date ? \Carbon\Carbon::parse($patient->e_icv_issue_date)->format('d M Y') : '-' }}</td>
                        <td>
                            @if($patient->phone)
                                <div class="small"><i class="fas fa-phone-alt me-2 text-success opacity-75"></i>{{ $patient->phone }}</div>
                            @endif
                            @if($patient->email)
                                <div class="small mt-1"><i class="fas fa-envelope me-2 text-warning opacity-75"></i>{{ $patient->email }}</div>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('patients.show', $patient->id) }}" class="btn btn-sm btn-info text-white rounded-pill px-3 me-1" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-sm btn-warning text-white rounded-pill px-3 me-1" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pasien ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3" title="Hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <div class="mb-3">
                                <i class="fas fa-users-slash fa-3x text-muted opacity-25"></i>
                            </div>
                            <h5 class="text-muted">Belum ada data pasien</h5>
                            <p class="text-muted small">Mulai daftarkan pasien untuk melihat data di sini.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

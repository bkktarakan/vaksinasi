@extends('layouts.app')

@section('title', 'Detail Pasien - ' . $patient->name)

@section('content')
<!-- Back & Page Header -->
<div class="mb-4">
    <div class="d-flex align-items-center gap-3">
        <a href="{{ route('patients.index') }}" class="btn btn-light rounded-circle shadow-sm d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; border: 1px solid var(--slate-200);" title="Kembali ke Daftar Pasien">
            <i class="fas fa-arrow-left text-muted"></i>
        </a>
        <div class="flex-grow-1">
            <div class="d-flex align-items-center gap-2">
                <h2 class="fw-bold mb-0 text-dark" style="letter-spacing: -0.5px;">{{ $patient->name }}</h2>
                <span class="badge badge-soft-primary">{{ $patient->passport_number }}</span>
            </div>
            <p class="text-muted small mb-0">Informasi biodata lengkap dan rekam medis vaksinasi internasional (e-ICV).</p>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm d-inline-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#tambahVaksinModal">
                <i class="fas fa-plus-circle"></i>
                <span>Tambah Vaksin</span>
            </button>
            <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-outline-secondary rounded-pill px-3 fw-semibold">
                <i class="fas fa-pen-to-square me-1"></i> Edit Biodata
            </a>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Kolom Kiri: Biodata Pasien -->
    <div class="col-lg-5">
        <div class="card border-0 h-100">
            <div class="card-header bg-white border-0 pt-4 pb-2 px-4 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; background: rgba(2, 132, 199, 0.1); color: var(--primary);">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <h5 class="fw-bold mb-0 text-dark">Biodata Pasien</h5>
                </div>
                <span class="badge bg-light text-muted border">ID #{{ $patient->id }}</span>
            </div>

            <div class="card-body p-4 pt-3">
                <div class="d-flex flex-column gap-3">
                    <div class="p-3 rounded-3" style="background: var(--slate-50); border: 1px solid var(--slate-200);">
                        <span class="text-muted small fw-bold text-uppercase d-block mb-1" style="font-size: 0.7rem; letter-spacing: 0.5px;">Nama Lengkap</span>
                        <div class="fw-bold text-dark fs-6">{{ $patient->name }}</div>
                    </div>

                    <div class="row g-2">
                        <div class="col-6">
                            <div class="p-3 rounded-3" style="background: var(--slate-50); border: 1px solid var(--slate-200);">
                                <span class="text-muted small fw-bold text-uppercase d-block mb-1" style="font-size: 0.7rem; letter-spacing: 0.5px;">No. Paspor</span>
                                <div class="fw-bold text-dark"><i class="far fa-id-card me-1 text-primary"></i>{{ $patient->passport_number }}</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-3" style="background: var(--slate-50); border: 1px solid var(--slate-200);">
                                <span class="text-muted small fw-bold text-uppercase d-block mb-1" style="font-size: 0.7rem; letter-spacing: 0.5px;">No. Barcode</span>
                                <div class="fw-bold text-dark"><i class="fas fa-barcode me-1 text-info"></i>{{ $patient->barcode_number ?? '-' }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col-6">
                            <div class="p-3 rounded-3" style="background: var(--slate-50); border: 1px solid var(--slate-200);">
                                <span class="text-muted small fw-bold text-uppercase d-block mb-1" style="font-size: 0.7rem; letter-spacing: 0.5px;">Jenis Kelamin</span>
                                <div class="fw-semibold text-dark">{{ $patient->gender }}</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-3" style="background: var(--slate-50); border: 1px solid var(--slate-200);">
                                <span class="text-muted small fw-bold text-uppercase d-block mb-1" style="font-size: 0.7rem; letter-spacing: 0.5px;">Tgl Terbit e-ICV</span>
                                <div class="fw-semibold text-dark">{{ $patient->e_icv_issue_date ? \Carbon\Carbon::parse($patient->e_icv_issue_date)->format('d M Y') : '-' }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 rounded-3" style="background: var(--slate-50); border: 1px solid var(--slate-200);">
                        <span class="text-muted small fw-bold text-uppercase d-block mb-1" style="font-size: 0.7rem; letter-spacing: 0.5px;">Tempat & Tanggal Lahir</span>
                        <div class="fw-semibold text-dark">
                            {{ $patient->place_of_birth ?? '-' }}, {{ $patient->date_of_birth ? \Carbon\Carbon::parse($patient->date_of_birth)->format('d F Y') : '-' }}
                            @if($patient->date_of_birth)
                                <span class="text-muted small">({{ \Carbon\Carbon::parse($patient->date_of_birth)->age }} tahun)</span>
                            @endif
                        </div>
                    </div>

                    <div class="p-3 rounded-3" style="background: var(--slate-50); border: 1px solid var(--slate-200);">
                        <span class="text-muted small fw-bold text-uppercase d-block mb-1" style="font-size: 0.7rem; letter-spacing: 0.5px;">Kontak & WhatsApp</span>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="fw-semibold text-dark">{{ $patient->phone ?? '-' }}</div>
                            @if($patient->phone)
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $patient->phone) }}" target="_blank" class="btn btn-sm btn-outline-success rounded-pill px-3 py-1">
                                    <i class="fab fa-whatsapp me-1"></i> Chat WA
                                </a>
                            @endif
                        </div>
                        @if($patient->email)
                            <div class="text-muted small mt-1"><i class="far fa-envelope me-1"></i>{{ $patient->email }}</div>
                        @endif
                    </div>

                    <div class="p-3 rounded-3" style="background: var(--slate-50); border: 1px solid var(--slate-200);">
                        <span class="text-muted small fw-bold text-uppercase d-block mb-1" style="font-size: 0.7rem; letter-spacing: 0.5px;">Alamat Lengkap</span>
                        <div class="text-dark small">{{ $patient->address ?? '-' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Riwayat Vaksinasi Pasien -->
    <div class="col-lg-7">
        <div class="card border-0 h-100">
            <div class="card-header bg-white border-0 pt-4 pb-2 px-4 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; background: rgba(16, 185, 129, 0.1); color: var(--emerald);">
                        <i class="fas fa-syringe"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-dark">Riwayat Vaksinasi</h5>
                        <p class="text-muted small mb-0">Total {{ $records->count() }} dosis vaksinasi yang telah tercatat.</p>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Jenis Vaksin</th>
                                <th class="text-center">Tes HCG</th>
                                <th>Petugas</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($records as $record)
                            <tr>
                                <td>
                                    <div class="fw-bold text-dark">{{ \Carbon\Carbon::parse($record->vaccination_date)->format('d M Y') }}</div>
                                    <span class="text-muted small">{{ \Carbon\Carbon::parse($record->vaccination_date)->diffForHumans() }}</span>
                                </td>
                                <td>
                                    <span class="badge badge-soft-primary fs-6">
                                        <i class="fas fa-shield-virus me-1"></i>{{ $record->vaccine->name }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if($record->hcg_done)
                                        @if($record->hcg_result == 'Positif')
                                            <span class="badge badge-soft-rose">Positif</span>
                                        @else
                                            <span class="badge badge-soft-emerald">Negatif</span>
                                        @endif
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-dark small fw-medium">{{ $record->officer_name ?? '-' }}</span>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-1">
                                        <a href="{{ route('vaccination-records.edit', $record->id) }}" class="btn-action-icon edit" title="Edit Riwayat">
                                            <i class="fas fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('vaccination-records.destroy', $record->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus riwayat vaksin ini? Stok vaksin akan dikembalikan secara otomatis.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action-icon delete" title="Hapus Riwayat">
                                                <i class="fas fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <div class="mb-3">
                                        <i class="fas fa-shield-slash fa-3x opacity-25"></i>
                                    </div>
                                    <h6 class="fw-bold text-dark mb-1">Belum Ada Riwayat Vaksinasi</h6>
                                    <p class="small text-muted mb-3">Tekan tombol Tambah Vaksin di bawah untuk mencatat dosis vaksin.</p>
                                    <button type="button" class="btn btn-primary btn-sm rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#tambahVaksinModal">
                                        <i class="fas fa-plus-circle me-1"></i> Tambah Vaksin Sekarang
                                    </button>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
<!-- Modal Tambah Vaksin Modern -->
<div class="modal fade" id="tambahVaksinModal" tabindex="-1" aria-labelledby="tambahVaksinModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
            <div class="modal-header border-0 bg-white pt-4 px-4 pb-2">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; background: rgba(2, 132, 199, 0.1); color: var(--primary);">
                        <i class="fas fa-plus"></i>
                    </div>
                    <h5 class="modal-title fw-bold text-dark" id="tambahVaksinModalLabel">Tambah Riwayat Vaksin</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('patients.vaccination-records.store', $patient->id) }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label">Pilih Jenis Vaksin <span class="text-danger">*</span></label>
                        <select name="vaccine_id" class="form-select" required>
                            <option value="" disabled selected>Pilih Vaksin Tersedia</option>
                            @foreach($vaccines as $vaccine)
                                <option value="{{ $vaccine->id }}" {{ $vaccine->stock <= 0 ? 'disabled' : '' }}>
                                    {{ $vaccine->name }} (Sisa Stok: {{ $vaccine->stock }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Vaksinasi <span class="text-danger">*</span></label>
                        <input type="date" name="vaccination_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>

                    @if($patient->gender == 'Perempuan')
                    <div class="card border p-3 mb-3 rounded-3" style="background: var(--slate-50);">
                        <div class="form-check form-switch mb-0">
                            <input class="form-check-input" type="checkbox" id="modal_hcg_done" name="hcg_done" value="1" onchange="document.getElementById('modalHcgResultDiv').style.display = this.checked ? 'block' : 'none';">
                            <label class="form-check-label fw-bold text-dark" for="modal_hcg_done" style="cursor: pointer;">
                                Dilakukan Tes HCG?
                            </label>
                        </div>
                        <div id="modalHcgResultDiv" class="mt-3 pt-2 border-top" style="display: none;">
                            <label class="form-label small">Hasil Tes HCG</label>
                            <select name="hcg_result" class="form-select">
                                <option value="Negatif">Negatif (Tidak Hamil)</option>
                                <option value="Positif">Positif (Hamil)</option>
                            </select>
                        </div>
                    </div>
                    @endif

                    <div class="mb-2">
                        <label class="form-label">Nama Petugas / Dokter Pemeriksa <span class="text-danger">*</span></label>
                        <input type="text" name="officer_name" class="form-control" value="{{ auth()->user()->name }}" placeholder="Nama petugas medis" required>
                    </div>
                </div>
                <div class="modal-footer border-0 bg-light p-3 px-4">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-semibold" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
                        <i class="fas fa-check me-1"></i> Simpan Dosis
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

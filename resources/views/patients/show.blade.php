@extends('layouts.app')

@section('content')
<div class="mb-4 d-flex align-items-center">
    <a href="{{ route('patients.index') }}" class="btn btn-light shadow-sm me-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
        <i class="fas fa-arrow-left"></i>
    </a>
    <div>
        <h2 class="page-header mb-1">Detail Pasien</h2>
        <p class="text-muted mb-0">Informasi lengkap dan riwayat vaksinasi pasien.</p>
    </div>
</div>

<div class="row">
    <div class="col-md-5 mb-4">
        <div class="card card-hover border-0">
            <div class="card-header bg-white p-4 border-bottom-0 pb-0">
                <h5 class="fw-bold mb-0"><i class="fas fa-user-circle text-primary me-2"></i> Biodata Pasien</h5>
            </div>
            <div class="card-body p-4">
                <table class="table table-borderless mb-0">
                    <tbody>
                        <tr>
                            <td class="text-muted" width="40%">Nama Lengkap</td>
                            <td class="fw-bold">{{ $patient->name }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">No. Paspor</td>
                            <td class="fw-bold"><span class="badge bg-light text-dark border">{{ $patient->passport_number }}</span></td>
                        </tr>
                        <tr>
                            <td class="text-muted">No. Barcode</td>
                            <td class="fw-bold">{{ $patient->barcode_number ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Tgl. Terbit e-ICV</td>
                            <td class="fw-bold">{{ $patient->e_icv_issue_date ? \Carbon\Carbon::parse($patient->e_icv_issue_date)->format('d F Y') : '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Tempat, Tgl. Lahir</td>
                            <td class="fw-bold">{{ $patient->place_of_birth ?? '-' }}, {{ \Carbon\Carbon::parse($patient->date_of_birth)->format('d F Y') }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Jenis Kelamin</td>
                            <td class="fw-bold">{{ $patient->gender }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">No. Handphone</td>
                            <td class="fw-bold">{{ $patient->phone ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Email</td>
                            <td class="fw-bold">{{ $patient->email ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Alamat</td>
                            <td class="fw-bold">{{ $patient->address ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white p-4 text-end">
                <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-warning text-white rounded-pill px-4">
                    <i class="fas fa-edit me-1"></i> Edit Biodata
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-7">
        <div class="card card-hover border-0">
            <div class="card-header bg-white p-4 border-bottom-0 pb-0 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0"><i class="fas fa-syringe text-success me-2"></i> Riwayat Vaksinasi</h5>
                <button type="button" class="btn btn-sm btn-primary rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#tambahVaksinModal">
                    <i class="fas fa-plus me-1"></i> Tambah Vaksin
                </button>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0 rounded-start">Tanggal</th>
                                <th class="border-0">Jenis Vaksin</th>
                                <th class="border-0 text-center">HCG</th>
                                <th class="border-0">Petugas</th>
                                <th class="border-0 rounded-end text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($records as $record)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($record->vaccination_date)->format('d M Y') }}</td>
                                <td>
                                    <span class="badge rounded-pill" style="background-color: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.2); padding: 8px 15px;">
                                        <i class="fas fa-check-circle me-1"></i> {{ $record->vaccine->name }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if($record->hcg_done)
                                        @if($record->hcg_result == 'Positif')
                                            <span class="badge bg-danger rounded-pill">Positif</span>
                                        @else
                                            <span class="badge bg-success rounded-pill">Negatif</span>
                                        @endif
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                                <td>{{ $record->officer_name ?? '-' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('vaccination-records.edit', $record->id) }}" class="btn btn-sm btn-warning text-white rounded-pill px-2 me-1" title="Edit Riwayat">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('vaccination-records.destroy', $record->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus riwayat vaksinasi ini? (Stok vaksin akan dikembalikan)');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger rounded-pill px-2" title="Hapus Riwayat">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">Belum ada riwayat vaksinasi.</td>
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
<!-- Modal Tambah Vaksin -->
<div class="modal fade" id="tambahVaksinModal" tabindex="-1" aria-labelledby="tambahVaksinModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content border-0 shadow">
      <div class="modal-header bg-light">
        <h5 class="modal-title fw-bold" id="tambahVaksinModalLabel"><i class="fas fa-plus-circle text-primary me-2"></i> Tambah Vaksin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('patients.vaccination-records.store', $patient->id) }}" method="POST">
        @csrf
        <div class="modal-body p-4">
            <div class="mb-3">
                <label class="form-label fw-bold">Pilih Jenis Vaksin <span class="text-danger">*</span></label>
                <select name="vaccine_id" class="form-select" required>
                    <option value="" disabled selected>Pilih Vaksin</option>
                    @foreach($vaccines as $vaccine)
                        <option value="{{ $vaccine->id }}">{{ $vaccine->name }} (Stok tersisa: {{ $vaccine->stock }})</option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-3">
                <label class="form-label fw-bold">Tanggal Vaksinasi <span class="text-danger">*</span></label>
                <input type="date" name="vaccination_date" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>

            @if($patient->gender == 'Perempuan')
            <div class="mb-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="hcg_done" name="hcg_done" value="1">
                    <label class="form-check-label fw-bold" for="hcg_done">Dilakukan tes HCG</label>
                </div>
            </div>

            <div class="mb-3" id="hcgResultDiv" style="display: none;">
                <label class="form-label fw-bold">Hasil Tes HCG</label>
                <select name="hcg_result" class="form-select">
                    <option value="Negatif">Negatif</option>
                    <option value="Positif">Positif</option>
                </select>
            </div>
            
            <script>
                document.getElementById('hcg_done').addEventListener('change', function() {
                    document.getElementById('hcgResultDiv').style.display = this.checked ? 'block' : 'none';
                });
            </script>
            @endif

            <div class="mb-3">
                <label class="form-label fw-bold">Nama Petugas / Dokter <span class="text-danger">*</span></label>
                <input type="text" name="officer_name" class="form-control" required placeholder="Nama petugas">
            </div>
        </div>
        <div class="modal-footer bg-light border-top-0">
          <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary rounded-pill px-4"><i class="fas fa-save me-1"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

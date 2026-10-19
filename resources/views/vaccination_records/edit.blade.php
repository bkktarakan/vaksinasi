@extends('layouts.app')

@section('title', 'Edit Riwayat Vaksinasi')

@section('content')
<div class="mb-4 d-flex align-items-center gap-3">
    <a href="{{ route('patients.show', $vaccinationRecord->patient_id) }}" class="btn btn-light rounded-circle shadow-sm d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; border: 1px solid var(--slate-200);" title="Kembali ke Detail Pasien">
        <i class="fas fa-arrow-left text-muted"></i>
    </a>
    <div>
        <h2 class="fw-bold mb-0 text-dark" style="letter-spacing: -0.5px;">Edit Riwayat Vaksinasi</h2>
        <p class="text-muted small mb-0">Pasien: <span class="fw-bold text-dark">{{ $vaccinationRecord->patient->name }}</span> ({{ $vaccinationRecord->patient->passport_number }})</p>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 col-xl-7">
        <div class="card border-0">
            <div class="card-header bg-white border-0 pt-4 pb-2 px-4">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background: rgba(2, 132, 199, 0.1); color: var(--primary);">
                        <i class="fas fa-syringe fs-5"></i>
                    </div>
                    <h5 class="fw-bold mb-0 text-dark">Penyesuaian Tindakan Vaksinasi</h5>
                </div>
            </div>

            <div class="card-body p-4 pt-3">
                <div class="alert-modern alert alert-info mb-4 d-flex align-items-center gap-3" style="background: rgba(2, 132, 199, 0.05); border: 1px solid rgba(2, 132, 199, 0.2); border-radius: 14px;">
                    <i class="fas fa-circle-info fs-4 text-primary"></i>
                    <div class="small text-dark">
                        <strong>Sinkronisasi Stok Otomatis:</strong> Jika Anda mengubah jenis vaksin, stok vaksin lama akan dikembalikan secara otomatis, dan stok vaksin baru akan dikurangkan.
                    </div>
                </div>

                <form action="{{ route('vaccination-records.update', $vaccinationRecord->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Jenis Vaksin <span class="text-danger">*</span></label>
                            <select name="vaccine_id" class="form-select @error('vaccine_id') is-invalid @enderror" required>
                                @foreach($vaccines as $vaccine)
                                    <option value="{{ $vaccine->id }}" {{ old('vaccine_id', $vaccinationRecord->vaccine_id) == $vaccine->id ? 'selected' : '' }}>
                                        {{ $vaccine->name }} (Sisa Stok: {{ $vaccine->stock }})
                                    </option>
                                @endforeach
                            </select>
                            @error('vaccine_id')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Vaksinasi <span class="text-danger">*</span></label>
                            <input type="date" name="vaccination_date" class="form-control @error('vaccination_date') is-invalid @enderror" value="{{ old('vaccination_date', $vaccinationRecord->vaccination_date) }}" required>
                            @error('vaccination_date')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>
                        
                        <div class="col-12">
                            <div class="card border p-3 rounded-3" style="background: var(--slate-50);">
                                <div class="form-check form-switch mb-0">
                                    <input class="form-check-input" type="checkbox" id="hcg_done" name="hcg_done" value="1" {{ old('hcg_done', $vaccinationRecord->hcg_done) ? 'checked' : '' }} onchange="toggleHcgResult()">
                                    <label class="form-check-label fw-bold text-dark" for="hcg_done" style="cursor: pointer;">
                                        Dilakukan Tes HCG?
                                    </label>
                                </div>
                                <div id="hcg_result_container" class="mt-3 pt-2 border-top" style="{{ old('hcg_done', $vaccinationRecord->hcg_done) ? '' : 'display: none;' }}">
                                    <label class="form-label small">Hasil Tes HCG</label>
                                    <select name="hcg_result" class="form-select @error('hcg_result') is-invalid @enderror">
                                        <option value="Negatif" {{ old('hcg_result', $vaccinationRecord->hcg_result) == 'Negatif' ? 'selected' : '' }}>Negatif (Tidak Hamil)</option>
                                        <option value="Positif" {{ old('hcg_result', $vaccinationRecord->hcg_result) == 'Positif' ? 'selected' : '' }}>Positif (Hamil)</option>
                                    </select>
                                    @error('hcg_result')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <label class="form-label">Nama Petugas / Dokter Pemeriksa <span class="text-danger">*</span></label>
                            <input type="text" name="officer_name" class="form-control @error('officer_name') is-invalid @enderror" value="{{ old('officer_name', $vaccinationRecord->officer_name) }}" placeholder="Nama petugas medis" required>
                            @error('officer_name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top d-flex justify-content-end gap-2">
                        <a href="{{ route('patients.show', $vaccinationRecord->patient_id) }}" class="btn btn-light rounded-pill px-4 fw-semibold border">Batal</a>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm d-flex align-items-center gap-2">
                            <i class="fas fa-check"></i>
                            <span>Simpan Perubahan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleHcgResult() {
        var isChecked = document.getElementById('hcg_done').checked;
        var container = document.getElementById('hcg_result_container');
        if (isChecked) {
            container.style.display = 'block';
        } else {
            container.style.display = 'none';
        }
    }
</script>
@endsection

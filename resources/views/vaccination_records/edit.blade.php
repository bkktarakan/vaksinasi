@extends('layouts.app')

@section('content')
<div class="mb-4 d-flex align-items-center">
    <a href="{{ route('patients.show', $vaccinationRecord->patient_id) }}" class="btn btn-light shadow-sm me-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
        <i class="fas fa-arrow-left"></i>
    </a>
    <div>
        <h2 class="page-header mb-1">Edit Riwayat Vaksinasi</h2>
        <p class="text-muted mb-0">Perbarui data vaksin yang mungkin salah diinput.</p>
    </div>
</div>

<div class="card card-hover border-0">
    <div class="card-body p-5">
        <form action="{{ route('vaccination-records.update', $vaccinationRecord->id) }}" method="POST">
            @csrf
            @method('PUT')

            <h5 class="fw-bold mb-4 text-primary border-bottom pb-2"><i class="fas fa-syringe me-2"></i> Data Vaksinasi</h5>
            
            <div class="alert alert-info mb-4 border-0 shadow-sm rounded-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-info-circle fa-2x me-3 text-info"></i>
                    <div>
                        <h6 class="mb-1 fw-bold">Informasi Stok Otomatis</h6>
                        <p class="mb-0 small">Jika Anda mengganti jenis vaksin, stok vaksin yang lama akan dikembalikan, dan stok vaksin yang baru akan dipotong secara otomatis.</p>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Pilih Jenis Vaksin <span class="text-danger">*</span></label>
                    <select name="vaccine_id" class="form-select @error('vaccine_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Vaksin --</option>
                        @foreach($vaccines as $vaccine)
                            <option value="{{ $vaccine->id }}" {{ old('vaccine_id', $vaccinationRecord->vaccine_id) == $vaccine->id ? 'selected' : '' }}>
                                {{ $vaccine->name }} (Stok tersisa: {{ $vaccine->stock }})
                            </option>
                        @endforeach
                    </select>
                    @error('vaccine_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-bold">Tanggal Vaksinasi <span class="text-danger">*</span></label>
                    <input type="date" name="vaccination_date" class="form-control @error('vaccination_date') is-invalid @enderror" value="{{ old('vaccination_date', $vaccinationRecord->vaccination_date) }}" required>
                    @error('vaccination_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-bold">Tes HCG <span class="text-muted small">(Khusus Perempuan)</span></label>
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" id="hcg_done" name="hcg_done" value="1" {{ old('hcg_done', $vaccinationRecord->hcg_done) ? 'checked' : '' }} onchange="toggleHcgResult()">
                        <label class="form-check-label" for="hcg_done">Dilakukan tes HCG</label>
                    </div>
                </div>
                
                <div class="col-md-6" id="hcg_result_container" style="{{ old('hcg_done', $vaccinationRecord->hcg_done) ? '' : 'display: none;' }}">
                    <label class="form-label fw-bold">Hasil Tes HCG</label>
                    <select name="hcg_result" class="form-select @error('hcg_result') is-invalid @enderror">
                        <option value="">-- Pilih Hasil --</option>
                        <option value="Negatif" {{ old('hcg_result', $vaccinationRecord->hcg_result) == 'Negatif' ? 'selected' : '' }}>Negatif</option>
                        <option value="Positif" {{ old('hcg_result', $vaccinationRecord->hcg_result) == 'Positif' ? 'selected' : '' }}>Positif</option>
                    </select>
                    @error('hcg_result')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-12">
                    <label class="form-label fw-bold">Nama Petugas / Dokter</label>
                    <input type="text" name="officer_name" class="form-control @error('officer_name') is-invalid @enderror" value="{{ old('officer_name', $vaccinationRecord->officer_name) }}" placeholder="Contoh: dr. Budi / Perawat Siti">
                    @error('officer_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="mt-5 text-end">
                <a href="{{ route('patients.show', $vaccinationRecord->patient_id) }}" class="btn btn-light rounded-pill px-4 me-2 border">Batal</a>
                <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">
                    <i class="fas fa-save me-2"></i> Simpan Perubahan
                </button>
            </div>
        </form>
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
            container.querySelector('select').value = '';
        }
    }
</script>
@endsection

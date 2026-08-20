@extends('layouts.app')

@section('content')
<h2 class="page-header mb-4">Registrasi Pasien & Vaksinasi</h2>

<div class="card card-hover border-0">
    <div class="card-body p-0">
        <form action="{{ route('patients.store') }}" method="POST">
            @csrf
            <div class="row g-0">
                <!-- Data Pasien -->
                <div class="col-lg-7 p-5 border-end border-light">
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                            <i class="fas fa-id-card text-primary fs-4"></i>
                        </div>
                        <h4 class="mb-0 fw-bold" style="color: var(--dark);">Data Diri Pasien</h4>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted small text-uppercase">No. Barcode <span class="text-danger">*</span></label>
                            <input type="text" name="barcode_number" class="form-control form-control-lg fs-6 @error('barcode_number') is-invalid @enderror" value="{{ old('barcode_number') }}" required>
                            @error('barcode_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mt-3 mt-md-0">
                            <label class="form-label fw-semibold text-muted small text-uppercase">Tanggal Terbit e-ICV <span class="text-danger">*</span></label>
                            <input type="date" name="e_icv_issue_date" class="form-control form-control-lg fs-6 @error('e_icv_issue_date') is-invalid @enderror" value="{{ old('e_icv_issue_date') }}" required>
                            @error('e_icv_issue_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted small text-uppercase">No. Paspor <span class="text-danger">*</span></label>
                            <input type="text" name="passport_number" class="form-control form-control-lg fs-6 @error('passport_number') is-invalid @enderror" value="{{ old('passport_number') }}" required>
                            @error('passport_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mt-3 mt-md-0">
                            <label class="form-label fw-semibold text-muted small text-uppercase">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control form-control-lg fs-6 @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted small text-uppercase">Tempat Lahir <span class="text-danger">*</span></label>
                            <input type="text" name="place_of_birth" class="form-control form-control-lg fs-6 @error('place_of_birth') is-invalid @enderror" value="{{ old('place_of_birth') }}" required>
                            @error('place_of_birth') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mt-3 mt-md-0">
                            <label class="form-label fw-semibold text-muted small text-uppercase">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" name="date_of_birth" class="form-control form-control-lg fs-6 @error('date_of_birth') is-invalid @enderror" value="{{ old('date_of_birth') }}" required>
                            @error('date_of_birth') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted small text-uppercase">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="gender" class="form-select form-select-lg fs-6 @error('gender') is-invalid @enderror" required>
                                <option value="" disabled selected>Pilih...</option>
                                <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mt-3 mt-md-0">
                            <label class="form-label fw-semibold text-muted small text-uppercase">No. HP <span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control form-control-lg fs-6 @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted small text-uppercase">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control form-control-lg fs-6 @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted small text-uppercase">Alamat <span class="text-danger">*</span></label>
                        <textarea name="address" class="form-control form-control-lg fs-6 @error('address') is-invalid @enderror" rows="2" required>{{ old('address') }}</textarea>
                        @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Data Vaksinasi -->
                <div class="col-lg-5 p-5 bg-light rounded-end" style="border-radius: 0 16px 16px 0;">
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-secondary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                            <i class="fas fa-syringe text-secondary fs-4"></i>
                        </div>
                        <h4 class="mb-0 fw-bold" style="color: var(--dark);">Data Vaksinasi</h4>
                    </div>

                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <div class="mb-4">
                                <label class="form-label fw-bold">Tanggal Pelaksanaan <span class="text-danger">*</span></label>
                                <input type="date" name="vaccination_date" class="form-control form-control-lg fs-6 @error('vaccination_date') is-invalid @enderror" value="{{ old('vaccination_date', \Carbon\Carbon::now()->format('Y-m-d')) }}" required>
                                @error('vaccination_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Jenis Vaksin (Bisa >1) <span class="text-danger">*</span></label>
                                <div class="bg-white border rounded p-3 @error('vaccine_ids') border-danger @enderror">
                                    @foreach($vaccines as $vaccine)
                                        <div class="form-check custom-checkbox mb-2">
                                            <input class="form-check-input" type="checkbox" name="vaccine_ids[]" value="{{ $vaccine->id }}" id="vaccine_{{ $vaccine->id }}" {{ (is_array(old('vaccine_ids')) && in_array($vaccine->id, old('vaccine_ids'))) ? 'checked' : '' }}>
                                            <label class="form-check-label d-flex justify-content-between align-items-center" for="vaccine_{{ $vaccine->id }}">
                                                <span><i class="fas fa-vial text-primary me-2"></i> {{ $vaccine->name }}</span>
                                                <span class="badge bg-light text-dark border">Sisa: {{ $vaccine->stock }}</span>
                                            </label>
                                        </div>
                                    @endforeach
                                    
                                    @if($vaccines->isEmpty())
                                        <div class="alert alert-warning mb-0 border-0 shadow-sm p-2 text-center">
                                            <i class="fas fa-exclamation-triangle me-1"></i> Data Master Vaksin masih kosong. <br>
                                            <a href="{{ route('vaccines.create') }}" class="fw-bold text-dark d-inline-block mt-1">Tambah Stok Vaksin Baru di sini</a>
                                        </div>
                                    @endif
                                </div>
                                @error('vaccine_ids') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <!-- HCG Check -->
                            <div class="mb-4 p-3 bg-white border rounded">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="hcg_done" name="hcg_done" value="1" {{ old('hcg_done') ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold" for="hcg_done">Dilakukan Tes HCG?</label>
                                </div>
                                <div id="hcg_result_container" style="{{ old('hcg_done') ? '' : 'display: none;' }}">
                                    <label class="form-label text-muted small mt-2">Hasil HCG</label>
                                    <select name="hcg_result" id="hcg_result" class="form-select fs-6">
                                        <option value="Negatif" {{ old('hcg_result') == 'Negatif' ? 'selected' : '' }}>Negatif</option>
                                        <option value="Positif" {{ old('hcg_result') == 'Positif' ? 'selected' : '' }}>Positif</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-2">
                                <label class="form-label fw-bold">Nama Petugas</label>
                                <input type="text" name="officer_name" class="form-control form-control-lg fs-6 @error('officer_name') is-invalid @enderror" value="{{ old('officer_name') }}" placeholder="Nama petugas medis">
                                @error('officer_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm py-3 fw-bold" style="font-size: 1.1rem;" {{ $vaccines->isEmpty() ? 'disabled' : '' }}>
                            <i class="fas fa-check-circle me-2"></i> Simpan Data Registrasi
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const hcgCheckbox = document.getElementById('hcg_done');
        const hcgContainer = document.getElementById('hcg_result_container');
        
        hcgCheckbox.addEventListener('change', function() {
            if (this.checked) {
                hcgContainer.style.display = 'block';
                // Add simple fade in
                hcgContainer.style.opacity = '0';
                setTimeout(() => {
                    hcgContainer.style.transition = 'opacity 0.3s ease';
                    hcgContainer.style.opacity = '1';
                }, 10);
            } else {
                hcgContainer.style.display = 'none';
            }
        });
    });
</script>
@endsection

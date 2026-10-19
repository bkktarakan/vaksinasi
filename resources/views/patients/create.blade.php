@extends('layouts.app')

@section('title', 'Registrasi Pasien & Vaksinasi')

@section('content')
<!-- Page Header -->
<div class="mb-4">
    <div class="d-flex align-items-center gap-3">
        <a href="{{ route('patients.index') }}" class="btn btn-light rounded-circle shadow-sm d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; border: 1px solid var(--slate-200);" title="Kembali">
            <i class="fas fa-arrow-left text-muted"></i>
        </a>
        <div>
            <h2 class="fw-bold mb-0 text-dark" style="letter-spacing: -0.5px;">Registrasi Pasien Baru</h2>
            <p class="text-muted small mb-0">Input data diri pasien dan pencatatan vaksinasi internasional (e-ICV).</p>
        </div>
    </div>
</div>

<form action="{{ route('patients.store') }}" method="POST">
    @csrf
    <div class="row g-4">
        <!-- Kolom Kiri: Biodata Pasien -->
        <div class="col-lg-7">
            <div class="card border-0 h-100">
                <div class="card-header bg-white border-0 pt-4 pb-2 px-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; background: rgba(2, 132, 199, 0.1); color: var(--primary);">
                            <i class="fas fa-id-card fs-5"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0 text-dark">Data Identitas Pasien</h5>
                            <p class="text-muted small mb-0">Pastikan nomor paspor dan barcode sesuai dengan dokumen resmi.</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4 pt-3">
                    <div class="row g-3">
                        <!-- Barcode & e-ICV Date -->
                        <div class="col-md-6">
                            <label class="form-label">No. Barcode <span class="text-danger">*</span></label>
                            <div class="position-relative">
                                <input type="text" name="barcode_number" class="form-control @error('barcode_number') is-invalid @enderror" value="{{ old('barcode_number') }}" placeholder="Contoh: BKK-2026-001" required>
                            </div>
                            @error('barcode_number') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tgl. Terbit e-ICV <span class="text-danger">*</span></label>
                            <input type="date" name="e_icv_issue_date" class="form-control @error('e_icv_issue_date') is-invalid @enderror" value="{{ old('e_icv_issue_date', date('Y-m-d')) }}" required>
                            @error('e_icv_issue_date') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <!-- Passport & Full Name -->
                        <div class="col-md-6">
                            <label class="form-label">No. Paspor <span class="text-danger">*</span></label>
                            <input type="text" name="passport_number" class="form-control @error('passport_number') is-invalid @enderror" value="{{ old('passport_number') }}" placeholder="Nomor paspor aktif" required>
                            @error('passport_number') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap Pasien <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Sesuai nama di paspor" required>
                            @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <!-- Place & Date of Birth -->
                        <div class="col-md-6">
                            <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                            <input type="text" name="place_of_birth" class="form-control @error('place_of_birth') is-invalid @enderror" value="{{ old('place_of_birth') }}" placeholder="Kota kelahiran" required>
                            @error('place_of_birth') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" value="{{ old('date_of_birth') }}" required>
                            @error('date_of_birth') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <!-- Gender & Phone -->
                        <div class="col-md-6">
                            <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="gender" id="genderSelect" class="form-select @error('gender') is-invalid @enderror" required onchange="handleGenderChange(this.value)">
                                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('gender') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Nomor WhatsApp / HP <span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="Contoh: 08123456789" required>
                            @error('phone') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <!-- Email -->
                        <div class="col-12">
                            <label class="form-label">Alamat Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="alamat@email.com" required>
                            @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <!-- Address -->
                        <div class="col-12">
                            <label class="form-label">Alamat Domisili <span class="text-danger">*</span></label>
                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="2" placeholder="Alamat lengkap tempat tinggal" required>{{ old('address') }}</textarea>
                            @error('address') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Tindakan Vaksinasi -->
        <div class="col-lg-5">
            <div class="card border-0 h-100" style="background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);">
                <div class="card-header bg-transparent border-0 pt-4 pb-2 px-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; background: rgba(16, 185, 129, 0.1); color: var(--emerald);">
                            <i class="fas fa-syringe fs-5"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0 text-dark">Layanan Vaksinasi</h5>
                            <p class="text-muted small mb-0">Pilih jenis vaksin yang disuntikkan hari ini.</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 pt-3 d-flex flex-column justify-content-between">
                    <div>
                        <!-- Tanggal Pelaksanaan -->
                        <div class="mb-4">
                            <label class="form-label">Tanggal Pelaksanaan Vaksin <span class="text-danger">*</span></label>
                            <input type="date" name="vaccination_date" class="form-control @error('vaccination_date') is-invalid @enderror" value="{{ old('vaccination_date', date('Y-m-d')) }}" required>
                            @error('vaccination_date') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <!-- Pilih Vaksin (Custom Card Selection) -->
                        <div class="mb-4">
                            <label class="form-label">Pilih Jenis Vaksin (Bisa &gt;1) <span class="text-danger">*</span></label>
                            <div class="d-flex flex-column gap-2">
                                @forelse($vaccines as $vaccine)
                                    @php
                                        $isChecked = is_array(old('vaccine_ids')) && in_array($vaccine->id, old('vaccine_ids'));
                                        $isOutOfStock = $vaccine->stock <= 0;
                                    @endphp
                                    <label class="vaccine-card-label {{ $isOutOfStock ? 'disabled' : '' }}" for="vaccine_{{ $vaccine->id }}" style="display: block; cursor: {{ $isOutOfStock ? 'not-allowed' : 'pointer' }};">
                                        <div class="vaccine-select-card p-3 rounded-3 d-flex align-items-center justify-content-between border" style="background: #ffffff; transition: all 0.2s ease;">
                                            <div class="d-flex align-items-center gap-3">
                                                <input class="form-check-input mt-0 fs-5" 
                                                       type="checkbox" 
                                                       name="vaccine_ids[]" 
                                                       value="{{ $vaccine->id }}" 
                                                       id="vaccine_{{ $vaccine->id }}" 
                                                       {{ $isChecked ? 'checked' : '' }}
                                                       {{ $isOutOfStock ? 'disabled' : '' }}
                                                       onchange="highlightVaccineCard(this)">
                                                <div>
                                                    <span class="fw-bold text-dark d-block">{{ $vaccine->name }}</span>
                                                    <span class="text-muted small">Dosis tunggal / booster</span>
                                                </div>
                                            </div>
                                            <div>
                                                @if($vaccine->stock > 10)
                                                    <span class="badge badge-soft-emerald">Stok: {{ $vaccine->stock }}</span>
                                                @elseif($vaccine->stock > 0)
                                                    <span class="badge badge-soft-amber">Stok: {{ $vaccine->stock }}</span>
                                                @else
                                                    <span class="badge badge-soft-rose">Habis</span>
                                                @endif
                                            </div>
                                        </div>
                                    </label>
                                @empty
                                    <div class="alert alert-warning border-0 p-3 rounded-3 text-center">
                                        <i class="fas fa-triangle-exclamation mb-1 fs-5 d-block text-warning"></i>
                                        <span class="small fw-semibold">Data master vaksin belum tersedia.</span>
                                        <a href="{{ route('vaccines.create') }}" class="d-block mt-2 fw-bold text-primary small">Tambah Master Vaksin Sekarang</a>
                                    </div>
                                @endforelse
                            </div>
                            @error('vaccine_ids') <div class="text-danger small mt-2">{{ $message }}</div> @enderror
                        </div>

                        <!-- Tes HCG Switch -->
                        <div class="card border p-3 mb-4 rounded-3" style="background: #ffffff;" id="hcgCardSection">
                            <div class="form-check form-switch d-flex align-items-center justify-content-between p-0 mb-0">
                                <label class="form-check-label fw-bold text-dark mb-0" for="hcg_done" style="cursor: pointer;">
                                    <i class="fas fa-vial text-info me-2"></i>Dilakukan Tes HCG?
                                </label>
                                <input class="form-check-input fs-5 ms-0" type="checkbox" id="hcg_done" name="hcg_done" value="1" {{ old('hcg_done') ? 'checked' : '' }} onchange="toggleHcgResult(this.checked)" style="cursor: pointer;">
                            </div>

                            <div id="hcg_result_container" class="mt-3 pt-3 border-top" style="{{ old('hcg_done') ? '' : 'display: none;' }}">
                                <label class="form-label">Hasil Tes HCG</label>
                                <select name="hcg_result" id="hcg_result" class="form-select">
                                    <option value="Negatif" {{ old('hcg_result') == 'Negatif' ? 'selected' : '' }}>Negatif (Tidak Hamil)</option>
                                    <option value="Positif" {{ old('hcg_result') == 'Positif' ? 'selected' : '' }}>Positif (Hamil)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Nama Petugas -->
                        <div class="mb-4">
                            <label class="form-label">Nama Petugas / Dokter Pemeriksa <span class="text-danger">*</span></label>
                            <div class="position-relative">
                                <input type="text" name="officer_name" class="form-control @error('officer_name') is-invalid @enderror" value="{{ old('officer_name', auth()->user()->name) }}" placeholder="Nama petugas medis yang bertugas" required>
                            </div>
                            @error('officer_name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2" style="font-size: 1.05rem;" {{ $vaccines->isEmpty() ? 'disabled' : '' }}>
                            <i class="fas fa-check-circle fs-5"></i>
                            <span>Simpan & Terbitkan e-ICV</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<style>
    .vaccine-card-label input:checked ~ .vaccine-select-card,
    .vaccine-select-card.active {
        border-color: var(--primary) !important;
        background-color: rgba(2, 132, 199, 0.04) !important;
        box-shadow: 0 0 0 1px var(--primary);
    }
</style>

<script>
    function toggleHcgResult(checked) {
        const container = document.getElementById('hcg_result_container');
        if (checked) {
            container.style.display = 'block';
        } else {
            container.style.display = 'none';
        }
    }

    function handleGenderChange(gender) {
        // If female, subtly highlight HCG check
        const hcgCard = document.getElementById('hcgCardSection');
        if (gender === 'Perempuan') {
            hcgCard.style.borderColor = 'var(--primary)';
        } else {
            hcgCard.style.borderColor = 'var(--slate-200)';
        }
    }

    function highlightVaccineCard(checkbox) {
        const card = checkbox.closest('.vaccine-select-card');
        if (checkbox.checked) {
            card.classList.add('active');
        } else {
            card.classList.remove('active');
        }
    }

    // Init active states on page load
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('input[name="vaccine_ids[]"]:checked').forEach(cb => {
            cb.closest('.vaccine-select-card').classList.add('active');
        });
    });
</script>
@endsection

@extends('layouts.app')

@section('title', 'Edit Data Pasien - ' . $patient->name)

@section('content')
<div class="mb-4 d-flex align-items-center gap-3">
    <a href="{{ route('patients.show', $patient->id) }}" class="btn btn-light rounded-circle shadow-sm d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; border: 1px solid var(--slate-200);" title="Kembali ke Detail Pasien">
        <i class="fas fa-arrow-left text-muted"></i>
    </a>
    <div>
        <h2 class="fw-bold mb-0 text-dark" style="letter-spacing: -0.5px;">Edit Biodata Pasien</h2>
        <p class="text-muted small mb-0">Perbarui informasi identitas dokumen dan kontak pasien.</p>
    </div>
</div>

<div class="row">
    <div class="col-lg-9 col-xl-8">
        <div class="card border-0">
            <div class="card-header bg-white border-0 pt-4 pb-2 px-4">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background: rgba(245, 158, 11, 0.1); color: var(--amber);">
                        <i class="fas fa-user-pen fs-5"></i>
                    </div>
                    <h5 class="fw-bold mb-0 text-dark">Formulir Perubahan Data Pasien</h5>
                </div>
            </div>

            <div class="card-body p-4 pt-3">
                <form action="{{ route('patients.update', $patient->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap Pasien <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $patient->name) }}" required>
                            @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">No. Paspor <span class="text-danger">*</span></label>
                            <input type="text" name="passport_number" class="form-control @error('passport_number') is-invalid @enderror" value="{{ old('passport_number', $patient->passport_number) }}" required>
                            @error('passport_number')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">No. Barcode <span class="text-danger">*</span></label>
                            <input type="text" name="barcode_number" class="form-control @error('barcode_number') is-invalid @enderror" value="{{ old('barcode_number', $patient->barcode_number) }}" required>
                            @error('barcode_number')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Terbit e-ICV <span class="text-danger">*</span></label>
                            <input type="date" name="e_icv_issue_date" class="form-control @error('e_icv_issue_date') is-invalid @enderror" value="{{ old('e_icv_issue_date', $patient->e_icv_issue_date) }}" required>
                            @error('e_icv_issue_date')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                            <input type="text" name="place_of_birth" class="form-control @error('place_of_birth') is-invalid @enderror" value="{{ old('place_of_birth', $patient->place_of_birth) }}" required>
                            @error('place_of_birth')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" value="{{ old('date_of_birth', $patient->date_of_birth) }}" required>
                            @error('date_of_birth')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="gender" class="form-select @error('gender') is-invalid @enderror" required>
                                <option value="Laki-laki" {{ old('gender', $patient->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('gender', $patient->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('gender')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">No. WhatsApp / HP <span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $patient->phone) }}" required>
                            @error('phone')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>
                        
                        <div class="col-12">
                            <label class="form-label">Alamat Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $patient->email) }}" required>
                            @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>
                        
                        <div class="col-12">
                            <label class="form-label">Alamat Domisili <span class="text-danger">*</span></label>
                            <textarea name="address" rows="2" class="form-control @error('address') is-invalid @enderror" required>{{ old('address', $patient->address) }}</textarea>
                            @error('address')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top d-flex justify-content-end gap-2">
                        <a href="{{ route('patients.show', $patient->id) }}" class="btn btn-light rounded-pill px-4 fw-semibold border">Batal</a>
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
@endsection

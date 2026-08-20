@extends('layouts.app')

@section('content')
<div class="mb-4 d-flex align-items-center">
    <a href="{{ route('patients.index') }}" class="btn btn-light shadow-sm me-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
        <i class="fas fa-arrow-left"></i>
    </a>
    <div>
        <h2 class="page-header mb-1">Edit Data Pasien</h2>
        <p class="text-muted mb-0">Perbarui informasi biodata pasien.</p>
    </div>
</div>

<div class="card card-hover border-0">
    <div class="card-body p-5">
        <form action="{{ route('patients.update', $patient->id) }}" method="POST">
            @csrf
            @method('PUT')

            <h5 class="fw-bold mb-4 text-primary border-bottom pb-2"><i class="fas fa-user-edit me-2"></i> Biodata Pasien</h5>
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $patient->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-bold">No. Paspor <span class="text-danger">*</span></label>
                    <input type="text" name="passport_number" class="form-control @error('passport_number') is-invalid @enderror" value="{{ old('passport_number', $patient->passport_number) }}" required>
                    @error('passport_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-bold">No. Barcode <span class="text-danger">*</span></label>
                    <input type="text" name="barcode_number" class="form-control @error('barcode_number') is-invalid @enderror" value="{{ old('barcode_number', $patient->barcode_number) }}" required>
                    @error('barcode_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-bold">Tanggal Terbit e-ICV <span class="text-danger">*</span></label>
                    <input type="date" name="e_icv_issue_date" class="form-control @error('e_icv_issue_date') is-invalid @enderror" value="{{ old('e_icv_issue_date', $patient->e_icv_issue_date) }}" required>
                    @error('e_icv_issue_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-bold">Tempat Lahir <span class="text-danger">*</span></label>
                    <input type="text" name="place_of_birth" class="form-control @error('place_of_birth') is-invalid @enderror" value="{{ old('place_of_birth', $patient->place_of_birth) }}" required>
                    @error('place_of_birth')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-bold">Tanggal Lahir <span class="text-danger">*</span></label>
                    <input type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" value="{{ old('date_of_birth', $patient->date_of_birth) }}" required>
                    @error('date_of_birth')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-bold">Jenis Kelamin <span class="text-danger">*</span></label>
                    <select name="gender" class="form-select @error('gender') is-invalid @enderror" required>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Laki-laki" {{ old('gender', $patient->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('gender', $patient->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-bold">No. Handphone <span class="text-danger">*</span></label>
                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $patient->phone) }}" required>
                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $patient->email) }}" required>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-12">
                    <label class="form-label fw-bold">Alamat Lengkap <span class="text-danger">*</span></label>
                    <textarea name="address" rows="3" class="form-control @error('address') is-invalid @enderror" required>{{ old('address', $patient->address) }}</textarea>
                    @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="mt-5 text-end">
                <a href="{{ route('patients.index') }}" class="btn btn-light rounded-pill px-4 me-2 border">Batal</a>
                <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">
                    <i class="fas fa-save me-2"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

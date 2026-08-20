@extends('layouts.app')

@section('content')
<div class="mb-4 d-flex align-items-center">
    <a href="{{ route('vaccines.index') }}" class="btn btn-light shadow-sm me-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
        <i class="fas fa-arrow-left text-primary"></i>
    </a>
    <div>
        <h2 class="page-header mb-1">Tambah Vaksin</h2>
        <p class="text-muted mb-0">Masukkan data vaksin baru ke dalam sistem.</p>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card card-hover border-0">
            <div class="card-body p-5">
                <form action="{{ route('vaccines.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Nama Vaksin <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="fas fa-vial text-muted"></i></span>
                            <input type="text" name="name" class="form-control border-start-0 ps-0 @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Contoh: Meningitis" required>
                        </div>
                        @error('name')
                            <div class="text-danger small mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Stok Awal <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="fas fa-box text-muted"></i></span>
                            <input type="number" name="stock" class="form-control border-start-0 ps-0 @error('stock') is-invalid @enderror" value="{{ old('stock', 0) }}" min="0" required>
                        </div>
                        @error('stock')
                            <div class="text-danger small mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid mt-5">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm">
                            <i class="fas fa-save me-2"></i> Simpan Data Vaksin
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

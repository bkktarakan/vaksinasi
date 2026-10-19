@extends('layouts.app')

@section('title', 'Edit Master Vaksin')

@section('content')
<div class="mb-4 d-flex align-items-center gap-3">
    <a href="{{ route('vaccines.index') }}" class="btn btn-light rounded-circle shadow-sm d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; border: 1px solid var(--slate-200);" title="Kembali ke Master Vaksin">
        <i class="fas fa-arrow-left text-muted"></i>
    </a>
    <div>
        <h2 class="fw-bold mb-0 text-dark" style="letter-spacing: -0.5px;">Edit Master Vaksin</h2>
        <p class="text-muted small mb-0">Perbarui nama jenis vaksin dan sesuaikan jumlah kuota stok fisik.</p>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 col-xl-5">
        <div class="card border-0">
            <div class="card-header bg-white border-0 pt-4 pb-2 px-4">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background: rgba(245, 158, 11, 0.1); color: var(--amber);">
                        <i class="fas fa-pen-to-square fs-5"></i>
                    </div>
                    <h5 class="fw-bold mb-0 text-dark">Edit: {{ $vaccine->name }}</h5>
                </div>
            </div>
            <div class="card-body p-4 pt-3">
                <form action="{{ route('vaccines.update', $vaccine->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="form-label">Nama Vaksin <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $vaccine->name) }}" required>
                        @error('name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Jumlah Stok Dosis <span class="text-danger">*</span></label>
                        <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $vaccine->stock) }}" min="0" required>
                        @error('stock')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary rounded-pill py-3 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2">
                            <i class="fas fa-save"></i>
                            <span>Simpan Perubahan Stok</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

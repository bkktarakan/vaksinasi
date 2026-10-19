@extends('layouts.app')

@section('title', 'Master Vaksin')

@section('content')
<!-- Header Page -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1">
            <h2 class="fw-bold mb-0 text-dark" style="letter-spacing: -0.5px;">Data Master Vaksin</h2>
            <span class="badge badge-soft-primary fs-6">{{ $vaccines->count() }} Varian</span>
        </div>
        <p class="text-muted small mb-0">Kelola jenis vaksin internasional dan kuota stok dosis ketersediaan.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('vaccines.create') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-bold shadow-sm d-inline-flex align-items-center gap-2">
            <i class="fas fa-plus-circle"></i>
            <span>Tambah Vaksin Baru</span>
        </a>
    </div>
</div>

<!-- Vaccine Cards / Table -->
<div class="card border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th>Nama Jenis Vaksin</th>
                        <th width="35%">Ketersediaan & Stok Dosis</th>
                        <th>Status Logistik</th>
                        <th width="15%" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($vaccines as $index => $vaccine)
                    @php
                        $stockPercentage = min(100, max(5, ($vaccine->stock / 50) * 100));
                        if ($vaccine->stock >= 20) {
                            $barColor = 'bg-success';
                            $badgeClass = 'badge-soft-emerald';
                            $statusLabel = 'Stok Aman';
                        } elseif ($vaccine->stock >= 10) {
                            $barColor = 'bg-warning';
                            $badgeClass = 'badge-soft-amber';
                            $statusLabel = 'Perlu Dipantau';
                        } else {
                            $barColor = 'bg-danger';
                            $badgeClass = 'badge-soft-rose';
                            $statusLabel = 'Stok Kritis';
                        }
                    @endphp
                    <tr>
                        <td class="text-center text-muted fw-bold">{{ $index + 1 }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center text-white flex-shrink-0" style="width: 42px; height: 42px; background: linear-gradient(135deg, #0284c7 0%, #06b6d4 100%);">
                                    <i class="fas fa-vial-virus fs-5"></i>
                                </div>
                                <div>
                                    <div class="fw-bold text-dark fs-6">{{ $vaccine->name }}</div>
                                    <span class="text-muted small">ID Vaksin #{{ $vaccine->id }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-between align-items-baseline mb-1">
                                <span class="fw-bold text-dark fs-6">{{ $vaccine->stock }}</span>
                                <span class="text-muted small">dosis tersedia</span>
                            </div>
                            <div class="progress" style="height: 8px; border-radius: 100px; background-color: var(--slate-100);">
                                <div class="progress-bar {{ $barColor }} rounded-pill" role="progressbar" style="width: {{ $stockPercentage }}%" aria-valuenow="{{ $vaccine->stock }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </td>
                        <td>
                            <span class="badge {{ $badgeClass }}">
                                <i class="fas fa-circle me-1" style="font-size: 0.5rem; vertical-align: middle;"></i>{{ $statusLabel }}
                            </span>
                        </td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-1">
                                <a href="{{ route('vaccines.edit', $vaccine->id) }}" class="btn-action-icon edit" title="Edit Vaksin & Stok">
                                    <i class="fas fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('vaccines.destroy', $vaccine->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus vaksin {{ $vaccine->name }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action-icon delete" title="Hapus Vaksin">
                                        <i class="fas fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="mb-3">
                                <i class="fas fa-boxes-packing fa-3x text-muted opacity-25"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-1">Belum Ada Data Master Vaksin</h5>
                            <p class="text-muted small mb-3">Tambahkan jenis vaksin seperti Yellow Fever atau Meningitis untuk mulai pencatatan.</p>
                            <a href="{{ route('vaccines.create') }}" class="btn btn-primary rounded-pill px-4">
                                <i class="fas fa-plus me-1"></i> Tambah Vaksin Baru
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

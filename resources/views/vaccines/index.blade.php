@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="page-header mb-1">Data Master Vaksin</h2>
        <p class="text-muted">Kelola jenis vaksin dan jumlah stok yang tersedia.</p>
    </div>
    <a href="{{ route('vaccines.create') }}" class="btn btn-primary shadow-sm rounded-pill px-4">
        <i class="fas fa-plus me-2"></i> Tambah Vaksin
    </a>
</div>

<div class="card card-hover border-0">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="8%" class="border-0 rounded-start text-center">No</th>
                        <th class="border-0">Nama Vaksin</th>
                        <th width="20%" class="border-0 text-center">Stok</th>
                        <th width="20%" class="border-0 rounded-end text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($vaccines as $index => $vaccine)
                    <tr>
                        <td class="text-center text-muted fw-bold">{{ $index + 1 }}</td>
                        <td class="fw-medium">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                    <i class="fas fa-vial text-primary"></i>
                                </div>
                                {{ $vaccine->name }}
                            </div>
                        </td>
                        <td class="text-center">
                            <span class="badge rounded-pill {{ $vaccine->stock > 10 ? 'bg-success' : 'bg-danger' }}" style="font-size: 0.95rem; padding: 8px 16px;">
                                {{ $vaccine->stock }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('vaccines.edit', $vaccine->id) }}" class="btn btn-sm btn-outline-warning rounded-pill px-3 me-2" title="Edit">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('vaccines.destroy', $vaccine->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data vaksin ini?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger rounded-pill px-3" title="Hapus">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <div class="mb-3">
                                <img src="https://cdn-icons-png.flaticon.com/512/7486/7486747.png" alt="No data" width="80" class="opacity-50">
                            </div>
                            <h5 class="text-muted">Data vaksin belum tersedia</h5>
                            <p class="text-muted small">Silakan tambahkan jenis vaksin baru untuk mulai mengelola stok.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

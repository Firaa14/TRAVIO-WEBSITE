@extends('admin.layouts.app')

@section('title', 'Manajemen Destinasi')
@section('page-title', 'Manajemen Destinasi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Daftar Destinasi</h4>
    <a href="{{ route('admin.destinasi.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Tambah Destinasi
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-map-marked-alt me-2"></i>Data Destinasi</h5>
    </div>
    <div class="card-body">
        @if($destinasi->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($destinasi as $index => $item)
                    <tr>
                        <td>{{ ($destinasi->currentPage() - 1) * $destinasi->perPage() + $index + 1 }}</td>
                        <td>
                            @if($item->image)
                                <img src="{{ Storage::url($item->image) }}" alt="{{ $item->name }}" 
                                     class="rounded" width="60" height="40" style="object-fit: cover;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                     style="width: 60px; height: 40px;">
                                    <i class="fas fa-image text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td>{{ $item->name }}</td>
                        <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td>{{ Str::limit($item->description, 50) }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.destinasi.show', $item) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.destinasi.edit', $item) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.destinasi.destroy', $item) }}" method="POST" class="d-inline" 
                                      onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            {{ $destinasi->links() }}
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-map-marked-alt fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">Belum ada data destinasi</h5>
            <p class="text-muted">Klik tombol "Tambah Destinasi" untuk menambahkan data pertama</p>
        </div>
        @endif
    </div>
</div>
@endsection
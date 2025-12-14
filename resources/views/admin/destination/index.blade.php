@extends('admin.layouts.app')

@section('title', 'Manajemen Destination')
@section('page-title', 'Manajemen Destination')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Daftar Destination</h4>
    <a href="{{ route('admin.destination.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Tambah Destination
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-mountain me-2"></i>Data Destination</h5>
    </div>
    <div class="card-body">
        @if($destinations->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Destinasi</th>
                        <th>Lokasi</th>
                        <th>Detail</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($destinations as $index => $destination)
                    <tr>
                        <td>{{ ($destinations->currentPage() - 1) * $destinations->perPage() + $index + 1 }}</td>
                        <td>
                            @if($destination->destinasi)
                                {{ $destination->destinasi->name }}
                            @else
                                <span class="text-muted">Destinasi tidak ditemukan</span>
                            @endif
                        </td>
                        <td>{{ $destination->location }}</td>
                        <td>{{ Str::limit($destination->detail, 50) }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.destination.show', $destination) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.destination.edit', $destination) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.destination.destroy', $destination) }}" method="POST" class="d-inline" 
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
            {{ $destinations->links() }}
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-mountain fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">Belum ada data destination</h5>
            <p class="text-muted">Klik tombol "Tambah Destination" untuk menambahkan data pertama</p>
        </div>
        @endif
    </div>
</div>
@endsection
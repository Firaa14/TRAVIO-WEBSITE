@extends('admin.layouts.app')

@section('title', 'Manajemen Mobil')
@section('page-title', 'Manajemen Mobil')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Daftar Mobil</h4>
    <a href="{{ route('admin.car.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Tambah Mobil
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-car me-2"></i>Data Mobil</h5>
    </div>
    <div class="card-body">
        @if($cars->count() > 0)
        <div class="table-responsive">
            <table id="carTable" class="table table-hover table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Tahun</th>
                        <th>Harga</th>
                        <th>Lokasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cars as $index => $car)
                    <tr>
                        <td>{{ ($cars->currentPage() - 1) * $cars->perPage() + $index + 1 }}</td>
                        <td>
                            @if($car->image)
                                <img src="{{ Storage::url($car->image) }}" alt="{{ $car->title }}" 
                                     class="rounded" width="60" height="40" style="object-fit: cover;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                     style="width: 60px; height: 40px;">
                                    <i class="fas fa-car text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td>{{ $car->title }}</td>
                        <td>{{ $car->brand ?? '-' }}</td>
                        <td>{{ $car->model ?? '-' }}</td>
                        <td>{{ $car->year ?? '-' }}</td>
                        <td>Rp {{ number_format($car->price, 0, ',', '.') }}</td>
                        <td>{{ $car->location ?? '-' }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.car.show', $car) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.car.edit', $car) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.car.destroy', $car) }}" method="POST" class="d-inline" 
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
            {{ $cars->links() }}
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-car fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">Belum ada data mobil</h5>
            <p class="text-muted">Klik tombol "Tambah Mobil" untuk menambahkan data pertama</p>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function () {
    // Only initialize DataTable if there are cars
    @if($cars->count() > 0)
    $("#carTable").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "ordering": true,
        "searching": true,
        "paging": false,
        "info": false,
        "columnDefs": [
            { "orderable": false, "targets": [1, -1] } // Disable sorting for image and action columns
        ]
    });
    @endif
});
</script>
@endpush
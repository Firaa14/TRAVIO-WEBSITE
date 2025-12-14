@extends('admin.layouts.app')

@section('title', 'Data Paket')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Data Paket</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Data Paket</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Paket Wisata</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.package.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Paket
                    </a>
                </div>
            </div>
            
            <div class="card-body">
                <div class="table-responsive">
                    <table id="packageTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Nama Paket</th>
                                <th>Lokasi</th>
                                <th>Durasi</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($packages as $index => $package)
                                <tr>
                                    <td>{{ $packages->firstItem() + $index }}</td>
                                    <td>
                                        @if($package->image)
                                            <img src="{{ asset('storage/' . $package->image) }}" 
                                                 alt="{{ $package->title }}" 
                                                 class="img-thumbnail" 
                                                 style="width: 80px; height: 60px; object-fit: cover;">
                                        @else
                                            <span class="text-muted">No image</span>
                                        @endif
                                    </td>
                                    <td>{{ $package->title }}</td>
                                    <td>{{ $package->location }}</td>
                                    <td>{{ $package->duration ?? '-' }}</td>
                                    <td>{{ $package->price }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.package.show', $package->id) }}" 
                                               class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.package.edit', $package->id) }}" 
                                               class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.package.destroy', $package->id) }}" 
                                                  method="POST" 
                                                  style="display: inline;" 
                                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
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
                
                <div class="d-flex justify-content-center mt-4">
                    {{ $packages->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
$(function () {
    $("#packageTable").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "ordering": true,
        "searching": true,
        "paging": false,
        "info": false
    });
});
</script>
@endpush
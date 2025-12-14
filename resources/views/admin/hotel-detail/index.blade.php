@extends('admin.layouts.app')

@section('title', 'Data Detail Hotel')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Data Detail Hotel</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Data Detail Hotel</li>
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
                <h3 class="card-title">Data Detail Hotel</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.hotel-detail.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Detail Hotel
                    </a>
                </div>
            </div>
            
            <div class="card-body">
                <div class="table-responsive">
                    <table id="hotelDetailTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Hotel</th>
                                <th>Nama</th>
                                <th>Lokasi</th>
                                <th>Rating</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hotelDetails as $index => $hotelDetail)
                                <tr>
                                    <td>{{ $hotelDetails->firstItem() + $index }}</td>
                                    <td>{{ $hotelDetail->hotel ? $hotelDetail->hotel->title : 'N/A' }}</td>
                                    <td>{{ $hotelDetail->nama }}</td>
                                    <td>{{ $hotelDetail->location }}</td>
                                    <td>
                                        @if($hotelDetail->rating)
                                            {{ $hotelDetail->rating }} ⭐
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($hotelDetail->price)
                                            Rp {{ number_format($hotelDetail->price, 0, ',', '.') }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.hotel-detail.show', $hotelDetail->id) }}" 
                                               class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.hotel-detail.edit', $hotelDetail->id) }}" 
                                               class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.hotel-detail.destroy', $hotelDetail->id) }}" 
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
                    {{ $hotelDetails->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
$(function () {
    $("#hotelDetailTable").DataTable({
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
@extends('admin.layouts.app')

@section('title', 'Detail Kamar Hotel')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Detail Kamar Hotel</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.hotel-room.index') }}">Data Kamar Hotel</a></li>
                    <li class="breadcrumb-item active">Detail Kamar</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Kamar: {{ $hotelRoom->name }}</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.hotel-room.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <a href="{{ route('admin.hotel-room.edit', $hotelRoom->id) }}" class="btn btn-warning btn-sm ml-2">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </div>
            </div>
            
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        @if($hotelRoom->room_image)
                            <div class="text-center mb-3">
                                <img src="{{ asset('storage/' . $hotelRoom->room_image) }}" 
                                     alt="{{ $hotelRoom->name }}" 
                                     class="img-fluid rounded" 
                                     style="max-height: 400px;">
                            </div>
                        @endif
                    </div>
                    
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">Hotel</th>
                                <td>{{ $hotelRoom->hotel ? $hotelRoom->hotel->title : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Nama Kamar</th>
                                <td>{{ $hotelRoom->name }}</td>
                            </tr>
                            <tr>
                                <th>Harga</th>
                                <td>Rp {{ number_format($hotelRoom->price, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Kapasitas Tamu</th>
                                <td>{{ $hotelRoom->max_guest }} orang</td>
                            </tr>
                            <tr>
                                <th>Ukuran Kamar</th>
                                <td>{{ $hotelRoom->size ?? 'Tidak ada info ukuran' }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Tempat Tidur</th>
                                <td>{{ $hotelRoom->bed_type ?? 'Tidak ada info tempat tidur' }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if($hotelRoom->availability == 'available')
                                        <span class="badge badge-success">Tersedia</span>
                                    @else
                                        <span class="badge badge-danger">Tidak Tersedia</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Dibuat</th>
                                <td>{{ $hotelRoom->created_at->format('d M Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Diperbarui</th>
                                <td>{{ $hotelRoom->updated_at->format('d M Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                @if($hotelRoom->description)
                <div class="row mt-3">
                    <div class="col-12">
                        <h5>Deskripsi</h5>
                        <div class="border p-3 rounded">
                            {!! nl2br(e($hotelRoom->description)) !!}
                        </div>
                    </div>
                </div>
                @endif

                @if($hotelRoom->facilities)
                <div class="row mt-3">
                    <div class="col-12">
                        <h5>Fasilitas</h5>
                        <div class="border p-3 rounded">
                            {!! nl2br(e($hotelRoom->facilities)) !!}
                        </div>
                    </div>
                </div>
                @endif
            </div>
            
            <div class="card-footer">
                <a href="{{ route('admin.hotel-room.edit', $hotelRoom->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit Kamar
                </a>
                <a href="{{ route('admin.hotel-room.index') }}" class="btn btn-secondary ml-2">
                    <i class="fas fa-list"></i> Daftar Kamar
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
@extends('admin.layouts.app')

@section('title', 'Detail Hotel Detail')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Detail Hotel Detail</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.hotel-detail.index') }}">Data Detail Hotel</a></li>
                    <li class="breadcrumb-item active">Detail Hotel Detail</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail: {{ $hotelDetail->nama }}</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.hotel-detail.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <a href="{{ route('admin.hotel-detail.edit', $hotelDetail->id) }}" class="btn btn-warning btn-sm ml-2">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </div>
            </div>
            
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <table class="table table-bordered">
                            <tr>
                                <th width="25%">Hotel</th>
                                <td>{{ $hotelDetail->hotel ? $hotelDetail->hotel->title : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Nama Detail</th>
                                <td>{{ $hotelDetail->nama }}</td>
                            </tr>
                            <tr>
                                <th>Lokasi</th>
                                <td>{{ $hotelDetail->location }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $hotelDetail->address ?? 'Tidak ada alamat' }}</td>
                            </tr>
                            <tr>
                                <th>Telepon</th>
                                <td>{{ $hotelDetail->phone ?? 'Tidak ada telepon' }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $hotelDetail->email ?? 'Tidak ada email' }}</td>
                            </tr>
                            <tr>
                                <th>Rating</th>
                                <td>
                                    @if($hotelDetail->rating)
                                        {{ $hotelDetail->rating }} ⭐
                                    @else
                                        <span class="text-muted">Belum ada rating</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Harga</th>
                                <td>
                                    @if($hotelDetail->price)
                                        Rp {{ number_format($hotelDetail->price, 0, ',', '.') }}
                                    @else
                                        <span class="text-muted">Tidak ada info harga</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>URL Maps</th>
                                <td>
                                    @if($hotelDetail->map_url)
                                        <a href="{{ $hotelDetail->map_url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-map-marker-alt"></i> Lihat di Maps
                                        </a>
                                    @else
                                        <span class="text-muted">Tidak ada URL maps</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Dibuat</th>
                                <td>{{ $hotelDetail->created_at->format('d M Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Diperbarui</th>
                                <td>{{ $hotelDetail->updated_at->format('d M Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                    
                    <div class="col-md-4">
                        @if($hotelDetail->headerImage)
                            <div class="mb-3">
                                <h6>Gambar Header:</h6>
                                <img src="{{ asset('storage/' . $hotelDetail->headerImage) }}" 
                                     alt="Header Image" 
                                     class="img-fluid rounded" 
                                     style="max-height: 200px; width: 100%; object-fit: cover;">
                            </div>
                        @endif
                        
                        @if($hotelDetail->interiorImage)
                            <div class="mb-3">
                                <h6>Gambar Interior:</h6>
                                <img src="{{ asset('storage/' . $hotelDetail->interiorImage) }}" 
                                     alt="Interior Image" 
                                     class="img-fluid rounded" 
                                     style="max-height: 200px; width: 100%; object-fit: cover;">
                            </div>
                        @endif
                    </div>
                </div>
                
                @if($hotelDetail->description)
                <div class="row mt-3">
                    <div class="col-12">
                        <h5>Deskripsi</h5>
                        <div class="border p-3 rounded">
                            {!! nl2br(e($hotelDetail->description)) !!}
                        </div>
                    </div>
                </div>
                @endif

                @if($hotelDetail->facilities)
                <div class="row mt-3">
                    <div class="col-12">
                        <h5>Fasilitas</h5>
                        <div class="border p-3 rounded">
                            {!! nl2br(e($hotelDetail->facilities)) !!}
                        </div>
                    </div>
                </div>
                @endif

                @if($hotelDetail->syaratKetentuan)
                <div class="row mt-3">
                    <div class="col-12">
                        <h5>Syarat & Ketentuan</h5>
                        <div class="border p-3 rounded">
                            {!! nl2br(e($hotelDetail->syaratKetentuan)) !!}
                        </div>
                    </div>
                </div>
                @endif
            </div>
            
            <div class="card-footer">
                <a href="{{ route('admin.hotel-detail.edit', $hotelDetail->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit Detail Hotel
                </a>
                <a href="{{ route('admin.hotel-detail.index') }}" class="btn btn-secondary ml-2">
                    <i class="fas fa-list"></i> Daftar Detail Hotel
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
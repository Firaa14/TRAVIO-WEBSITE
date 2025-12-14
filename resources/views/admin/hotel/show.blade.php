@extends('admin.layouts.app')

@section('title', 'Detail Hotel')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Detail Hotel</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.hotel.index') }}">Data Hotel</a></li>
                    <li class="breadcrumb-item active">Detail Hotel</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Hotel: {{ $hotel->title }}</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.hotel.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <a href="{{ route('admin.hotel.edit', $hotel->id) }}" class="btn btn-warning btn-sm ml-2">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </div>
            </div>
            
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        @if($hotel->image)
                            <div class="text-center mb-3">
                                <img src="{{ asset('storage/' . $hotel->image) }}" 
                                     alt="{{ $hotel->title }}" 
                                     class="img-fluid rounded" 
                                     style="max-height: 400px;">
                            </div>
                        @endif
                    </div>
                    
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">Nama Hotel</th>
                                <td>{{ $hotel->title }}</td>
                            </tr>
                            <tr>
                                <th>Lokasi</th>
                                <td>{{ $hotel->location }}</td>
                            </tr>
                            <tr>
                                <th>Harga</th>
                                <td>{{ $hotel->price }}</td>
                            </tr>
                            <tr>
                                <th>Dibuat</th>
                                <td>{{ $hotel->created_at->format('d M Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Diperbarui</th>
                                <td>{{ $hotel->updated_at->format('d M Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-12">
                        <h5>Deskripsi</h5>
                        <div class="border p-3 rounded">
                            {!! nl2br(e($hotel->description)) !!}
                        </div>
                    </div>
                </div>

                @if($hotel->facilities)
                <div class="row mt-3">
                    <div class="col-12">
                        <h5>Fasilitas</h5>
                        <div class="border p-3 rounded">
                            {!! nl2br(e($hotel->facilities)) !!}
                        </div>
                    </div>
                </div>
                @endif
            </div>
            
            <div class="card-footer">
                <a href="{{ route('admin.hotel.edit', $hotel->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit Hotel
                </a>
                <a href="{{ route('admin.hotel.index') }}" class="btn btn-secondary ml-2">
                    <i class="fas fa-list"></i> Daftar Hotel
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
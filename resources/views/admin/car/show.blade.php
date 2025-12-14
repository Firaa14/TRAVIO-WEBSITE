@extends('admin.layouts.app')

@section('title', 'Detail Mobil')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Detail Mobil</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.car.index') }}">Data Mobil</a></li>
                    <li class="breadcrumb-item active">Detail Mobil</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Mobil: {{ $car->title }}</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.car.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <a href="{{ route('admin.car.edit', $car->id) }}" class="btn btn-warning btn-sm ml-2">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </div>
            </div>
            
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        @if($car->image)
                            <div class="text-center mb-3">
                                <img src="{{ asset('storage/' . $car->image) }}" 
                                     alt="{{ $car->title }}" 
                                     class="img-fluid rounded" 
                                     style="max-height: 300px;">
                            </div>
                        @endif
                        
                        @if($car->interior_image)
                            <div class="text-center">
                                <h6>Interior:</h6>
                                <img src="{{ asset('storage/' . $car->interior_image) }}" 
                                     alt="Interior {{ $car->title }}" 
                                     class="img-fluid rounded" 
                                     style="max-height: 300px;">
                            </div>
                        @endif
                    </div>
                    
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">Nama Mobil</th>
                                <td>{{ $car->title }}</td>
                            </tr>
                            <tr>
                                <th>Merek</th>
                                <td>{{ $car->brand ?? 'Tidak ada info' }}</td>
                            </tr>
                            <tr>
                                <th>Model</th>
                                <td>{{ $car->model ?? 'Tidak ada info' }}</td>
                            </tr>
                            <tr>
                                <th>Tahun</th>
                                <td>{{ $car->year ?? 'Tidak ada info' }}</td>
                            </tr>
                            <tr>
                                <th>Transmisi</th>
                                <td>{{ $car->transmission ?? 'Tidak ada info' }}</td>
                            </tr>
                            <tr>
                                <th>Bahan Bakar</th>
                                <td>{{ $car->fuel_type ?? 'Tidak ada info' }}</td>
                            </tr>
                            <tr>
                                <th>Kapasitas</th>
                                <td>{{ $car->capacity ? $car->capacity . ' orang' : 'Tidak ada info' }}</td>
                            </tr>
                            <tr>
                                <th>Warna</th>
                                <td>{{ $car->color ?? 'Tidak ada info' }}</td>
                            </tr>
                            <tr>
                                <th>Nomor Plat</th>
                                <td>{{ $car->license_plate ?? 'Tidak ada info' }}</td>
                            </tr>
                            <tr>
                                <th>Harga</th>
                                <td>Rp {{ number_format($car->price, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Lokasi</th>
                                <td>{{ $car->location ?? 'Tidak ada info' }}</td>
                            </tr>
                            <tr>
                                <th>Dibuat</th>
                                <td>{{ $car->created_at->format('d M Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Diperbarui</th>
                                <td>{{ $car->updated_at->format('d M Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-12">
                        <h5>Deskripsi</h5>
                        <div class="border p-3 rounded">
                            {!! nl2br(e($car->description)) !!}
                        </div>
                    </div>
                </div>

                @if($car->facilities)
                <div class="row mt-3">
                    <div class="col-12">
                        <h5>Fasilitas</h5>
                        <div class="border p-3 rounded">
                            @if(is_array($car->facilities))
                                <ul>
                                    @foreach($car->facilities as $facility)
                                        <li>{{ $facility }}</li>
                                    @endforeach
                                </ul>
                            @else
                                {!! nl2br(e($car->facilities)) !!}
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                @if($car->terms_conditions)
                <div class="row mt-3">
                    <div class="col-12">
                        <h5>Syarat & Ketentuan</h5>
                        <div class="border p-3 rounded">
                            {!! nl2br(e($car->terms_conditions)) !!}
                        </div>
                    </div>
                </div>
                @endif
            </div>
            
            <div class="card-footer">
                <a href="{{ route('admin.car.edit', $car->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit Mobil
                </a>
                <a href="{{ route('admin.car.index') }}" class="btn btn-secondary ml-2">
                    <i class="fas fa-list"></i> Daftar Mobil
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
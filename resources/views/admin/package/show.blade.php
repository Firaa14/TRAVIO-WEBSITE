@extends('admin.layouts.app')

@section('title', 'Detail Paket')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Detail Paket</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.package.index') }}">Data Paket</a></li>
                    <li class="breadcrumb-item active">Detail Paket</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Paket: {{ $package->title }}</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.package.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <a href="{{ route('admin.package.edit', $package->id) }}" class="btn btn-warning btn-sm ml-2">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </div>
            </div>
            
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        @if($package->image)
                            <div class="text-center mb-3">
                                <img src="{{ asset('storage/' . $package->image) }}" 
                                     alt="{{ $package->title }}" 
                                     class="img-fluid rounded" 
                                     style="max-height: 400px;">
                            </div>
                        @endif
                    </div>
                    
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">Nama Paket</th>
                                <td>{{ $package->title }}</td>
                            </tr>
                            <tr>
                                <th>Lokasi</th>
                                <td>{{ $package->location }}</td>
                            </tr>
                            <tr>
                                <th>Harga</th>
                                <td>{{ $package->price }}</td>
                            </tr>
                            <tr>
                                <th>Durasi</th>
                                <td>{{ $package->duration ?? 'Tidak ada info durasi' }}</td>
                            </tr>
                            <tr>
                                <th>Dibuat</th>
                                <td>{{ $package->created_at->format('d M Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Diperbarui</th>
                                <td>{{ $package->updated_at->format('d M Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-12">
                        <h5>Deskripsi</h5>
                        <div class="border p-3 rounded">
                            {!! nl2br(e($package->description)) !!}
                        </div>
                    </div>
                </div>

                @if($package->facilities)
                <div class="row mt-3">
                    <div class="col-12">
                        <h5>Fasilitas</h5>
                        <div class="border p-3 rounded">
                            {!! nl2br(e($package->facilities)) !!}
                        </div>
                    </div>
                </div>
                @endif

                @if($package->itinerary)
                <div class="row mt-3">
                    <div class="col-12">
                        <h5>Itinerary</h5>
                        <div class="border p-3 rounded">
                            @php
                                $itinerary = is_string($package->itinerary) ? json_decode($package->itinerary, true) : $package->itinerary;
                            @endphp
                            @if(is_array($itinerary))
                                <ul>
                                    @foreach($itinerary as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            @else
                                {!! nl2br(e($package->itinerary)) !!}
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                @if($package->price_details)
                <div class="row mt-3">
                    <div class="col-12">
                        <h5>Detail Harga</h5>
                        <div class="border p-3 rounded">
                            @php
                                $priceDetails = is_string($package->price_details) ? json_decode($package->price_details, true) : $package->price_details;
                            @endphp
                            @if(is_array($priceDetails))
                                <ul>
                                    @foreach($priceDetails as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            @else
                                {!! nl2br(e($package->price_details)) !!}
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                @if($package->include)
                <div class="row mt-3">
                    <div class="col-12">
                        <h5>Yang Termasuk</h5>
                        <div class="border p-3 rounded">
                            {!! nl2br(e($package->include)) !!}
                        </div>
                    </div>
                </div>
                @endif

                @if($package->exclude)
                <div class="row mt-3">
                    <div class="col-12">
                        <h5>Yang Tidak Termasuk</h5>
                        <div class="border p-3 rounded">
                            {!! nl2br(e($package->exclude)) !!}
                        </div>
                    </div>
                </div>
                @endif

                @if($package->terms_conditions)
                <div class="row mt-3">
                    <div class="col-12">
                        <h5>Syarat & Ketentuan</h5>
                        <div class="border p-3 rounded">
                            {!! nl2br(e($package->terms_conditions)) !!}
                        </div>
                    </div>
                </div>
                @endif
            </div>
            
            <div class="card-footer">
                <a href="{{ route('admin.package.edit', $package->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit Paket
                </a>
                <a href="{{ route('admin.package.index') }}" class="btn btn-secondary ml-2">
                    <i class="fas fa-list"></i> Daftar Paket
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
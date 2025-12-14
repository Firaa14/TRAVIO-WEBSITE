@extends('admin.layouts.app')

@section('title', 'Edit Paket')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Paket</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.package.index') }}">Data Paket</a></li>
                    <li class="breadcrumb-item active">Edit Paket</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Edit Paket</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.package.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            
            <form action="{{ route('admin.package.update', $package->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Nama Paket <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('title') is-invalid @enderror" 
                                       id="title" 
                                       name="title" 
                                       value="{{ old('title', $package->title) }}" 
                                       required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="location">Lokasi <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('location') is-invalid @enderror" 
                                       id="location" 
                                       name="location" 
                                       value="{{ old('location', $package->location) }}" 
                                       required>
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price">Harga <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('price') is-invalid @enderror" 
                                       id="price" 
                                       name="price" 
                                       value="{{ old('price', $package->price) }}" 
                                       placeholder="Contoh: Rp 1.500.000/orang"
                                       required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="duration">Durasi</label>
                                <input type="text" 
                                       class="form-control @error('duration') is-invalid @enderror" 
                                       id="duration" 
                                       name="duration" 
                                       value="{{ old('duration', $package->duration) }}"
                                       placeholder="Contoh: 3 Hari 2 Malam">
                                @error('duration')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Deskripsi <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="5" 
                                  required>{{ old('description', $package->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Gambar Paket</label>
                        <input type="file" 
                               class="form-control-file @error('image') is-invalid @enderror" 
                               id="image" 
                               name="image" 
                               accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Format: JPEG, PNG, JPG, GIF. Max: 2MB</small>
                        
                        @if($package->image)
                            <div class="mt-2">
                                <p class="mb-1">Gambar saat ini:</p>
                                <img src="{{ asset('storage/' . $package->image) }}" 
                                     alt="{{ $package->title }}" 
                                     class="img-thumbnail" 
                                     style="max-width: 200px;">
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="facilities">Fasilitas</label>
                        <textarea class="form-control @error('facilities') is-invalid @enderror" 
                                  id="facilities" 
                                  name="facilities" 
                                  rows="3"
                                  placeholder="Fasilitas yang tersedia dalam paket">{{ old('facilities', $package->facilities) }}</textarea>
                        @error('facilities')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="itinerary">Itinerary (Satu item per baris)</label>
                        @php
                            $itineraryText = old('itinerary');
                            if (!$itineraryText && $package->itinerary) {
                                $itineraryArray = is_string($package->itinerary) ? json_decode($package->itinerary, true) : $package->itinerary;
                                $itineraryText = is_array($itineraryArray) ? implode("\n", $itineraryArray) : $package->itinerary;
                            }
                        @endphp
                        <textarea class="form-control @error('itinerary') is-invalid @enderror" 
                                  id="itinerary" 
                                  name="itinerary" 
                                  rows="5"
                                  placeholder="Hari 1: Kedatangan dan check-in hotel&#10;Hari 2: Tour wisata&#10;Hari 3: Free time dan departure">{{ $itineraryText }}</textarea>
                        @error('itinerary')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Masukkan setiap kegiatan dalam baris baru</small>
                    </div>

                    <div class="form-group">
                        <label for="price_details">Detail Harga (Satu item per baris)</label>
                        @php
                            $priceDetailsText = old('price_details');
                            if (!$priceDetailsText && $package->price_details) {
                                $priceDetailsArray = is_string($package->price_details) ? json_decode($package->price_details, true) : $package->price_details;
                                $priceDetailsText = is_array($priceDetailsArray) ? implode("\n", $priceDetailsArray) : $package->price_details;
                            }
                        @endphp
                        <textarea class="form-control @error('price_details') is-invalid @enderror" 
                                  id="price_details" 
                                  name="price_details" 
                                  rows="4"
                                  placeholder="Hotel 2 malam: Rp 600.000&#10;Transportasi: Rp 300.000&#10;Makan 3x sehari: Rp 450.000&#10;Guide: Rp 150.000">{{ $priceDetailsText }}</textarea>
                        @error('price_details')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Masukkan setiap detail dalam baris baru</small>
                    </div>

                    <div class="form-group">
                        <label for="include">Yang Termasuk</label>
                        <textarea class="form-control @error('include') is-invalid @enderror" 
                                  id="include" 
                                  name="include" 
                                  rows="3"
                                  placeholder="Apa saja yang termasuk dalam paket ini">{{ old('include', $package->include) }}</textarea>
                        @error('include')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exclude">Yang Tidak Termasuk</label>
                        <textarea class="form-control @error('exclude') is-invalid @enderror" 
                                  id="exclude" 
                                  name="exclude" 
                                  rows="3"
                                  placeholder="Apa saja yang tidak termasuk dalam paket ini">{{ old('exclude', $package->exclude) }}</textarea>
                        @error('exclude')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="terms_conditions">Syarat & Ketentuan</label>
                        <textarea class="form-control @error('terms_conditions') is-invalid @enderror" 
                                  id="terms_conditions" 
                                  name="terms_conditions" 
                                  rows="4"
                                  placeholder="Syarat dan ketentuan untuk paket ini">{{ old('terms_conditions', $package->terms_conditions) }}</textarea>
                        @error('terms_conditions')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('admin.package.index') }}" class="btn btn-secondary ml-2">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
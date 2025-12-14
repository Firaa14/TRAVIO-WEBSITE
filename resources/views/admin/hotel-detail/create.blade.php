@extends('admin.layouts.app')

@section('title', 'Tambah Detail Hotel')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tambah Detail Hotel</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.hotel-detail.index') }}">Data Detail Hotel</a></li>
                    <li class="breadcrumb-item active">Tambah Detail Hotel</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Detail Hotel</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.hotel-detail.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            
            <form action="{{ route('admin.hotel-detail.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="hotel_id">Hotel <span class="text-danger">*</span></label>
                                <select class="form-control @error('hotel_id') is-invalid @enderror" 
                                        id="hotel_id" 
                                        name="hotel_id" 
                                        required>
                                    <option value="">Pilih Hotel</option>
                                    @foreach($hotels as $hotel)
                                        <option value="{{ $hotel->id }}" {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>
                                            {{ $hotel->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('hotel_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama Detail Hotel <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('nama') is-invalid @enderror" 
                                       id="nama" 
                                       name="nama" 
                                       value="{{ old('nama') }}" 
                                       required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="location">Lokasi <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('location') is-invalid @enderror" 
                                       id="location" 
                                       name="location" 
                                       value="{{ old('location') }}" 
                                       required>
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Telepon</label>
                                <input type="text" 
                                       class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" 
                                       name="phone" 
                                       value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="rating">Rating</label>
                                <input type="number" 
                                       class="form-control @error('rating') is-invalid @enderror" 
                                       id="rating" 
                                       name="rating" 
                                       value="{{ old('rating') }}" 
                                       min="0" 
                                       max="5" 
                                       step="0.1">
                                @error('rating')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price">Harga</label>
                                <input type="number" 
                                       class="form-control @error('price') is-invalid @enderror" 
                                       id="price" 
                                       name="price" 
                                       value="{{ old('price') }}" 
                                       min="0">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address">Alamat Lengkap</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" 
                                  id="address" 
                                  name="address" 
                                  rows="2">{{ old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="4">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="facilities">Fasilitas</label>
                        <textarea class="form-control @error('facilities') is-invalid @enderror" 
                                  id="facilities" 
                                  name="facilities" 
                                  rows="3">{{ old('facilities') }}</textarea>
                        @error('facilities')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="syaratKetentuan">Syarat & Ketentuan</label>
                        <textarea class="form-control @error('syaratKetentuan') is-invalid @enderror" 
                                  id="syaratKetentuan" 
                                  name="syaratKetentuan" 
                                  rows="3">{{ old('syaratKetentuan') }}</textarea>
                        @error('syaratKetentuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="map_url">URL Google Maps</label>
                        <input type="url" 
                               class="form-control @error('map_url') is-invalid @enderror" 
                               id="map_url" 
                               name="map_url" 
                               value="{{ old('map_url') }}">
                        @error('map_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="headerImage">Gambar Header</label>
                                <input type="file" 
                                       class="form-control-file @error('headerImage') is-invalid @enderror" 
                                       id="headerImage" 
                                       name="headerImage" 
                                       accept="image/*">
                                @error('headerImage')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Format: JPEG, PNG, JPG, GIF. Max: 2MB</small>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="interiorImage">Gambar Interior</label>
                                <input type="file" 
                                       class="form-control-file @error('interiorImage') is-invalid @enderror" 
                                       id="interiorImage" 
                                       name="interiorImage" 
                                       accept="image/*">
                                @error('interiorImage')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Format: JPEG, PNG, JPG, GIF. Max: 2MB</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('admin.hotel-detail.index') }}" class="btn btn-secondary ml-2">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
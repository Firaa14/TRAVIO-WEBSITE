@extends('admin.layouts.app')

@section('title', 'Edit Mobil')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Mobil</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.car.index') }}">Data Mobil</a></li>
                    <li class="breadcrumb-item active">Edit Mobil</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Edit Mobil</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.car.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            
            <form action="{{ route('admin.car.update', $car->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Nama Mobil <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('title') is-invalid @enderror" 
                                       id="title" 
                                       name="title" 
                                       value="{{ old('title', $car->title) }}" 
                                       required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="brand">Merek</label>
                                <input type="text" 
                                       class="form-control @error('brand') is-invalid @enderror" 
                                       id="brand" 
                                       name="brand" 
                                       value="{{ old('brand', $car->brand) }}">
                                @error('brand')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="model">Model</label>
                                <input type="text" 
                                       class="form-control @error('model') is-invalid @enderror" 
                                       id="model" 
                                       name="model" 
                                       value="{{ old('model', $car->model) }}">
                                @error('model')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="year">Tahun</label>
                                <input type="number" 
                                       class="form-control @error('year') is-invalid @enderror" 
                                       id="year" 
                                       name="year" 
                                       value="{{ old('year', $car->year) }}" 
                                       min="1990" 
                                       max="{{ date('Y') + 1 }}">
                                @error('year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="capacity">Kapasitas</label>
                                <input type="number" 
                                       class="form-control @error('capacity') is-invalid @enderror" 
                                       id="capacity" 
                                       name="capacity" 
                                       value="{{ old('capacity', $car->capacity) }}" 
                                       min="1" 
                                       max="50">
                                @error('capacity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price">Harga <span class="text-danger">*</span></label>
                                <input type="number" 
                                       class="form-control @error('price') is-invalid @enderror" 
                                       id="price" 
                                       name="price" 
                                       value="{{ old('price', $car->price) }}" 
                                       min="0" 
                                       required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="transmission">Transmisi</label>
                                <input type="text" 
                                       class="form-control @error('transmission') is-invalid @enderror" 
                                       id="transmission" 
                                       name="transmission" 
                                       value="{{ old('transmission', $car->transmission) }}"
                                       placeholder="Manual/Automatic">
                                @error('transmission')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="fuel_type">Jenis Bahan Bakar</label>
                                <input type="text" 
                                       class="form-control @error('fuel_type') is-invalid @enderror" 
                                       id="fuel_type" 
                                       name="fuel_type" 
                                       value="{{ old('fuel_type', $car->fuel_type) }}"
                                       placeholder="Bensin/Solar">
                                @error('fuel_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="color">Warna</label>
                                <input type="text" 
                                       class="form-control @error('color') is-invalid @enderror" 
                                       id="color" 
                                       name="color" 
                                       value="{{ old('color', $car->color) }}">
                                @error('color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="license_plate">Nomor Plat</label>
                                <input type="text" 
                                       class="form-control @error('license_plate') is-invalid @enderror" 
                                       id="license_plate" 
                                       name="license_plate" 
                                       value="{{ old('license_plate', $car->license_plate) }}">
                                @error('license_plate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="location">Lokasi</label>
                                <input type="text" 
                                       class="form-control @error('location') is-invalid @enderror" 
                                       id="location" 
                                       name="location" 
                                       value="{{ old('location', $car->location) }}">
                                @error('location')
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
                                  rows="4" 
                                  required>{{ old('description', $car->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="facilities">Fasilitas</label>
                        <textarea class="form-control @error('facilities') is-invalid @enderror" 
                                  id="facilities" 
                                  name="facilities" 
                                  rows="3"
                                  placeholder="AC, Audio System, GPS, dll">{{ old('facilities', is_array($car->facilities) ? implode(', ', $car->facilities) : $car->facilities) }}</textarea>
                        @error('facilities')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="terms_conditions">Syarat & Ketentuan</label>
                        <textarea class="form-control @error('terms_conditions') is-invalid @enderror" 
                                  id="terms_conditions" 
                                  name="terms_conditions" 
                                  rows="3">{{ old('terms_conditions', $car->terms_conditions) }}</textarea>
                        @error('terms_conditions')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="image">Gambar Utama</label>
                                <input type="file" 
                                       class="form-control-file @error('image') is-invalid @enderror" 
                                       id="image" 
                                       name="image" 
                                       accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Format: JPEG, PNG, JPG, GIF. Max: 2MB</small>
                                
                                @if($car->image)
                                    <div class="mt-2">
                                        <p class="mb-1">Gambar saat ini:</p>
                                        <img src="{{ asset('storage/' . $car->image) }}" 
                                             alt="{{ $car->title }}" 
                                             class="img-thumbnail" 
                                             style="max-width: 200px;">
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="interior_image">Gambar Interior</label>
                                <input type="file" 
                                       class="form-control-file @error('interior_image') is-invalid @enderror" 
                                       id="interior_image" 
                                       name="interior_image" 
                                       accept="image/*">
                                @error('interior_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Format: JPEG, PNG, JPG, GIF. Max: 2MB</small>
                                
                                @if($car->interior_image)
                                    <div class="mt-2">
                                        <p class="mb-1">Gambar interior saat ini:</p>
                                        <img src="{{ asset('storage/' . $car->interior_image) }}" 
                                             alt="Interior {{ $car->title }}" 
                                             class="img-thumbnail" 
                                             style="max-width: 200px;">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('admin.car.index') }}" class="btn btn-secondary ml-2">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
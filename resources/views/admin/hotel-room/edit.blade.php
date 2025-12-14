@extends('admin.layouts.app')

@section('title', 'Edit Kamar Hotel')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Kamar Hotel</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.hotel-room.index') }}">Data Kamar Hotel</a></li>
                    <li class="breadcrumb-item active">Edit Kamar</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Edit Kamar Hotel</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.hotel-room.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            
            <form action="{{ route('admin.hotel-room.update', $hotelRoom->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
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
                                        <option value="{{ $hotel->id }}" {{ old('hotel_id', $hotelRoom->hotel_id) == $hotel->id ? 'selected' : '' }}>
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
                                <label for="name">Nama Kamar <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $hotelRoom->name) }}" 
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="price">Harga <span class="text-danger">*</span></label>
                                <input type="number" 
                                       class="form-control @error('price') is-invalid @enderror" 
                                       id="price" 
                                       name="price" 
                                       value="{{ old('price', $hotelRoom->price) }}" 
                                       min="0"
                                       required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="max_guest">Kapasitas Tamu <span class="text-danger">*</span></label>
                                <input type="number" 
                                       class="form-control @error('max_guest') is-invalid @enderror" 
                                       id="max_guest" 
                                       name="max_guest" 
                                       value="{{ old('max_guest', $hotelRoom->max_guest) }}" 
                                       min="1"
                                       required>
                                @error('max_guest')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="availability">Status <span class="text-danger">*</span></label>
                                <select class="form-control @error('availability') is-invalid @enderror" 
                                        id="availability" 
                                        name="availability" 
                                        required>
                                    <option value="available" {{ old('availability', $hotelRoom->availability) == 'available' ? 'selected' : '' }}>
                                        Tersedia
                                    </option>
                                    <option value="unavailable" {{ old('availability', $hotelRoom->availability) == 'unavailable' ? 'selected' : '' }}>
                                        Tidak Tersedia
                                    </option>
                                </select>
                                @error('availability')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="size">Ukuran Kamar</label>
                                <input type="text" 
                                       class="form-control @error('size') is-invalid @enderror" 
                                       id="size" 
                                       name="size" 
                                       value="{{ old('size', $hotelRoom->size) }}"
                                       placeholder="Contoh: 25 m²">
                                @error('size')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="bed_type">Jenis Tempat Tidur</label>
                                <input type="text" 
                                       class="form-control @error('bed_type') is-invalid @enderror" 
                                       id="bed_type" 
                                       name="bed_type" 
                                       value="{{ old('bed_type', $hotelRoom->bed_type) }}"
                                       placeholder="Contoh: King Bed, Twin Bed">
                                @error('bed_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="4">{{ old('description', $hotelRoom->description) }}</textarea>
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
                                  placeholder="Contoh: AC, TV, Kulkas, Kamar Mandi">{{ old('facilities', $hotelRoom->facilities) }}</textarea>
                        @error('facilities')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="room_image">Gambar Kamar</label>
                        <input type="file" 
                               class="form-control-file @error('room_image') is-invalid @enderror" 
                               id="room_image" 
                               name="room_image" 
                               accept="image/*">
                        @error('room_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Format: JPEG, PNG, JPG, GIF. Max: 2MB</small>
                        
                        @if($hotelRoom->room_image)
                            <div class="mt-2">
                                <p class="mb-1">Gambar saat ini:</p>
                                <img src="{{ asset('storage/' . $hotelRoom->room_image) }}" 
                                     alt="{{ $hotelRoom->name }}" 
                                     class="img-thumbnail" 
                                     style="max-width: 200px;">
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('admin.hotel-room.index') }}" class="btn btn-secondary ml-2">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
@extends('admin.layouts.app')
@section('content')
    <div class="container mt-4">
        <h2>Edit Mobil</h2>
        <form action="{{ route('admin.car.update', $car) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Nama Mobil</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $car->title }}" required>
            </div>
            <div class="mb-3">
                <label for="brand" class="form-label">Brand</label>
                <input type="text" class="form-control" id="brand" name="brand" value="{{ $car->brand }}">
            </div>
            <div class="mb-3">
                <label for="model" class="form-label">Model</label>
                <input type="text" class="form-control" id="model" name="model" value="{{ $car->model }}">
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">Tahun</label>
                <input type="number" class="form-control" id="year" name="year" value="{{ $car->year }}">
            </div>
            <div class="mb-3">
                <label for="transmission" class="form-label">Transmisi</label>
                <select class="form-control" id="transmission" name="transmission">
                    <option value="Manual" {{ $car->transmission == 'Manual' ? 'selected' : '' }}>Manual</option>
                    <option value="Automatic" {{ $car->transmission == 'Automatic' ? 'selected' : '' }}>Automatic</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="fuel_type" class="form-label">Tipe Bahan Bakar</label>
                <select class="form-control" id="fuel_type" name="fuel_type">
                    <option value="Petrol" {{ $car->fuel_type == 'Petrol' ? 'selected' : '' }}>Petrol</option>
                    <option value="Diesel" {{ $car->fuel_type == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                    <option value="Electric" {{ $car->fuel_type == 'Electric' ? 'selected' : '' }}>Electric</option>
                    <option value="Hybrid" {{ $car->fuel_type == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="capacity" class="form-label">Kapasitas Penumpang</label>
                <input type="number" class="form-control" id="capacity" name="capacity" value="{{ $car->capacity }}">
            </div>
            <div class="mb-3">
                <label for="color" class="form-label">Warna</label>
                <input type="text" class="form-control" id="color" name="color" value="{{ $car->color }}">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="text" class="form-control" id="price" name="price" value="{{ $car->price }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description"
                    required>{{ $car->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Lokasi</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ $car->location }}">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Gambar</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                @if($car->image)
                    <img src="{{ asset('storage/' . $car->image) }}" alt="Gambar Mobil" width="120" class="mt-2">
                @endif
            </div>
            <div class="mb-3">
                <label for="interior_image" class="form-label">Gambar Interior</label>
                <input type="file" class="form-control" id="interior_image" name="interior_image" accept="image/*">
                @if($car->interior_image)
                    <img src="{{ asset('storage/' . $car->interior_image) }}" alt="Gambar Interior" width="120" class="mt-2">
                @endif
            </div>
            <div class="mb-3">
                <label for="gallery_images" class="form-label">Gallery Images (bisa lebih dari satu, pisahkan dengan koma
                    atau upload multi)</label>
                <input type="file" class="form-control" id="gallery_images" name="gallery_images[]" accept="image/*"
                    multiple>
                @if(is_array($car->gallery_images))
                    @foreach($car->gallery_images as $img)
                        <img src="{{ asset('storage/' . $img) }}" alt="Gallery" width="80" class="me-2 mb-2">
                    @endforeach
                @endif
            </div>
            <div class="mb-3">
                <label for="license_plate" class="form-label">Plat Nomor</label>
                <input type="text" class="form-control" id="license_plate" name="license_plate"
                    value="{{ $car->license_plate }}">
            </div>
            <div class="mb-3">
                <label for="facilities" class="form-label">Fasilitas (pisahkan dengan koma)</label>
                <input type="text" class="form-control" id="facilities" name="facilities"
                    value="{{ is_array($car->facilities) ? implode(', ', $car->facilities) : $car->facilities }}">
            </div>
            <div class="mb-3">
                <label for="terms_conditions" class="form-label">Syarat & Ketentuan (pisahkan dengan koma)</label>
                <input type="text" class="form-control" id="terms_conditions" name="terms_conditions"
                    value="{{ is_array($car->terms_conditions) ? implode(', ', $car->terms_conditions) : $car->terms_conditions }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.car.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
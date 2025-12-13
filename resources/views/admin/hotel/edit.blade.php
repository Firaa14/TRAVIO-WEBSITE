@extends('admin.layouts.app')
@section('content')
    <div class="container mt-4">
        <h2>Edit Hotel</h2>
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nama Hotel</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $hotel->name }}" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ $hotel->address }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.hotel.index') }}" class="btn btn-secondary">Batal</a>
        </form>
        <form action="{{ route('admin.hotel.update', $hotel) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Judul Hotel</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $hotel->title }}" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="text" class="form-control" id="price" name="price" value="{{ $hotel->price }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description"
                    required>{{ $hotel->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Gambar</label>
                @if($hotel->image)
                    <img src="{{ asset('storage/' . $hotel->image) }}" alt="Gambar Hotel" width="80">
                @endif
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Lokasi</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ $hotel->location }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="facilities" class="form-label">Fasilitas (pisahkan dengan koma)</label>
                <input type="text" class="form-control" id="facilities" name="facilities[]"
                    value="{{ is_array($hotel->facilities) ? implode(', ', $hotel->facilities) : $hotel->facilities }}">
                <small class="form-text text-muted">Contoh: Kolam Renang, WiFi, Parkir</small>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.hotel.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
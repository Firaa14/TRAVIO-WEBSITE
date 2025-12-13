@extends('admin.layouts.app')
@section('content')
    <div class="container mt-4">
        <h2>Tambah Hotel</h2>
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Hotel</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.hotel.index') }}" class="btn btn-secondary">Batal</a>
        </form>
        <form action="{{ route('admin.hotel.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Judul Hotel</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="text" class="form-control" id="price" name="price" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Gambar</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Lokasi</label>
                <input type="text" class="form-control" id="location" name="location" required>
            </div>
            <div class="mb-3">
                <label for="facilities" class="form-label">Fasilitas (pisahkan dengan koma)</label>
                <input type="text" class="form-control" id="facilities" name="facilities[]">
                <small class="form-text text-muted">Contoh: Kolam Renang, WiFi, Parkir</small>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.hotel.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
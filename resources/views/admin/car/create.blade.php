@extends('admin.layouts.app')
@section('content')
    <div class="container mt-4">
        <h2>Tambah Mobil</h2>
        <form action="{{ route('admin.car.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Nama Mobil</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="brand" class="form-label">Brand</label>
                <input type="text" class="form-control" id="brand" name="brand">
            </div>
            <div class="mb-3">
                <label for="model" class="form-label">Model</label>
                <input type="text" class="form-control" id="model" name="model">
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">Tahun</label>
                <input type="number" class="form-control" id="year" name="year">
            </div>
            <div class="mb-3">
                <label for="transmission" class="form-label">Transmisi</label>
                <select class="form-control" id="transmission" name="transmission">
                    <option value="Manual">Manual</option>
                    <option value="Automatic">Automatic</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="fuel_type" class="form-label">Tipe Bahan Bakar</label>
                <select class="form-control" id="fuel_type" name="fuel_type">
                    <option value="Petrol">Petrol</option>
                    <option value="Diesel">Diesel</option>
                    <option value="Electric">Electric</option>
                    <option value="Hybrid">Hybrid</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="capacity" class="form-label">Kapasitas Penumpang</label>
                <input type="number" class="form-control" id="capacity" name="capacity">
            </div>
            <div class="mb-3">
                <label for="color" class="form-label">Warna</label>
                <input type="text" class="form-control" id="color" name="color">
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
                <label for="location" class="form-label">Lokasi</label>
                <input type="text" class="form-control" id="location" name="location">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Gambar</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            </div>
            <div class="mb-3">
                <label for="interior_image" class="form-label">Gambar Interior</label>
                <input type="file" class="form-control" id="interior_image" name="interior_image" accept="image/*">
            </div>
            <div class="mb-3">
                <label for="gallery_images" class="form-label">Gallery Images (bisa lebih dari satu, pisahkan dengan koma
                    atau upload multi)</label>
                <input type="file" class="form-control" id="gallery_images" name="gallery_images[]" accept="image/*"
                    multiple>
            </div>
            <div class="mb-3">
                <label for="license_plate" class="form-label">Plat Nomor</label>
                <input type="text" class="form-control" id="license_plate" name="license_plate">
            </div>
            <div class="mb-3">
                <label for="facilities" class="form-label">Fasilitas (pisahkan dengan koma)</label>
                <input type="text" class="form-control" id="facilities" name="facilities"
                    placeholder="AC, WiFi, Musik, dll">
            </div>
            <div class="mb-3">
                <label for="terms_conditions" class="form-label">Syarat & Ketentuan (pisahkan dengan koma)</label>
                <input type="text" class="form-control" id="terms_conditions" name="terms_conditions"
                    placeholder="Tidak boleh merokok, dll">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.car.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
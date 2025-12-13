@extends('admin.layouts.app')
@section('content')
    <div class="container mt-4">
        <h2>Tambah Hotel</h2>
        <form action="{{ route('admin.hotel.store') }}" method="POST">
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
    </div>
@endsection
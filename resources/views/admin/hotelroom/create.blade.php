@extends('admin.layouts.app')
@section('content')
    <div class="container mt-4">
        <h2>Tambah Kamar Hotel</h2>
        <form action="{{ route('admin.hotelroom.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="hotel_id" class="form-label">ID Hotel</label>
                <input type="number" class="form-control" id="hotel_id" name="hotel_id" required>
            </div>
            <div class="mb-3">
                <label for="room_type" class="form-label">Tipe Kamar</label>
                <input type="text" class="form-control" id="room_type" name="room_type" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.hotelroom.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
@extends('admin.layouts.app')
@section('content')
    <div class="container mt-4">
        <h2>Tambah Detail Hotel</h2>
        <form action="{{ route('admin.hoteldetail.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="hotel_id" class="form-label">ID Hotel</label>
                <input type="number" class="form-control" id="hotel_id" name="hotel_id" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.hoteldetail.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
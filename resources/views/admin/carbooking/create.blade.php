@extends('admin.layouts.app')
@section('content')
    <div class="container mt-4">
        <h2>Tambah Booking Mobil</h2>
        <form action="{{ route('admin.carbooking.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="user_id" class="form-label">User ID</label>
                <input type="number" class="form-control" id="user_id" name="user_id" required>
            </div>
            <div class="mb-3">
                <label for="car_id" class="form-label">Car ID</label>
                <input type="number" class="form-control" id="car_id" name="car_id" required>
            </div>
            <div class="mb-3">
                <label for="start_date" class="form-label">Tanggal Mulai</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>
            <div class="mb-3">
                <label for="end_date" class="form-label">Tanggal Selesai</label>
                <input type="date" class="form-control" id="end_date" name="end_date" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.carbooking.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
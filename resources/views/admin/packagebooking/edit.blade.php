@extends('admin.layouts.app')
@section('content')
    <div class="container mt-4">
        <h2>Edit Booking Paket</h2>
        <form action="{{ route('admin.packagebooking.update', $packageBooking) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="user_id" class="form-label">User ID</label>
                <input type="number" class="form-control" id="user_id" name="user_id" value="{{ $packageBooking->user_id }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="package_id" class="form-label">Package ID</label>
                <input type="number" class="form-control" id="package_id" name="package_id"
                    value="{{ $packageBooking->package_id }}" required>
            </div>
            <div class="mb-3">
                <label for="booking_date" class="form-label">Tanggal Booking</label>
                <input type="date" class="form-control" id="booking_date" name="booking_date"
                    value="{{ $packageBooking->booking_date }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.packagebooking.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
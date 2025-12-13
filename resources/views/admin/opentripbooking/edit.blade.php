@extends('admin.layouts.app')
@section('content')
    <div class="container mt-4">
        <h2>Edit Booking Open Trip</h2>
        <form action="{{ route('admin.opentripbooking.update', $openTripBooking) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="user_id" class="form-label">User ID</label>
                <input type="number" class="form-control" id="user_id" name="user_id"
                    value="{{ $openTripBooking->user_id }}" required>
            </div>
            <div class="mb-3">
                <label for="open_trip_id" class="form-label">Open Trip ID</label>
                <input type="number" class="form-control" id="open_trip_id" name="open_trip_id"
                    value="{{ $openTripBooking->open_trip_id }}" required>
            </div>
            <div class="mb-3">
                <label for="booking_date" class="form-label">Tanggal Booking</label>
                <input type="date" class="form-control" id="booking_date" name="booking_date"
                    value="{{ $openTripBooking->booking_date }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.opentripbooking.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
@extends('admin.layouts.app')
@section('content')
    <div class="container mt-4">
        <h2>Edit Booking Hotel</h2>
        <form action="{{ route('admin.hotelbooking.update', $hotelBooking) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="user_id" class="form-label">User ID</label>
                <input type="number" class="form-control" id="user_id" name="user_id" value="{{ $hotelBooking->user_id }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="hotel_id" class="form-label">Hotel ID</label>
                <input type="number" class="form-control" id="hotel_id" name="hotel_id"
                    value="{{ $hotelBooking->hotel_id }}" required>
            </div>
            <div class="mb-3">
                <label for="check_in" class="form-label">Check In</label>
                <input type="date" class="form-control" id="check_in" name="check_in" value="{{ $hotelBooking->check_in }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="check_out" class="form-label">Check Out</label>
                <input type="date" class="form-control" id="check_out" name="check_out"
                    value="{{ $hotelBooking->check_out }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.hotelbooking.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
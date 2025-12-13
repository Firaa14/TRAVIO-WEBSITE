@extends('admin.layouts.app')
@section('content')
    <div class="container mt-4">
        <h2>Data Booking Hotel</h2>
        <a href="{{ route('admin.hotelbooking.create') }}" class="btn btn-success mb-2">Tambah Booking</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Hotel ID</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($hotelBookings as $hotelBooking)
                    <tr>
                        <td>{{ $hotelBooking->id }}</td>
                        <td>{{ $hotelBooking->user_id }}</td>
                        <td>{{ $hotelBooking->hotel_id }}</td>
                        <td>{{ $hotelBooking->check_in }}</td>
                        <td>{{ $hotelBooking->check_out }}</td>
                        <td>
                            <a href="{{ route('admin.hotelbooking.edit', $hotelBooking) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.hotelbooking.destroy', $hotelBooking) }}" method="POST"
                                style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
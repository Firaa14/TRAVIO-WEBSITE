@extends('admin.layouts.app')
@section('content')
    <div class="container mt-4">
        <h2>Data Booking Open Trip</h2>
        <a href="{{ route('admin.opentripbooking.create') }}" class="btn btn-success mb-2">Tambah Booking</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Open Trip ID</th>
                    <th>Tanggal Booking</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($openTripBookings as $openTripBooking)
                    <tr>
                        <td>{{ $openTripBooking->id }}</td>
                        <td>{{ $openTripBooking->user_id }}</td>
                        <td>{{ $openTripBooking->open_trip_id }}</td>
                        <td>{{ $openTripBooking->booking_date }}</td>
                        <td>
                            <a href="{{ route('admin.opentripbooking.edit', $openTripBooking) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.opentripbooking.destroy', $openTripBooking) }}" method="POST"
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
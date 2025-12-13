@extends('admin.layouts.app')
@section('content')
    <div class="container mt-4">
        <h2>Data Booking Mobil</h2>
        <a href="{{ route('admin.carbooking.create') }}" class="btn btn-success mb-2">Tambah Booking</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Car ID</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($carBookings as $carBooking)
                    <tr>
                        <td>{{ $carBooking->id }}</td>
                        <td>{{ $carBooking->user_id }}</td>
                        <td>{{ $carBooking->car_id }}</td>
                        <td>{{ $carBooking->start_date }}</td>
                        <td>{{ $carBooking->end_date }}</td>
                        <td>
                            <a href="{{ route('admin.carbooking.edit', $carBooking) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.carbooking.destroy', $carBooking) }}" method="POST"
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
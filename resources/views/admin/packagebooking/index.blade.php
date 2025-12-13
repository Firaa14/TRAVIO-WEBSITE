@extends('admin.layouts.app')
@section('content')
    <div class="container mt-4">
        <h2>Data Booking Paket</h2>
        <a href="{{ route('admin.packagebooking.create') }}" class="btn btn-success mb-2">Tambah Booking</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Package ID</th>
                    <th>Tanggal Booking</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($packageBookings as $packageBooking)
                    <tr>
                        <td>{{ $packageBooking->id }}</td>
                        <td>{{ $packageBooking->user_id }}</td>
                        <td>{{ $packageBooking->package_id }}</td>
                        <td>{{ $packageBooking->booking_date }}</td>
                        <td>
                            <a href="{{ route('admin.packagebooking.edit', $packageBooking) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.packagebooking.destroy', $packageBooking) }}" method="POST"
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
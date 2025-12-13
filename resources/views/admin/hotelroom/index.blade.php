@extends('admin.layouts.app')
@section('content')
    <div class="container mt-4">
        <h2>Data Kamar Hotel</h2>
        <a href="{{ route('admin.hotelroom.create') }}" class="btn btn-success mb-2">Tambah Kamar</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID Hotel</th>
                    <th>Tipe Kamar</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($hotelRooms as $hotelRoom)
                    <tr>
                        <td>{{ $hotelRoom->id }}</td>
                        <td>{{ $hotelRoom->hotel_id }}</td>
                        <td>{{ $hotelRoom->room_type }}</td>
                        <td>{{ $hotelRoom->price }}</td>
                        <td>
                            <a href="{{ route('admin.hotelroom.edit', $hotelRoom) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.hotelroom.destroy', $hotelRoom) }}" method="POST"
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
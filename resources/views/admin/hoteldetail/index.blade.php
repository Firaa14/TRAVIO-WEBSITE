@extends('admin.layouts.app')
@section('content')
    <div class="container mt-4">
        <h2>Data Detail Hotel</h2>
        <a href="{{ route('admin.hoteldetail.create') }}" class="btn btn-success mb-2">Tambah Detail</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID Hotel</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($hotelDetails as $hotelDetail)
                    <tr>
                        <td>{{ $hotelDetail->id }}</td>
                        <td>{{ $hotelDetail->hotel_id }}</td>
                        <td>{{ $hotelDetail->description }}</td>
                        <td>
                            <a href="{{ route('admin.hoteldetail.edit', $hotelDetail) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.hoteldetail.destroy', $hotelDetail) }}" method="POST"
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
@extends('admin.layouts.app')
@section('content')
    <div class="container mt-4">
        <h2>Data Hotel</h2>
        <a href="{{ route('admin.hotel.create') }}" class="btn btn-success mb-2">Tambah Hotel</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($hotels as $hotel)
                    <tr>
                        <td>{{ $hotel->id }}</td>
                        <td>{{ $hotel->name }}</td>
                        <td>{{ $hotel->address }}</td>
                        <td>
                            <a href="{{ route('admin.hotel.edit', $hotel) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.hotel.destroy', $hotel) }}" method="POST"
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
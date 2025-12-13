@extends('admin.layouts.app')
@section('content')
    <div class="container mt-4">
        <h2>Data Open Trip</h2>
        <a href="{{ route('admin.opentrip.create') }}" class="btn btn-success mb-2">Tambah Open Trip</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($openTrips as $openTrip)
                    <tr>
                        <td>{{ $openTrip->id }}</td>
                        <td>{{ $openTrip->name }}</td>
                        <td>{{ $openTrip->price }}</td>
                        <td>
                            <a href="{{ route('admin.opentrip.edit', $openTrip) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.opentrip.destroy', $openTrip) }}" method="POST"
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
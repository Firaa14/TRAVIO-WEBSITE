@extends('admin.layouts.app')
@section('content')
    <div class="container mt-4">
        <h2>Data Destinasi</h2>
        <a href="{{ route('admin.destination.create') }}" class="btn btn-success mb-2">Tambah Destinasi</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($destinations as $destination)
                    <tr>
                        <td>{{ $destination->id }}</td>
                        <td>{{ $destination->name }}</td>
                        <td>{{ $destination->description }}</td>
                        <td>
                            <a href="{{ route('admin.destination.edit', $destination) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.destination.destroy', $destination) }}" method="POST"
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
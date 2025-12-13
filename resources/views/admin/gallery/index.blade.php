@extends('admin.layouts.app')
@section('content')
    <div class="container mt-4">
        <h2>Data Gallery</h2>
        <a href="{{ route('admin.gallery.create') }}" class="btn btn-success mb-2">Tambah Gallery</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($galleries as $gallery)
                    <tr>
                        <td>{{ $gallery->id }}</td>
                        <td>{{ $gallery->title }}</td>
                        <td>{{ $gallery->image }}</td>
                        <td>
                            <a href="{{ route('admin.gallery.edit', $gallery) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.gallery.destroy', $gallery) }}" method="POST"
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
@extends('admin.layouts.app')
@section('content')
    <div class="container mt-4">
        <h2>Tambah Gallery</h2>
        <form action="{{ route('admin.gallery.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Gambar</label>
                <input type="text" class="form-control" id="image" name="image" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
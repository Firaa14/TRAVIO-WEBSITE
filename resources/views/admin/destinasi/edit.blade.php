@extends('admin.layouts.app')
@section('content')
    <div class="container mt-4">
        <h2>Edit Destinasi</h2>
        <form action="{{ route('admin.destinasi.update', $destinasi) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nama Destinasi</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $destinasi->name }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description"
                    required>{{ $destinasi->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.destinasi.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
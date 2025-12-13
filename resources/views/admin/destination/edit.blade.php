@extends('admin.layouts.app')
@section('content')
    <div class="container mt-4">
        <h2>Edit Destinasi</h2>
        <form action="{{ route('admin.destination.update', $destination) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nama Destinasi</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $destination->name }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description"
                    required>{{ $destination->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.destination.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
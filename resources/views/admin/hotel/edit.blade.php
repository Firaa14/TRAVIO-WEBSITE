@extends('admin.layouts.app')
@section('content')
    <div class="container mt-4">
        <h2>Edit Hotel</h2>
        <form action="{{ route('admin.hotel.update', $hotel) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nama Hotel</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $hotel->name }}" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $hotel->address }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.hotel.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
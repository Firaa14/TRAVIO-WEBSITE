@extends('admin.layouts.app')
@section('content')
    <div class="container mt-4">
        <h2>Edit Paket</h2>
        <form action="{{ route('admin.package.update', $package) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nama Paket</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $package->name }}" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ $package->price }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.package.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
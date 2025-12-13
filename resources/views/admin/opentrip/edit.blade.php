@extends('admin.layouts.app')
@section('content')
    <div class="container mt-4">
        <h2>Edit Open Trip</h2>
        <form action="{{ route('admin.opentrip.update', $openTrip) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nama Open Trip</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $openTrip->name }}" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ $openTrip->price }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.opentrip.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
@extends('admin.layouts.app')
@section('content')
    <div class="container mt-4">
        <h2>Tambah Planning</h2>
        <form action="{{ route('admin.planning.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="user_id" class="form-label">User ID</label>
                <input type="number" class="form-control" id="user_id" name="user_id" required>
            </div>
            <div class="mb-3">
                <label for="destination" class="form-label">Destinasi</label>
                <input type="text" class="form-control" id="destination" name="destination" required>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.planning.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
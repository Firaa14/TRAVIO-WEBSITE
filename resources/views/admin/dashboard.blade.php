@extends('admin.layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Selamat datang di Dashboard Admin</h1>
        <p>Kelola seluruh data aplikasi dari sini.</p>
        <div class="row mt-4">
            <div class="col-md-3">
                <a href="{{ route('admin.car.index') }}" class="btn btn-primary w-100 mb-2">Kelola Mobil</a>
                <a href="{{ route('admin.hotel.index') }}" class="btn btn-primary w-100 mb-2">Kelola Hotel</a>
                <a href="{{ route('admin.destinasi.index') }}" class="btn btn-primary w-100 mb-2">Kelola Destinasi</a>
                <a href="{{ route('admin.package.index') }}" class="btn btn-primary w-100 mb-2">Kelola Paket</a>
                <a href="{{ route('admin.opentrip.index') }}" class="btn btn-primary w-100 mb-2">Kelola Open Trip</a>
                <a href="{{ route('admin.user.index') }}" class="btn btn-primary w-100 mb-2">Kelola User</a>
                <!-- Tambahkan menu lain sesuai kebutuhan -->
            </div>
            <div class="col-md-9">
                <div class="alert alert-info">Silakan pilih menu di samping untuk mengelola data.</div>
            </div>
        </div>
    </div>
@endsection
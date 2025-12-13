@extends('admin.layouts.app')
@section('content')
    <div class="container mt-4">
        <h2>Data Mobil</h2>
        <a href="{{ route('admin.car.create') }}" class="btn btn-success mb-2">Tambah Mobil</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cars as $car)
                    <tr>
                        <td>{{ $car->id }}</td>
                        <td>{{ $car->title }}</td>
                        <td>{{ $car->price }}</td>
                        <td>
                            @if($car->image)
                                <img src="{{ asset('storage/' . $car->image) }}" alt="Gambar Mobil" width="80">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.car.edit', $car) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.car.destroy', $car) }}" method="POST" style="display:inline-block">
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
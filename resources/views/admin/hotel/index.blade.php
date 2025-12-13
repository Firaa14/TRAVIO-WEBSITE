@extends('admin.layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-3">Data Hotel</h2>

        <a href="{{ route('admin.hotel.create') }}" class="btn btn-success mb-3">
            + Tambah Hotel
        </a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                    <th>Lokasi</th>
                    <th>Fasilitas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($hotels as $hotel)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $hotel->title }}</td>
                        <td>{{ $hotel->price }}</td>
                        <td>{{ Str::limit($hotel->description, 50) }}</td>
                        <td>
                            @if($hotel->image)
                                <img src="{{ asset('storage/' . $hotel->image) }}" width="80" class="img-thumbnail">
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $hotel->location }}</td>
                        <td>
                            @if($hotel->facilities)
                                @php
                                    $facilities = is_array($hotel->facilities)
                                        ? $hotel->facilities
                                        : json_decode($hotel->facilities, true);
                                @endphp
                                {{ implode(', ', $facilities) }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.hotel.edit', $hotel->id) }}" class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('admin.hotel.destroy', $hotel->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data hotel ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Data hotel belum tersedia</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
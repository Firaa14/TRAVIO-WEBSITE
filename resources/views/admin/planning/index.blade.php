@extends('admin.layouts.app')
@section('content')
    <div class="container mt-4">
        <h2>Data Planning</h2>
        <a href="{{ route('admin.planning.create') }}" class="btn btn-success mb-2">Tambah Planning</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Destinasi</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($plannings as $planning)
                    <tr>
                        <td>{{ $planning->id }}</td>
                        <td>{{ $planning->user_id }}</td>
                        <td>{{ $planning->destination }}</td>
                        <td>{{ $planning->date }}</td>
                        <td>
                            <a href="{{ route('admin.planning.edit', $planning) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.planning.destroy', $planning) }}" method="POST"
                                style="display:inline-block">
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
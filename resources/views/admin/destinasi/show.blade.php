@extends('admin.layouts.app')

@section('title', 'Detail Destinasi')
@section('page-title', 'Detail Destinasi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Detail Destinasi</h4>
    <div>
        <a href="{{ route('admin.destinasi.edit', $destinasi) }}" class="btn btn-warning me-2">
            <i class="fas fa-edit me-2"></i>Edit
        </a>
        <a href="{{ route('admin.destinasi.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-map-marked-alt me-2"></i>{{ $destinasi->name }}</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                @if($destinasi->image)
                    <img src="{{ Storage::url($destinasi->image) }}" alt="{{ $destinasi->name }}" 
                         class="img-fluid rounded mb-3" style="max-height: 300px; width: 100%; object-fit: cover;">
                @else
                    <div class="bg-light rounded d-flex align-items-center justify-content-center mb-3" 
                         style="height: 300px;">
                        <i class="fas fa-image fa-3x text-muted"></i>
                    </div>
                @endif
            </div>
            <div class="col-md-8">
                <table class="table table-borderless">
                    <tr>
                        <td width="150"><strong>Nama</strong></td>
                        <td>: {{ $destinasi->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Harga</strong></td>
                        <td>: Rp {{ number_format($destinasi->price, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Lokasi</strong></td>
                        <td>: {{ $destinasi->location ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Dibuat</strong></td>
                        <td>: {{ $destinasi->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Diupdate</strong></td>
                        <td>: {{ $destinasi->updated_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>
                
                <div class="mt-4">
                    <h6><strong>Deskripsi</strong></h6>
                    <p class="text-muted">{{ $destinasi->description }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
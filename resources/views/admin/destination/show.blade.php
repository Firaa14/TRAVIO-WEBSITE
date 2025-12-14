@extends('admin.layouts.app')

@section('title', 'Detail Destination')
@section('page-title', 'Detail Destination')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Detail Destination</h4>
    <div>
        <a href="{{ route('admin.destination.edit', $destination) }}" class="btn btn-warning me-2">
            <i class="fas fa-edit me-2"></i>Edit
        </a>
        <a href="{{ route('admin.destination.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-mountain me-2"></i>{{ $destination->destinasi->name ?? 'Destination' }}</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <td width="150"><strong>Destinasi</strong></td>
                        <td>: {{ $destination->destinasi->name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Lokasi</strong></td>
                        <td>: {{ $destination->location }}</td>
                    </tr>
                    <tr>
                        <td><strong>Dibuat</strong></td>
                        <td>: {{ $destination->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Diupdate</strong></td>
                        <td>: {{ $destination->updated_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                @if($destination->destinasi && $destination->destinasi->image)
                    <img src="{{ Storage::url($destination->destinasi->image) }}" 
                         alt="{{ $destination->destinasi->name }}" 
                         class="img-fluid rounded" 
                         style="max-height: 200px; width: 100%; object-fit: cover;">
                @else
                    <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                         style="height: 200px;">
                        <i class="fas fa-image fa-3x text-muted"></i>
                    </div>
                @endif
            </div>
        </div>
        
        <div class="mt-4">
            <h6><strong>Detail</strong></h6>
            <p class="text-muted">{{ $destination->detail }}</p>
        </div>
        
        @if($destination->itinerary && count($destination->itinerary) > 0)
        <div class="mt-4">
            <h6><strong>Itinerary</strong></h6>
            <ul class="list-group list-group-flush">
                @foreach($destination->itinerary as $item)
                    <li class="list-group-item px-0">{{ $item }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
        @if($destination->price_details && count($destination->price_details) > 0)
        <div class="mt-4">
            <h6><strong>Detail Harga</strong></h6>
            <ul class="list-group list-group-flush">
                @foreach($destination->price_details as $price)
                    <li class="list-group-item px-0">{{ $price }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>
@endsection
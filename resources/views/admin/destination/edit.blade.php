@extends('admin.layouts.app')

@section('title', 'Edit Destination')
@section('page-title', 'Edit Destination')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Edit Data Destination</h4>
    <a href="{{ route('admin.destination.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Kembali
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Form Edit Destination</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.destination.update', $destination) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="destinasi_id" class="form-label">Pilih Destinasi *</label>
                    <select class="form-control @error('destinasi_id') is-invalid @enderror" 
                            id="destinasi_id" name="destinasi_id" required>
                        <option value="">Pilih Destinasi</option>
                        @foreach(App\Models\Destinasi::all() as $destinasi)
                            <option value="{{ $destinasi->id }}" 
                                    {{ old('destinasi_id', $destination->destinasi_id) == $destinasi->id ? 'selected' : '' }}>
                                {{ $destinasi->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('destinasi_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="location" class="form-label">Lokasi *</label>
                    <input type="text" class="form-control @error('location') is-invalid @enderror" 
                           id="location" name="location" value="{{ old('location', $destination->location) }}" required>
                    @error('location')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="detail" class="form-label">Detail *</label>
                <textarea class="form-control @error('detail') is-invalid @enderror" 
                          id="detail" name="detail" rows="4" required>{{ old('detail', $destination->detail) }}</textarea>
                @error('detail')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="itinerary" class="form-label">Itinerary</label>
                <textarea class="form-control @error('itinerary') is-invalid @enderror" 
                          id="itinerary" name="itinerary" rows="6" 
                          placeholder="Masukkan itinerary, pisahkan setiap item dengan baris baru">{{ old('itinerary', is_array($destination->itinerary) ? implode("\n", $destination->itinerary) : $destination->itinerary) }}</textarea>
                @error('itinerary')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Format: satu item per baris</small>
            </div>

            <div class="mb-3">
                <label for="price_details" class="form-label">Detail Harga</label>
                <textarea class="form-control @error('price_details') is-invalid @enderror" 
                          id="price_details" name="price_details" rows="4" 
                          placeholder="Masukkan detail harga, pisahkan setiap item dengan baris baru">{{ old('price_details', is_array($destination->price_details) ? implode("\n", $destination->price_details) : $destination->price_details) }}</textarea>
                @error('price_details')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Format: satu item per baris</small>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Update
                </button>
                <a href="{{ route('admin.destination.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times me-2"></i>Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
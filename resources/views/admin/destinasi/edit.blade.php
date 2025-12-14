@extends('admin.layouts.app')

@section('title', 'Edit Destinasi')
@section('page-title', 'Edit Destinasi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Edit Data Destinasi</h4>
    <a href="{{ route('admin.destinasi.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Kembali
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Form Edit Destinasi</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.destinasi.update', $destinasi) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Nama Destinasi *</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name', $destinasi->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="price" class="form-label">Harga *</label>
                    <input type="text" class="form-control @error('price') is-invalid @enderror" 
                           id="price" name="price" value="{{ old('price', number_format($destinasi->price, 0, ',', '.')) }}" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Lokasi</label>
                <input type="text" class="form-control @error('location') is-invalid @enderror" 
                       id="location" name="location" value="{{ old('location', $destinasi->location) }}">
                @error('location')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi *</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" name="description" rows="4" required>{{ old('description', $destinasi->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Gambar</label>
                @if($destinasi->image)
                    <div class="mb-2">
                        <img src="{{ Storage::url($destinasi->image) }}" alt="Current Image" 
                             class="rounded" style="max-height: 150px; max-width: 200px; object-fit: cover;">
                        <p class="text-muted small mt-1">Gambar saat ini</p>
                    </div>
                @endif
                <input type="file" class="form-control @error('image') is-invalid @enderror" 
                       id="image" name="image" accept="image/*">
                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar</small>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Update
                </button>
                <a href="{{ route('admin.destinasi.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times me-2"></i>Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('price').addEventListener('input', function (e) {
    let value = e.target.value.replace(/\D/g, '');
    e.target.value = new Intl.NumberFormat('id-ID').format(value);
});
</script>
@endpush
@extends('admin.layouts.app')

@section('title', 'Tambah Mobil')
@section('page-title', 'Tambah Mobil')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Tambah Data Mobil</h4>
    <a href="{{ route('admin.car.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Kembali
    </a>
</div>

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <h6><i class="fas fa-exclamation-circle me-2"></i>Terjadi kesalahan:</h6>
    <ul class="mb-0">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-plus me-2"></i>Form Tambah Mobil</h5>
    </div>
    <div class="card-body">
        <form id="carForm" action="{{ route('admin.car.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="title" class="form-label">Judul Mobil *</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                           id="title" name="title" value="{{ old('title') }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="brand" class="form-label">Brand</label>
                    <input type="text" class="form-control @error('brand') is-invalid @enderror" 
                           id="brand" name="brand" value="{{ old('brand') }}">
                    @error('brand')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="model" class="form-label">Model</label>
                    <input type="text" class="form-control @error('model') is-invalid @enderror" 
                           id="model" name="model" value="{{ old('model') }}">
                    @error('model')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="year" class="form-label">Tahun</label>
                    <input type="number" class="form-control @error('year') is-invalid @enderror" 
                           id="year" name="year" value="{{ old('year') }}" min="1990" max="{{ date('Y') + 1 }}">
                    @error('year')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="price" class="form-label">Harga *</label>
                    <input type="text" class="form-control @error('price') is-invalid @enderror" 
                           id="price" name="price" value="{{ old('price') }}" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="transmission" class="form-label">Transmisi</label>
                    <select class="form-control @error('transmission') is-invalid @enderror" 
                            id="transmission" name="transmission">
                        <option value="">Pilih Transmisi</option>
                        <option value="Manual" {{ old('transmission') == 'Manual' ? 'selected' : '' }}>Manual</option>
                        <option value="Automatic" {{ old('transmission') == 'Automatic' ? 'selected' : '' }}>Automatic</option>
                        <option value="CVT" {{ old('transmission') == 'CVT' ? 'selected' : '' }}>CVT</option>
                    </select>
                    @error('transmission')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="fuel_type" class="form-label">Jenis Bahan Bakar</label>
                    <select class="form-control @error('fuel_type') is-invalid @enderror" 
                            id="fuel_type" name="fuel_type">
                        <option value="">Pilih Bahan Bakar</option>
                        <option value="Bensin" {{ old('fuel_type') == 'Bensin' ? 'selected' : '' }}>Bensin</option>
                        <option value="Diesel" {{ old('fuel_type') == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                        <option value="Hybrid" {{ old('fuel_type') == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                        <option value="Electric" {{ old('fuel_type') == 'Electric' ? 'selected' : '' }}>Electric</option>
                    </select>
                    @error('fuel_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="capacity" class="form-label">Kapasitas Penumpang</label>
                    <input type="number" class="form-control @error('capacity') is-invalid @enderror" 
                           id="capacity" name="capacity" value="{{ old('capacity') }}" min="1" max="50">
                    @error('capacity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="color" class="form-label">Warna</label>
                    <input type="text" class="form-control @error('color') is-invalid @enderror" 
                           id="color" name="color" value="{{ old('color') }}">
                    @error('color')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="license_plate" class="form-label">Nomor Polisi</label>
                    <input type="text" class="form-control @error('license_plate') is-invalid @enderror" 
                           id="license_plate" name="license_plate" value="{{ old('license_plate') }}">
                    @error('license_plate')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Lokasi</label>
                <input type="text" class="form-control @error('location') is-invalid @enderror" 
                       id="location" name="location" value="{{ old('location') }}">
                @error('location')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi *</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="image" class="form-label">Gambar Utama</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                           id="image" name="image" accept="image/*">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="interior_image" class="form-label">Gambar Interior</label>
                    <input type="file" class="form-control @error('interior_image') is-invalid @enderror" 
                           id="interior_image" name="interior_image" accept="image/*">
                    @error('interior_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="gallery_images" class="form-label">Galeri Gambar</label>
                    <input type="file" class="form-control @error('gallery_images.*') is-invalid @enderror" 
                           id="gallery_images" name="gallery_images[]" accept="image/*" multiple>
                    <small class="text-muted">Bisa pilih multiple gambar</small>
                    @error('gallery_images.*')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Fasilitas</label>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="AC" id="ac">
                            <label class="form-check-label" for="ac">AC</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="GPS" id="gps">
                            <label class="form-check-label" for="gps">GPS</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Audio System" id="audio">
                            <label class="form-check-label" for="audio">Audio System</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Bluetooth" id="bluetooth">
                            <label class="form-check-label" for="bluetooth">Bluetooth</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="terms_conditions" class="form-label">Syarat dan Ketentuan</label>
                <textarea class="form-control @error('terms_conditions') is-invalid @enderror" 
                          id="terms_conditions" name="terms_conditions" rows="3">{{ old('terms_conditions') }}</textarea>
                @error('terms_conditions')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <span id="submitText"><i class="fas fa-save me-2"></i>Simpan</span>
                    <span id="loadingText" style="display: none;">
                        <i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...
                    </span>
                </button>
                <a href="{{ route('admin.car.index') }}" class="btn btn-secondary">
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

// Handle form submission with loading state
document.getElementById('carForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const loadingText = document.getElementById('loadingText');
    
    // Show loading state
    submitBtn.disabled = true;
    submitText.style.display = 'none';
    loadingText.style.display = 'inline';
    
    // Prevent double submission
    setTimeout(() => {
        if (submitBtn.disabled) {
            submitBtn.disabled = false;
            submitText.style.display = 'inline';
            loadingText.style.display = 'none';
        }
    }, 30000); // Reset after 30 seconds if no response
});
</script>
@endpush
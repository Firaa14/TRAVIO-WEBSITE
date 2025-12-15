@extends('admin.layouts.app')

@section('title', 'Tambah Paket')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tambah Paket</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.package.index') }}">Data Paket</a></li>
                    <li class="breadcrumb-item active">Tambah Paket</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
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
                <h3 class="card-title">Form Tambah Paket</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.package.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            
            <form id="packageForm" action="{{ route('admin.package.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Nama Paket <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('title') is-invalid @enderror" 
                                       id="title" 
                                       name="title" 
                                       value="{{ old('title') }}" 
                                       required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="location">Lokasi <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('location') is-invalid @enderror" 
                                       id="location" 
                                       name="location" 
                                       value="{{ old('location') }}" 
                                       required>
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price">Harga <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('price') is-invalid @enderror" 
                                       id="price" 
                                       name="price" 
                                       value="{{ old('price') }}" 
                                       placeholder="Contoh: Rp 1.500.000/orang"
                                       required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="duration">Durasi</label>
                                <input type="text" 
                                       class="form-control @error('duration') is-invalid @enderror" 
                                       id="duration" 
                                       name="duration" 
                                       value="{{ old('duration') }}"
                                       placeholder="Contoh: 3 Hari 2 Malam">
                                @error('duration')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Deskripsi <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="5" 
                                  required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Gambar Paket</label>
                        <input type="file" 
                               class="form-control-file @error('image') is-invalid @enderror" 
                               id="image" 
                               name="image" 
                               accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Format: JPEG, PNG, JPG, GIF. Max: 2MB</small>
                    </div>

                    <div class="form-group">
                        <label for="facilities">Fasilitas</label>
                        <textarea class="form-control @error('facilities') is-invalid @enderror" 
                                  id="facilities" 
                                  name="facilities" 
                                  rows="3"
                                  placeholder="Fasilitas yang tersedia dalam paket">{{ old('facilities') }}</textarea>
                        @error('facilities')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="itinerary">Itinerary (Satu item per baris)</label>
                        <textarea class="form-control @error('itinerary') is-invalid @enderror" 
                                  id="itinerary" 
                                  name="itinerary" 
                                  rows="5"
                                  placeholder="Hari 1: Kedatangan dan check-in hotel&#10;Hari 2: Tour wisata&#10;Hari 3: Free time dan departure">{{ old('itinerary') }}</textarea>
                        @error('itinerary')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Masukkan setiap kegiatan dalam baris baru</small>
                    </div>

                    <div class="form-group">
                        <label for="price_details">Detail Harga (Satu item per baris)</label>
                        <textarea class="form-control @error('price_details') is-invalid @enderror" 
                                  id="price_details" 
                                  name="price_details" 
                                  rows="4"
                                  placeholder="Hotel 2 malam: Rp 600.000&#10;Transportasi: Rp 300.000&#10;Makan 3x sehari: Rp 450.000&#10;Guide: Rp 150.000">{{ old('price_details') }}</textarea>
                        @error('price_details')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Masukkan setiap detail dalam baris baru</small>
                    </div>

                    <div class="form-group">
                        <label for="include">Yang Termasuk</label>
                        <textarea class="form-control @error('include') is-invalid @enderror" 
                                  id="include" 
                                  name="include" 
                                  rows="3"
                                  placeholder="Apa saja yang termasuk dalam paket ini">{{ old('include') }}</textarea>
                        @error('include')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exclude">Yang Tidak Termasuk</label>
                        <textarea class="form-control @error('exclude') is-invalid @enderror" 
                                  id="exclude" 
                                  name="exclude" 
                                  rows="3"
                                  placeholder="Apa saja yang tidak termasuk dalam paket ini">{{ old('exclude') }}</textarea>
                        @error('exclude')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="terms_conditions">Syarat & Ketentuan</label>
                        <textarea class="form-control @error('terms_conditions') is-invalid @enderror" 
                                  id="terms_conditions" 
                                  name="terms_conditions" 
                                  rows="4"
                                  placeholder="Syarat dan ketentuan untuk paket ini">{{ old('terms_conditions') }}</textarea>
                        @error('terms_conditions')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <span id="submitText"><i class="fas fa-save"></i> Simpan</span>
                        <span id="loadingText" style="display: none;">
                            <i class="fas fa-spinner fa-spin"></i> Menyimpan...
                        </span>
                    </button>
                    <a href="{{ route('admin.package.index') }}" class="btn btn-secondary ml-2">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
// Handle form submission with loading state
document.getElementById('packageForm').addEventListener('submit', function(e) {
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
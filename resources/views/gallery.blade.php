@extends('layouts.app')
@section('title', 'Gallery | Travio')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/gallery.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    @section('herogallery')
        @include('components.herogallery')
    @endsection

    <section class="gallery-section text-center">
        <div class="container">
            <h2 class="mb-5" style="margin-top: -40px; font-size:1.3rem; font-weight:400;">Share Your Own Experience Here,
                too!</h2>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row g-4 justify-content-center mb-4">
                @forelse($galleries as $gallery)
                    <div class="col-md-4 col-lg-4 col-xl-4 d-flex align-items-stretch">
                        <div class="card gallery-card w-100">
                            <img src="{{ asset($gallery->image) }}" alt="Gallery image">
                            <div class="card-body text-start">
                                <div class="profile-info">
                                    <img src="https://i.pravatar.cc/100?u={{ $gallery->user->id }}" alt="Profile">
                                    <div>
                                        <strong>{{ $gallery->user->name }}</strong><br>
                                        <small class="text-muted">{{ $gallery->created_at->format('d M Y') }}</small>
                                    </div>
                                </div>
                                <h6 class="mt-2 fw-bold"><i class="bi bi-geo-alt-fill text-danger"></i> {{ $gallery->location }}
                                </h6>
                                <p class="small text-muted">{{ $gallery->caption }}</p>

                                @auth
                                    @if($gallery->user_id === auth()->id())
                                        <form action="{{ route('gallery.destroy', $gallery) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Yakin ingin menghapus post ini?')">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">Belum ada postingan gallery.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-5 d-flex justify-content-center">
                {{ $galleries->links('pagination::bootstrap-5') }}
            </div>

            <!-- Upload Form -->
            @auth
                <div class="upload-form mt-5 text-start">
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://i.pravatar.cc/100?u={{ auth()->id() }}" class="rounded-circle me-2" width="45"
                            height="45" alt="Profile">
                        <h5 class="m-0">{{ auth()->user()->name }}</h5>
                    </div>

                    <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data" id="gallery-form">
                        @csrf
                        <div class="mb-3">
                            <label for="location" class="form-label fw-semibold">Tag Lokasi</label>
                            <input type="text" id="location" name="location"
                                class="form-control @error('location') is-invalid @enderror" placeholder="Masukkan nama lokasi"
                                value="{{ old('location') }}" required>
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="caption" class="form-label fw-semibold">Ceritakan Pengalamanmu</label>
                            <textarea id="caption" name="caption" rows="3"
                                class="form-control @error('caption') is-invalid @enderror" placeholder="Tulis sesuatu..."
                                required>{{ old('caption') }}</textarea>
                            @error('caption')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Preview Card -->
                        <div id="preview-card" class="card mb-3 d-none" style="max-width: 300px;">
                            <div class="row g-0">
                                <div class="col-4 d-flex align-items-center justify-content-center">
                                    <img id="preview-img" src="#" alt="Preview" class="img-fluid rounded-start"
                                        style="max-height: 80px; max-width: 80px; object-fit: cover;" />
                                </div>
                                <div class="col-8">
                                    <div class="card-body py-2 px-2">
                                        <h6 class="card-title mb-1 fw-bold" id="preview-location"></h6>
                                        <p class="card-text mb-1 small" id="preview-caption"></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-primary">Post</button>
                            <label class="btn btn-outline-primary mb-0">
                                Upload Photos Here <input type="file" id="photo-upload" name="image" accept="image/*" required
                                    hidden>
                            </label>
                        </div>
                    </form>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const photoInput = document.getElementById('photo-upload');
                            const previewCard = document.getElementById('preview-card');
                            const previewImg = document.getElementById('preview-img');
                            const locationInput = document.getElementById('location');
                            const captionInput = document.getElementById('caption');
                            const previewLocation = document.getElementById('preview-location');
                            const previewCaption = document.getElementById('preview-caption');

                            function updatePreview() {
                                previewLocation.textContent = locationInput.value;
                                previewCaption.textContent = captionInput.value;
                            }

                            photoInput.addEventListener('change', function (e) {
                                const file = e.target.files[0];
                                if (file && file.type.startsWith('image/')) {
                                    const reader = new FileReader();
                                    reader.onload = function (ev) {
                                        previewImg.src = ev.target.result;
                                        previewCard.classList.remove('d-none');
                                        updatePreview();
                                    };
                                    reader.readAsDataURL(file);
                                } else {
                                    previewCard.classList.add('d-none');
                                }
                            });

                            locationInput.addEventListener('input', updatePreview);
                            captionInput.addEventListener('input', updatePreview);
                        });
                    </script>
                </div>
            @else
                <div class="alert alert-info text-center mt-5">
                    <p class="mb-0">Silakan <a href="{{ route('login') }}" class="alert-link">login</a> untuk berbagi pengalaman
                        Anda!</p>
                </div>
            @endauth
        </div>
    </section>

@endsection
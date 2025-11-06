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

            <div class="row g-4 justify-content-center mb-4">
                @foreach($posts->slice(0, 9) as $post)
                    <div class="col-md-4 col-lg-4 col-xl-4 d-flex align-items-stretch">
                        <div class="card gallery-card w-100">
                            <img src="{{ $post['image'] }}" alt="Gallery image">
                            <div class="card-body text-start">
                                <div class="profile-info">
                                    <img src="{{ $post['profile'] }}" alt="Profile">
                                    <div>
                                        <strong>{{ $post['username'] }}</strong><br>
                                        <small class="text-muted">{{ $post['date'] }}</small>
                                    </div>
                                </div>
                                <h6 class="mt-2 fw-bold"><i class="bi bi-geo-alt-fill text-danger"></i> {{ $post['location'] }}
                                </h6>
                                <p class="small text-muted">{{ $post['caption'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-5 d-flex justify-content-center">
                {{ $posts->links('pagination::bootstrap-5') }}
            </div>

            <!-- Upload Form -->
            <div class="upload-form mt-5 text-start">
                <div class="d-flex align-items-center mb-3">
                    <img src="https://i.pravatar.cc/100?img=12" class="rounded-circle me-2" width="45" height="45"
                        alt="Profile">
                    <h5 class="m-0">Syafira</h5>
                </div>

                <form>
                    <div class="mb-3">
                        <label for="location" class="form-label fw-semibold">Tag Lokasi</label>
                        <select id="location" class="form-select">
                            <option>Pantai Balekambang</option>
                            <option>Gunung Bromo</option>
                            <option>Coban Rondo</option>
                            <option>Kebun Teh Lawang</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="caption" class="form-label fw-semibold">Ceritakan Pengalamanmu</label>
                        <textarea id="caption" rows="3" class="form-control" placeholder="Tulis sesuatu..."></textarea>
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

                    <div class="d-flex justify-content-between align-items-center">
                        <button type="button">Post</button>
                        <label class="btn btn-outline-primary mb-0">
                            Upload Photos Here <input type="file" id="photo-upload" accept="image/*" hidden>
                        </label>
                    </div>
                </form>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const photoInput = document.getElementById('photo-upload');
                        const previewCard = document.getElementById('preview-card');
                        const previewImg = document.getElementById('preview-img');
                        const locationSelect = document.getElementById('location');
                        const captionInput = document.getElementById('caption');
                        const previewLocation = document.getElementById('preview-location');
                        const previewCaption = document.getElementById('preview-caption');

                        function updatePreview() {
                            previewLocation.textContent = locationSelect.value;
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

                        locationSelect.addEventListener('change', updatePreview);
                        captionInput.addEventListener('input', updatePreview);
                    });
                </script>
            </div>
        </div>
    </section>

@endsection
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
            <h2 class="mb-5 fw-bold">Travelers' Gallery</h2>

            <div class="row g-4">
                @foreach($posts as $post)
                    <div class="col-md-2 col-lg-2 col-xl-2">
                        <div class="card gallery-card">
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
                    <h5 class="m-0">Unknown1446</h5>
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

                    <div class="d-flex justify-content-between align-items-center">
                        <button type="button">Post</button>
                        <label class="btn btn-outline-primary">
                            Upload Photos Here <input type="file" hidden>
                        </label>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection
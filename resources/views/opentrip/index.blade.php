@extends('layouts.app')
@section('title', 'Open Trip | Travio')


@section('content')
    @include('components.heroop')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">


    <div class="container py-5">
        <h2 class="mb-5 text-center fw-bold text-primary animate__animated animate__fadeInDown" style="margin-top: -40px; font-size:1.5rem;">
            Share your open trip stories, tips, or favorite moments here!<br>
            <span class="text-secondary fw-normal" style="font-size:1.1rem;">Inspire others to join the adventure.</span>
        </h2>
        <div class="row g-4">
            @foreach($trips as $trip)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-lg border-0 h-100 rounded-4 animate__animated animate__fadeInUp trip-card">
                        <div class="position-relative">
                            <img src="{{ asset($trip['gambar']) }}" class="card-img-top rounded-top-4 trip-img" alt="{{ $trip['judul'] }}"
                                style="height: 220px; object-fit: cover;">
                            <span class="badge bg-primary position-absolute top-0 end-0 m-3 px-3 py-2 fs-6 shadow"><i class="bi bi-calendar-event me-1"></i> {{ $trip['tanggal'] }}</span>
                        </div>
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title fw-bold text-primary">{{ $trip['judul'] }}</h5>
                                <p class="card-text text-muted small mb-1"><i class="bi bi-geo-alt"></i> {{ $trip['lokasi'] }}</p>
                                <p class="fw-semibold text-success mb-2">
                                    <i class="bi bi-cash-stack me-1"></i> Rp{{ number_format($trip['harga'], 0, ',', '.') }} <span class="text-muted fs-6">/person</span>
                                </p>
                                <p class="small text-secondary">{{ Str::limit($trip['deskripsi'], 70) }}</p>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('opentrip.show', $trip['id']) }}" class="btn btn-gradient-primary w-100 fw-bold shadow-sm">
                                    <i class="bi bi-eye me-1"></i> View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <style>
            .trip-card {
                transition: transform .2s, box-shadow .2s;
            }
            .trip-card:hover {
                transform: scale(1.03);
                box-shadow: 0 0 30px #007bff33;
            }
            .trip-img {
                transition: filter .3s, transform .3s;
            }
            .trip-card:hover .trip-img {
                filter: brightness(1.08);
                transform: scale(1.04);
            }
            .btn-gradient-primary {
                background: linear-gradient(90deg,#007bff 0%,#00c6ff 100%);
                color: #fff;
                border: none;
                transition: filter .2s, box-shadow .2s, transform .2s;
            }
            .btn-gradient-primary:hover {
                filter: brightness(1.1);
                box-shadow: 0 0 20px #00c6ff55;
                transform: scale(1.03);
            }
        </style>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    </div>

    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        html,
        body {
            overflow-x: hidden !important;
            width: 100vw;
            box-sizing: border-box;
        }
    </style>
@endsection
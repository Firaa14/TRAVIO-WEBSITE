@extends('layouts.app')
@section('title', 'Open Trip | Travio')


@section('content')
    @include('components.heroop')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">


    <div class="container py-5">
        <h2 class="mb-5 text-center fw-bold text-primary animate__animated animate__fadeInDown"
            style="margin-top: -40px; font-size:1.5rem;">
            Share your open trip stories, tips, or favorite moments here!<br>
            <span class="text-secondary fw-normal" style="font-size:1.1rem;">Inspire others to join the adventure.</span>
        </h2>
        <div class="row g-4">
            @foreach($trips as $trip)
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100 trip-card" style="border-radius: 12px; overflow: hidden;">
                        <div class="position-relative">
                            <img src="{{ asset($trip['gambar']) }}" class="card-img-top trip-img" alt="{{ $trip['judul'] }}"
                                style="height: 200px; object-fit: cover;">
                        </div>
                        <div class="card-body d-flex flex-column" style="padding: 1.25rem;">
                            <h5 class="card-title fw-bold mb-2" style="font-size: 1.1rem; color: #1a1a1a;">{{ $trip['judul'] }}
                            </h5>
                            <p class="text-muted mb-2" style="font-size: 0.9rem; line-height: 1.5;">
                                {{ Str::limit($trip['deskripsi'], 65) }}
                            </p>

                            <div class="mb-2">
                                <p class="text-muted mb-1" style="font-size: 0.85rem;">
                                    <i class="bi bi-geo-alt-fill" style="color: #6c757d;"></i> {{ $trip['lokasi'] }}
                                </p>
                                <p class="text-muted mb-0" style="font-size: 0.85rem;">
                                    <i class="bi bi-clock-fill" style="color: #6c757d;"></i> Full Day Experience
                                </p>
                            </div>

                            <div class="mt-auto pt-3 border-top">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4 class="mb-0 fw-bold" style="color: #0066ff; font-size: 1.25rem;">
                                            Rp {{ number_format($trip['harga'] / 1000, 0, ',', '.') }}.000
                                        </h4>
                                        <small class="text-muted" style="font-size: 0.8rem;">per person</small>
                                    </div>
                                    <a href="{{ route('opentrip.show', $trip['id']) }}" class="btn btn-primary"
                                        style="border-radius: 8px; padding: 0.5rem 1.5rem; font-weight: 500;">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <style>
            .trip-card {
                transition: all 0.3s ease;
                background: #fff;
            }

            .trip-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12) !important;
            }

            .trip-img {
                transition: transform 0.3s ease;
            }

            .trip-card:hover .trip-img {
                transform: scale(1.05);
            }

            .btn-primary {
                background-color: #0066ff;
                border: none;
                transition: all 0.2s ease;
            }

            .btn-primary:hover {
                background-color: #0052cc;
                transform: scale(1.02);
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
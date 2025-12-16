@extends('layouts.app')

@section('title', 'Hotel Detail')

@section('content')
    @php
        $hideNavbar = true; // sembunyikan navbar jika diperlukan
        $activeTab = $activeTab ?? 'details';
    @endphp

    @include('components.heroopentrip', ['trip' => $trip])

    <section class="py-5" style="background: #f8f9fa;">
        <div class="container" style="max-width: 1200px;">
            <div class="row justify-content-center g-4">
                <!-- LEFT CONTENT -->
                <div class="col-lg-6 col-xl-5">
                    <div class="card border-0 shadow-sm p-4" style="border-radius: 16px; background: #fff;">
                        <div class="mb-3">
                            <span class="badge bg-primary px-3 py-2 me-2" style="border-radius: 8px;">
                                <i class="bi bi-calendar-event me-1"></i> {{ $trip->start_date->format('d M Y') }} - {{ $trip->end_date->format('d M Y') }}
                            </span>
                            <span class="badge bg-secondary px-3 py-2" style="border-radius: 8px;">
                                <i class="bi bi-geo-alt me-1"></i> {{ $trip->location }}
                            </span>
                        </div>

                        <h2 class="fw-bold mb-3" style="color: #1a1a1a; font-size: 1.75rem;">{{ $trip->title }}</h2>

                        <div class="mb-4 p-3"
                            style="background: #f0f9ff; border-radius: 12px; border-left: 4px solid #0066ff;">
                            <h3 class="fw-bold mb-0" style="color: #0066ff; font-size: 1.5rem;">
                                Rp {{ number_format($trip->price, 0, ',', '.') }}
                            </h3>
                            <small class="text-muted">per person</small>
                        </div>

                        <p class="mb-4 text-secondary" style="line-height: 1.7;">{{ $trip->description }}</p>

                        <div class="mb-4">
                            <h5 class="fw-bold mb-3" style="color: #1a1a1a; font-size: 1.1rem;">
                                <i class="bi bi-check-circle-fill text-success me-2"></i>What's Included
                            </h5>
                            <ul class="list-unstyled">
                                @if($trip->facilities && is_array($trip->facilities))
                                    @foreach($trip->facilities as $facility)
                                        <li class="mb-2" style="padding-left: 1.5rem; position: relative;">
                                            <i class="bi bi-check2 text-success position-absolute"
                                                style="left: 0; top: 2px; font-size: 1.2rem;"></i>
                                            {{ $facility }}
                                        </li>
                                    @endforeach
                                @else
                                    <li class="mb-2" style="padding-left: 1.5rem; position: relative;">
                                        <i class="bi bi-check2 text-success position-absolute"
                                            style="left: 0; top: 2px; font-size: 1.2rem;"></i>
                                        Transportation
                                    </li>
                                    <li class="mb-2" style="padding-left: 1.5rem; position: relative;">
                                        <i class="bi bi-check2 text-success position-absolute"
                                            style="left: 0; top: 2px; font-size: 1.2rem;"></i>
                                        Tour Guide
                                    </li>
                                @endif
                            </ul>
                        </div>
                        @auth
                            <a href="{{ route('opentrip.checkout', $trip->id) }}" class="btn btn-primary btn-lg w-100 fw-bold"
                                style="border-radius: 12px; padding: 0.875rem 2rem; background: #0066ff; border: none; transition: all 0.2s;">
                                <i class="bi bi-bag-check-fill me-2"></i> Book Now
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg w-100 fw-bold"
                                style="border-radius: 12px; padding: 0.875rem 2rem; background: #0066ff; border: none; transition: all 0.2s;">
                                <i class="bi bi-box-arrow-in-right me-2"></i> Login to Book
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- RIGHT IMAGE -->
                <div class="col-lg-6 col-xl-5">
                    <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 16px;">
                        <img src="{{ asset($trip->image) }}" class="img-fluid w-100 trip-detail-img"
                            alt="{{ $trip['judul'] }}" style="height: 500px; object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .btn-primary:hover {
            background: #0052cc !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 102, 255, 0.3);
        }

        .trip-detail-img {
            transition: transform 0.3s ease;
        }

        .card:hover .trip-detail-img {
            transform: scale(1.05);
        }

        html,
        body {
            overflow-x: hidden !important;
        }
    </style>
@endsection
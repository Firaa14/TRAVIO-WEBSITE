@extends('layouts.app')

@section('title', 'All Cars | Travio')

@section('content')
    @php
        $hideNavbar = true;
    @endphp

    <!-- Header Section dengan video background seperti packages -->
    <section class="position-relative text-white" style="height: 400px; overflow: hidden;">
        <video autoplay loop muted playsinline class="w-100 h-100 position-absolute top-0 start-0 object-fit-cover"
            style="object-fit: cover; min-width:100%; min-height:100%; z-index:0;">
            <source src="{{ asset('videos/rental.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.6); z-index:1;"></div>

        <div class="position-relative h-100 d-flex flex-column justify-content-center align-items-center"
            style="z-index:2;">
            <a href="{{ url()->previous() == url()->current() ? route('dashboard') : url()->previous() }}"
                class="position-absolute top-0 start-0 m-4 text-white fw-semibold d-flex align-items-center"
                style="text-decoration:none; font-size:1rem;">
                <i class="bi bi-arrow-left-circle-fill me-1" style="font-size:1.5rem;"></i>
                Back
            </a>

            <div class="text-center">
                <h1 class="fw-bold mb-2" style="font-size:2.8rem;">Discover Amazing Cars!</h1>
                <p class="lead mb-3" style="font-size:1.3rem;">
                    Find the perfect rental car for your next journey with our trusted partners.
                </p>
            </div>
        </div>
    </section>

    {{-- === Car Grid === --}}
    <section class="cars py-5" style="background:#f8f9fa;">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="row justify-content-center g-4" style="max-width: 1600px;">

                    @forelse ($cars as $car)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center">
                            <div class="card shadow-sm border-0 rounded-4 overflow-hidden hover-lift"
                                style="width:320px; height:480px; transition: transform 0.3s ease;">
                                <div class="position-relative">
                                    <img src="{{ asset($car->image) }}" class="card-img-top"
                                        style="height:230px; object-fit:cover;" alt="{{ $car->title }}">
                                </div>

                                <div class="card-body d-flex flex-column" style="height:200px;">
                                    <h5 class="fw-bold mb-2 text-truncate" title="{{ $car->title }}">{{ $car->title }}</h5>
                                    <p class="text-muted small mb-3 flex-grow-1"
                                        style="overflow:hidden; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
                                        {{ $car->description }}
                                    </p>

                                    <!-- Car highlights -->
                                    <div class="mt-auto">
                                        <div class="d-flex align-items-center mb-1">
                                            <i class="bi bi-car-front-fill text-primary me-2"></i>
                                            <small class="text-muted">{{ $car->brand ?? 'Available' }}</small>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-people-fill text-primary me-2"></i>
                                            <small class="text-muted">{{ $car->capacity ?? '4' }} Passengers</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center"
                                    style="height:80px;">
                                    <div>
                                        <span class="fw-bold text-primary fs-5">Rp
                                            {{ number_format($car->price, 0, ',', '.') }}</span>
                                        <small class="text-muted d-block">per day</small>
                                    </div>
                                    <a href="{{ route('cars.show', $car->id) }}"
                                        class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                        <i class="bi bi-eye me-1"></i>View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <i class="bi bi-car-front display-1 text-muted mb-3"></i>
                            <h4 class="text-muted">No cars found</h4>
                            <p class="text-muted">Check back later for amazing rental cars!</p>
                        </div>
                    @endforelse

                </div>
            </div>

            {{-- Pagination dengan info seperti packages --}}
            @if($cars->hasPages())
                <div class="d-flex justify-content-center align-items-center mt-5">
                    {{ $cars->links('pagination::bootstrap-4') }}
                </div>
            @endif

            <div class="text-center mt-3">
                <p class="text-muted small">
                    Showing {{ $cars->firstItem() ?? 0 }} to {{ $cars->lastItem() ?? 0 }} of {{ $cars->total() }} results
                </p>
            </div>
        </div>
    </section>

    <style>
        .hover-lift:hover {
            transform: translateY(-5px) !important;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }

        .card {
            border: none;
            transition: all 0.3s ease;
        }

        .btn-outline-primary {
            border-color: #0d6efd;
            color: #0d6efd;
        }

        .btn-outline-primary:hover {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: white;
        }
    </style>



@endsection
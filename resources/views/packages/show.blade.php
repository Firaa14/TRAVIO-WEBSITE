@extends('layouts.app')

@section('title', $package->title . ' | Travio')

@section('content')
    @php
        $hideNavbar = true;
    @endphp

    <!-- Header Section dengan video background -->
    <section class="position-relative text-white" style="height: 400px; overflow: hidden;">
        <video autoplay loop muted playsinline class="w-100 h-100 position-absolute top-0 start-0 object-fit-cover"
            style="object-fit: cover; min-width:100%; min-height:100%; z-index:0;">
            <source src="{{ asset('videos/cart.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.6); z-index:1;"></div>

        <div class="position-relative h-100 d-flex flex-column justify-content-center align-items-center"
            style="z-index:2;">
            <a href="{{ url()->previous() == url()->current() ? (request()->has('from') && request('from') == 'packages' ? route('packages.index') : route('dashboard')) : url()->previous() }}"
                class="position-absolute top-0 start-0 m-4 text-white fw-semibold d-flex align-items-center"
                style="text-decoration:none; font-size:1rem;">
                <i class="bi bi-arrow-left-circle-fill me-1" style="font-size:1.5rem;"></i>
                Back
            </a>

            <div class="text-center">
                <h1 class="fw-bold mb-2" style="font-size:2.8rem;">{{ $package->title }}</h1>
                <p class="lead mb-3" style="font-size:1.3rem;">
                    Discover the perfect travel package for your next adventure.
                </p>
            </div>
        </div>
    </section>

    <section class="py-5" style="background:#f8f9fa;">
        <div class="container px-4 px-md-5" style="max-width: 1200px;">
            <div class="row g-5 justify-content-center">
                {{-- Image Gallery Section --}}
                <div class="col-12 col-lg-7">
                    <div class="mb-4">
                        <img src="{{ asset('photos/' . $package->image) }}" class="img-fluid rounded-3 shadow"
                            style="width:100%; height:400px; object-fit:cover;" alt="{{ $package->title }}">
                    </div>

                    <!-- Package Highlights -->
                    <div class="row g-3 mb-4">
                        <div class="col-6 col-md-3">
                            <div class="bg-white p-3 rounded-3 text-center shadow-sm">
                                <i class="bi bi-geo-alt-fill text-primary fs-4"></i>
                                <div class="fw-semibold small mt-2">{{ $package->location ?? 'Multiple' }}</div>
                                <div class="text-muted small">Destinations</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="bg-white p-3 rounded-3 text-center shadow-sm">
                                <i class="bi bi-clock-fill text-primary fs-4"></i>
                                <div class="fw-semibold small mt-2">{{ $package->duration ?? '3 Days' }}</div>
                                <div class="text-muted small">Duration</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="bg-white p-3 rounded-3 text-center shadow-sm">
                                <i class="bi bi-people-fill text-primary fs-4"></i>
                                <div class="fw-semibold small mt-2">2-8</div>
                                <div class="text-muted small">People</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="bg-white p-3 rounded-3 text-center shadow-sm">
                                <i class="bi bi-star-fill text-primary fs-4"></i>
                                <div class="fw-semibold small mt-2">4.8</div>
                                <div class="text-muted small">Rating</div>
                            </div>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="bg-white p-4 rounded-3 shadow-sm mb-4">
                        <h4 class="fw-bold mb-3">Package Description</h4>
                        <p class="text-muted mb-0" style="line-height: 1.7;">
                            {{ $package->description }}
                        </p>
                    </div>

                    {{-- Itinerary --}}
                    <div class="bg-white p-4 rounded-3 shadow-sm">
                        <h4 class="fw-bold mb-3">Travel Itinerary</h4>
                        <div class="timeline">
                            @foreach($package->itinerary as $index => $item)
                                <div class="d-flex mb-3">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                        style="width: 30px; height: 30px; font-size: 0.8rem; font-weight: bold;">
                                        {{ $index + 1 }}
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="mb-0 fw-medium">{{ $item }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Booking Information --}}
                <div class="col-12 col-lg-5">
                    <div class="bg-white p-4 rounded-3 shadow-sm sticky-top" style="top: 100px;">
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="fw-bold text-primary mb-0">Package Price</h4>
                                <div class="badge bg-success fs-6">Best Value</div>
                            </div>
                            <div class="fs-2 fw-bold text-primary">Rp {{ number_format($package->price, 0, ',', '.') }}
                            </div>
                            <p class="text-muted mb-0">per person</p>
                        </div>

                        <div class="border-top border-bottom py-3 mb-4">
                            <p class="text-muted small mb-2 fw-semibold">Includes:</p>
                            <p class="text-dark mb-0">{{ $package->include ?? 'Transportation & Meals' }}</p>
                        </div>

                        {{-- Facilities --}}
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Package Includes:</h6>
                            <div class="row g-2">
                                @foreach($package->facilities as $facility)
                                    <div class="col-12">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                                            <small class="text-muted">{{ $facility }}</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Booking Form --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Travel Date</label>
                            <input type="date" class="form-control mb-3" min="{{ date('Y-m-d') }}">

                            <label class="form-label fw-semibold">Number of Travelers</label>
                            <select class="form-select mb-3">
                                <option>Select number of people</option>
                                @for($i = 1; $i <= 8; $i++)
                                    <option value="{{ $i }}">{{ $i }} {{ $i == 1 ? 'Person' : 'People' }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <a href="{{ route('package.booking.create', $package->id) }}"
                                class="btn btn-primary btn-lg rounded-3 fw-semibold py-3">
                                <i class="bi bi-calendar-check me-2"></i>
                                Book This Package
                            </a>
                            <button class="btn btn-outline-primary rounded-3">
                                <i class="bi bi-chat-dots me-2"></i>
                                Ask Questions
                            </button>
                        </div>

                        {{-- Additional Info --}}
                        <div class="mt-4 pt-3 border-top">
                            <div class="row g-3 text-center">
                                <div class="col-4">
                                    <i class="bi bi-shield-check text-success fs-5"></i>
                                    <div class="small text-muted mt-1">Safe Travel</div>
                                </div>
                                <div class="col-4">
                                    <i class="bi bi-arrow-clockwise text-primary fs-5"></i>
                                    <div class="small text-muted mt-1">Free Cancel</div>
                                </div>
                                <div class="col-4">
                                    <i class="bi bi-headset text-info fs-5"></i>
                                    <div class="small text-muted mt-1">24/7 Support</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .timeline {
            position: relative;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 15px;
            top: 35px;
            bottom: 0;
            width: 2px;
            background: #e9ecef;
        }

        .btn-primary {
            background: linear-gradient(45deg, #0d6efd, #6f42c1);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #0b5ed7, #5a32a3);
            transform: translateY(-1px);
        }

        .sticky-top {
            z-index: 1000;
        }

        @media (max-width: 991px) {
            .sticky-top {
                position: relative !important;
                top: 0 !important;
            }
        }
    </style>
@endsection
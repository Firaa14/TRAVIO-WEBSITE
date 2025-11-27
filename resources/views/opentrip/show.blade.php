@extends('layouts.app')

@section('title', 'Hotel Detail')

@section('content')
    @php
        $hideNavbar = true; // sembunyikan navbar jika diperlukan
        $activeTab = $activeTab ?? 'details';
    @endphp

    @include('components.heroopentrip', ['trip' => $trip])

    <section class="container py-5 min-vh-100">
        <div class="row justify-content-center align-items-center">
            <!-- LEFT CONTENT -->
            <div class="col-lg-7 mb-4 mb-lg-0">
                <div class="card border-0 shadow-lg rounded-4 p-4 h-100 animate__animated animate__fadeInLeft">
                    <div class="d-flex align-items-center mb-3 gap-3">
                        <span class="badge bg-primary fs-6 px-3 py-2"><i class="bi bi-calendar-event me-1"></i>
                            {{ $trip->schedule }}</span>
                        <span class="badge bg-info text-dark fs-6 px-3 py-2"><i class="bi bi-geo-alt me-1"></i>
                            {{ $trip->location }}</span>
                    </div>
                    <h2 class="fw-bold mb-2 text-primary">{{ $trip->title }}</h2>
                    <h4 class="text-success fw-bold mb-4">
                        <i class="bi bi-cash-stack me-1"></i> Rp{{ number_format($trip->price, 0, ',', '.') }} <span
                            class="fs-6 text-muted">/person</span>
                    </h4>
                    <p class="mb-4 text-secondary">{{ $trip->description }}</p>
                    <div class="mb-4">
                        <h5 class="fw-bold mb-2"><i class="bi bi-check-circle text-success me-2"></i>What's Included</h5>
                        <ul class="list-group list-group-flush">
                            @foreach($trip->included as $item)
                                <li class="list-group-item ps-0"><i class="bi bi-dot text-primary"></i> {{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mb-4">
                        <h5 class="fw-bold mb-2"><i class="bi bi-exclamation-circle text-warning me-2"></i>What to Prepare
                        </h5>
                        <ul class="list-group list-group-flush">
                            @foreach($trip->prepare as $item)
                                <li class="list-group-item ps-0"><i class="bi bi-dot text-warning"></i> {{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <a href="{{ route('opentrip.register', $trip->id) }}"
                        class="btn btn-lg btn-gradient-primary mt-4 px-4 py-2 w-100 fw-bold shadow-sm animate__animated animate__pulse animate__infinite"
                        style="background: linear-gradient(90deg,#007bff 0%,#00c6ff 100%); color: #fff; border: none;">
                        <i class="bi bi-pencil-square me-2"></i> Register Yourself
                    </a>
                </div>
            </div>
            <!-- RIGHT IMAGE -->
            <div class="col-lg-5 text-center animate__animated animate__fadeInRight">
                <div
                    class="card border-0 shadow rounded-4 p-3 bg-light h-100 d-flex align-items-center justify-content-center">
                    <img src="{{ asset($trip->image) }}" class="img-fluid rounded-4 shadow-sm hover-zoom"
                        alt="{{ $trip->title }}" style="max-height: 400px; object-fit: cover; transition: transform .3s;">
                </div>
            </div>
        </div>
        <style>
            .btn-gradient-primary:hover {
                filter: brightness(1.1);
                box-shadow: 0 0 20px #00c6ff55;
                transform: scale(1.03);
            }

            .hover-zoom:hover {
                transform: scale(1.07);
                box-shadow: 0 0 30px #007bff33;
            }

            html,
            body {
                overflow-x: hidden !important;
                width: 100vw;
                box-sizing: border-box;
            }
        </style>
        <!-- Optional: Animate.css CDN for animation -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    </section>
@endsection
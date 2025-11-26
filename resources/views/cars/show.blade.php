@extends('layouts.app')
@section('title', $car['name'])

@section('content')
    @php
        $hideNavbar = true;
        $activeTab = $activeTab ?? 'details';
    @endphp

    <style>
        /* ==== GLOBAL STYLE ==== */
        .section-title {
            font-weight: 700;
            font-size: 1.4rem;
            margin-bottom: 12px;
            color: #1a1a1a;
        }

        .info-text {
            font-size: 0.95rem;
            color: #555;
            line-height: 1.6;
        }

        .info-card {
            background: #ffffff;
            border-radius: 14px;
            padding: 22px 26px;
            border: 1px solid #eee;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.05);
        }

        .divider {
            border-top: 1px solid #e5e5e5;
            margin: 32px 0;
        }

        /* ==== GALLERY ==== */
        .gallery-img {
            height: 140px;
            border-radius: 12px;
            object-fit: cover;
            transition: 0.15s ease-in-out;
            border: 1px solid #e8e8e8;
        }

        .gallery-img:hover {
            <div class="container py-5" style="margin-top:32px;">box-shadow: 0 6px 14px rgba(0, 0, 0, 0.12);
        }

        /* ==== BUTTON ==== */
        .btn-primary {
            background: #1f5eff;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1.05rem;
        }

        .btn-primary:hover {
            background: #1546c1;
        }
    </style>

    <!-- HERO BANNER -->
    @include('components.rentalmobil', ['car' => $car])

    <div class="container py-5" style="margin-top:130px;">

        {{-- GALLERY --}}
        <div class="info-card mb-4">
            <h4 class="section-title">Gallery</h4>
            <div class="row mt-3">
                @foreach ($car['images'] as $img)
                    <div class="col-md-2 col-4 mb-3">
                        <img src="{{ asset($img) }}" class="img-fluid gallery-img">
                    </div>
                @endforeach
            </div>
        </div>

        {{-- CAR DETAILS --}}
        <div class="info-card mb-4">
            <h4 class="section-title">{{ $car['name'] }}</h4>
            <p class="info-text">{{ $car['description'] }}</p>
        </div>

        {{-- FEATURES --}}
        <div class="info-card mb-4">
            <h4 class="section-title">Car Features</h4>
            <ul class="info-text">
                @foreach ($car['features'] as $f)
                    <li>{{ $f }}</li>
                @endforeach
            </ul>
        </div>

        {{-- TERMS --}}
        <div class="info-card mb-4">
            <h4 class="section-title">Terms & Conditions</h4>
            <ul class="info-text">
                @foreach ($car['rules'] as $r)
                    <li>{{ $r }}</li>
                @endforeach
            </ul>
        </div>

        {{-- PRICING --}}
        <div class="info-card mb-4">
            <h4 class="section-title">Rental Pricing</h4>

            <div class="d-flex justify-content-between align-items-center mt-2">
                <span class="info-text">Full Day (12 Hours)</span>
                <strong class="text-dark">Rp {{ number_format($car['price_full'], 0, ',', '.') }}</strong>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-2">
                <span class="info-text">Half Day (6 Hours)</span>
                <strong class="text-dark">Rp {{ number_format($car['price_half'], 0, ',', '.') }}</strong>
            </div>
        </div>

        {{-- BUTTON --}}
        <a href="{{ route('cars.form', $car['id']) }}" class="btn btn-primary w-100 mt-4">
            Continue
        </a>

    </div>

@endsection
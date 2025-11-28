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
            letter-spacing: 0.5px;
        }

        .info-text {
            font-size: 1rem;
            color: #555;
            line-height: 1.7;
        }

        .info-card {
            background: linear-gradient(90deg, #f8fafc 80%, #e3e8ff 100%);
            border-radius: 18px;
            padding: 28px 32px;
            border: none;
            box-shadow: 0 6px 24px rgba(31, 94, 255, 0.08);
            transition: box-shadow 0.3s, transform 0.3s;
        }

        .info-card:hover {
            box-shadow: 0 12px 32px rgba(31, 94, 255, 0.15);
            transform: translateY(-2px) scale(1.01);
        }

        .divider {
            border-top: 1px solid #e5e5e5;
            margin: 32px 0;
        }

        /* ==== GALLERY ==== */
        .gallery-img {
            height: 140px;
            border-radius: 16px;
            object-fit: cover;
            transition: 0.25s cubic-bezier(.4, 2, .3, 1);
            border: 2px solid #e8e8e8;
            box-shadow: 0 2px 8px rgba(31, 94, 255, 0.07);
        }

        .gallery-img:hover {
            box-shadow: 0 8px 24px rgba(31, 94, 255, 0.18);
            border-color: #1f5eff;
            transform: scale(1.07) rotate(-2deg);
        }

        .feature-list li {
            margin-bottom: 8px;
            padding-left: 24px;
            position: relative;
            transition: color 0.2s;
        }

        .feature-list li:before {
            content: '\2714';
            position: absolute;
            left: 0;
            color: #1f5eff;
            font-size: 1.1em;
        }

        .feature-list li:hover {
            color: #1546c1;
        }

        .rule-list li {
            margin-bottom: 8px;
            padding-left: 24px;
            position: relative;
        }

        .rule-list li:before {
            content: '\26A0';
            position: absolute;
            left: 0;
            color: #ffb300;
            font-size: 1.1em;
        }

        .pricing-card {
            background: linear-gradient(90deg, #e3e8ff 60%, #f8fafc 100%);
            border-radius: 16px;
            padding: 18px 24px;
            box-shadow: 0 2px 12px rgba(31, 94, 255, 0.09);
            margin-bottom: 18px;
            border: none;
        }

        .pricing-card .price-label {
            font-weight: 600;
            color: #1f5eff;
            font-size: 1.08rem;
        }

        .pricing-card .price-value {
            font-size: 1.18rem;
            font-weight: 700;
            color: #1546c1;
        }

        /* ==== BUTTON ==== */
        .btn-primary {
            background: linear-gradient(90deg, #1f5eff 60%, #1546c1 100%);
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1.08rem;
            box-shadow: 0 2px 8px rgba(31, 94, 255, 0.09);
            transition: background 0.3s, transform 0.2s;
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, #1546c1 60%, #1f5eff 100%);
            transform: scale(1.04);
        }

        .icon-title {
            font-size: 1.5em;
            vertical-align: middle;
            margin-right: 8px;
            color: #1f5eff;
        }
    </style>

    <!-- HERO BANNER -->
    @include('components.rentalmobil', ['car' => $car])

    <div class="container py-5" style="margin-top:40px;">
        <div class="info-card mb-4" style="margin-top:0;">
            <h4 class="section-title"><span class="icon-title"><i class="bi bi-images"></i></span>Gallery</h4>
            <div class="row mt-3">
                @foreach ($car['images'] as $img)
                    <div class="col-md-2 col-4 mb-3">
                        <img src="{{ asset($img) }}" class="img-fluid gallery-img" loading="lazy">
                    </div>
                @endforeach
            </div>
        </div>
        <div class="info-card mb-4" style="margin-top:0;">
            <h4 class="section-title"><span class="icon-title"><i class="bi bi-car-front"></i></span>{{ $car['name'] }}</h4>
            <p class="info-text">{{ $car['description'] }}</p>
        </div>
        <div class="info-card mb-4" style="margin-top:0;">
            <h4 class="section-title"><span class="icon-title"><i class="bi bi-stars"></i></span>Car Features</h4>
            <ul class="info-text feature-list">
                @foreach ($car['features'] as $f)
                    <li>{{ $f }}</li>
                @endforeach
            </ul>
        </div>
        <div class="info-card mb-4" style="margin-top:0;">
            <h4 class="section-title"><span class="icon-title"><i class="bi bi-exclamation-triangle"></i></span>Terms &
                Conditions</h4>
            <ul class="info-text rule-list">
                @foreach ($car['rules'] as $r)
                    <li>{{ $r }}</li>
                @endforeach
            </ul>
        </div>
        <div class="pricing-card" style="margin-top:0;">
            <div class="d-flex justify-content-between align-items-center mt-2">
                <span class="price-label">Full Day (12 Hours)</span>
                <span class="price-value">Rp {{ number_format($car['price_full'], 0, ',', '.') }}</span>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-2">
                <span class="price-label">Half Day (6 Hours)</span>
                <span class="price-value">Rp {{ number_format($car['price_half'], 0, ',', '.') }}</span>
            </div>
        </div>

        <a href="{{ route('cars.mobil.checkout', ['id' => $car['id']]) }}" class="btn btn-primary w-100 mt-4">
            <i class="bi bi-arrow-right-circle me-2"></i>Continue
        </a>
    </div>

    <script>
        // Gallery animation on hover
        document.querySelectorAll('.gallery-img').forEach(function (img) {
            img.addEventListener('mouseenter', function () {
                img.style.filter = 'brightness(1.08)';
            });
            img.addEventListener('mouseleave', function () {
                img.style.filter = '';
            });
        });
        // Animate button on click
        document.querySelectorAll('.btn-primary').forEach(function (btn) {
            btn.addEventListener('mousedown', function () {
                btn.style.transform = 'scale(0.97)';
            });
            btn.addEventListener('mouseup', function () {
                btn.style.transform = '';
            });
        });
    </script>
@endsection
@extends('layouts.app')
@section('title', ($car->title ?? 'Car Details') . ' | Travio')

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
            padding: 32px 36px;
            border: none;
            box-shadow: 0 6px 24px rgba(31, 94, 255, 0.08);
            transition: box-shadow 0.3s, transform 0.3s;
            margin-bottom: 24px;
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
            height: 200px;
            width: 100%;
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
            padding: 24px 28px;
            box-shadow: 0 2px 12px rgba(31, 94, 255, 0.09);
            margin-bottom: 20px;
            border: none;
            transition: box-shadow 0.3s, transform 0.2s;
        }

        .pricing-card:hover {
            box-shadow: 0 8px 20px rgba(31, 94, 255, 0.15);
            transform: translateY(-2px);
        }

        .price-label {
            font-weight: 600;
            color: #1f5eff;
            font-size: 1.08rem;
        }

        .price-value {
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

        .info-item {
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .gallery-modal .modal-dialog {
            max-width: 90vw;
        }

        .carousel-control-prev,
        .carousel-control-next {
            background: rgba(0, 0, 0, 0.3);
            width: 5%;
            border-radius: 8px;
        }
    </style>

    @include('components.car', ['car' => $car])

    <div class="container py-5 px-8 sm:px-12 lg:px-16" style="margin-top:40px; max-width: 1400px;">

        <!-- GALLERY PHOTOS -->
        @php
            $galleryImages = [];

            // Add main car image
            if ($car->image) {
                $galleryImages[] = ['src' => $car->image, 'alt' => $car->title . ' - Exterior'];
            }

            // Add interior image
            if ($car->interior_image) {
                $galleryImages[] = ['src' => $car->interior_image, 'alt' => $car->title . ' - Interior'];
            }

            // Add gallery images
            if ($car->gallery_images && is_array($car->gallery_images)) {
                foreach ($car->gallery_images as $image) {
                    if ($image) {
                        $galleryImages[] = ['src' => $image, 'alt' => $car->title . ' - Gallery'];
                    }
                }
            }
        @endphp

        @if(count($galleryImages) > 0)
            <div class="info-card mb-4" style="margin-top:0;">
                <h4 class="section-title"><span class="icon-title"><i class="bi bi-images"></i></span>Car Gallery</h4>
                <div class="row g-3">
                    @foreach(array_slice($galleryImages, 0, 4) as $index => $image)
                        <div class="col-md-6 col-lg-3">
                            <img src="{{ asset($image['src']) }}" class="gallery-img" alt="{{ $image['alt'] }}"
                                data-bs-toggle="modal" data-bs-target="#galleryModal" data-bs-slide-to="{{ $index }}"
                                style="cursor: pointer;">
                        </div>
                    @endforeach
                </div>
                @if(count($galleryImages) > 4)
                    <div class="text-center mt-3">
                        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#galleryModal">
                            <i class="bi bi-plus-circle me-2"></i>View All {{ count($galleryImages) }} Photos
                        </button>
                    </div>
                @endif
            </div>
        @endif

        <!-- CAR DETAILS INFO -->
        <div class="info-card mb-4">
            <h4 class="section-title"><span class="icon-title"><i class="bi bi-car-front-fill"></i></span>Car Information
            </h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="info-item mb-3">
                        <strong>Brand & Model:</strong> {{ $car->brand }} {{ $car->model }} ({{ $car->year }})
                    </div>
                    <div class="info-item mb-3">
                        <strong>License Plate:</strong> {{ $car->license_plate ?? 'N/A' }}
                    </div>
                    <div class="info-item mb-3">
                        <strong>Transmission:</strong> {{ $car->transmission }}
                    </div>
                    <div class="info-item mb-3">
                        <strong>Fuel Type:</strong> {{ $car->fuel_type }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-item mb-3">
                        <strong>Capacity:</strong> {{ $car->capacity }} passengers
                    </div>
                    <div class="info-item mb-3">
                        <strong>Color:</strong> {{ $car->color }}
                    </div>
                    <div class="info-item mb-3">
                        <strong>Location:</strong> {{ $car->location ?? 'Makassar, Indonesia' }}
                    </div>
                    <div class="info-item mb-3">
                        <strong>Daily Rate:</strong> <span class="text-primary fw-bold">Rp
                            {{ number_format($car->price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- FACILITIES -->
        @if($car->facilities && count($car->facilities) > 0)
            <div class="info-card mb-4" style="margin-top:0;">
                <h4 class="section-title"><span class="icon-title"><i class="bi bi-stars"></i></span>Car Features</h4>
                <ul class="info-text feature-list">
                    @foreach($car->facilities as $facility)
                        @if(trim($facility))
                            <li>{{ trim($facility) }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- CAR DESCRIPTION -->
        <div class="info-card mb-4" style="margin-top:0;">
            <h4 class="section-title"><span class="icon-title"><i class="bi bi-car-front"></i></span>{{ $car->title }}</h4>
            <p class="info-text">{{ $car->description }}</p>
        </div>

        <!-- PRICING -->
        <div class="info-card mb-4" style="margin-top:0;">
            <h4 class="section-title"><span class="icon-title"><i class="bi bi-currency-dollar"></i></span>Rental Pricing
            </h4>
            <div class="pricing-card">
                <div class="d-flex justify-content-between align-items-center mt-2">
                    <span class="price-label">Base Price</span>
                    <span class="price-value">Rp {{ number_format($car->price, 0, ',', '.') }}</span>
                </div>
                <small class="text-muted">per day (additional driver fee: +Rp 100,000/day)</small>
            </div>
        </div>

        <!-- BOOKING SECTION -->
        <div class="info-card mb-4" style="margin-top:0;">
            <h4 class="section-title"><span class="icon-title"><i class="bi bi-calendar-check"></i></span>Book This Car</h4>
            <div class="text-center">
                @auth
                    <a href="{{ route('car.booking.create', $car->id) }}" class="btn btn-primary px-5 py-3">
                        <i class="bi bi-arrow-right-circle me-2"></i>Book Now
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary px-5 py-3">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Login to Book
                    </a>
                @endauth
            </div>
        </div>

        <!-- TERMS & CONDITIONS -->
        @if($car->terms_conditions && is_array($car->terms_conditions) && count($car->terms_conditions) > 0)
            <div class="info-card mb-4">
                <h4 class="section-title"><span class="icon-title"><i class="bi bi-exclamation-triangle"></i></span>Terms &
                    Conditions</h4>
                <ul class="info-text rule-list">
                    @foreach($car->terms_conditions as $term)
                        @if(trim($term))
                            <li>{{ trim($term) }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
        @endif

        <a href="{{ route('cars.index') }}" class="btn btn-outline-primary">
            <i class="bi bi-arrow-left me-2"></i>Back to Cars
        </a>
    </div>

    <!-- Gallery Modal -->
    @if(count($galleryImages) > 0)
        <div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="galleryModalLabel">{{ $car->title }} - Gallery</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div id="galleryCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($galleryImages as $index => $image)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ asset($image['src']) }}" class="d-block w-100" alt="{{ $image['alt'] }}"
                                            style="height: 400px; object-fit: cover;">
                                    </div>
                                @endforeach
                            </div>
                            @if(count($galleryImages) > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

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
@extends('layouts.app')
@section('title', $hotelDetail ? $hotelDetail->nama : 'Hotel Detail')

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

        .room-card {
            background: linear-gradient(90deg, #e3e8ff 60%, #f8fafc 100%);
            border-radius: 16px;
            padding: 18px 24px;
            box-shadow: 0 2px 12px rgba(31, 94, 255, 0.09);
            margin-bottom: 18px;
            border: none;
            transition: box-shadow 0.3s, transform 0.2s;
        }

        .room-card:hover {
            box-shadow: 0 8px 20px rgba(31, 94, 255, 0.15);
            transform: translateY(-2px);
        }

        .room-name {
            font-weight: 600;
            color: #1f5eff;
            font-size: 1.08rem;
        }

        .room-price {
            font-size: 1.18rem;
            font-weight: 700;
            color: #1546c1;
        }

        .room-img {
            height: 120px;
            border-radius: 12px;
            object-fit: cover;
            border: 2px solid #e8e8e8;
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

    @include('components.hotel', ['hotel' => $hotel])

    <div class="container py-5" style="margin-top:40px;">
        <!-- GALLERY -->
        @php
            $galleryImages = [];

            // Add header image (either from hotelDetail or hotel)
            if ($hotelDetail && $hotelDetail->headerImage) {
                $galleryImages[] = ['src' => $hotelDetail->headerImage, 'alt' => 'Hotel Exterior'];
            } elseif ($hotel && $hotel->image) {
                $galleryImages[] = ['src' => $hotel->image, 'alt' => 'Hotel Exterior'];
            }

            // Add interior image if available
            if ($hotelDetail && $hotelDetail->interiorImage && count($galleryImages) < 4) {
                $galleryImages[] = ['src' => $hotelDetail->interiorImage, 'alt' => 'Hotel Interior'];
            }

            // Add room images (fill remaining slots up to 4 total)
            $remainingSlots = 4 - count($galleryImages);
            if ($remainingSlots > 0) {
                foreach ($hotelRooms->take($remainingSlots) as $room) {
                    if ($room->image) {
                        $galleryImages[] = ['src' => $room->image, 'alt' => $room->name];
                    }
                }
            }
        @endphp

        @if(count($galleryImages) > 0)
            <div class="info-card mb-4" style="margin-top:0;">
                <h4 class="section-title"><span class="icon-title"><i class="bi bi-images"></i></span>Gallery</h4>
                <div class="row mt-3">
                    @foreach($galleryImages as $index => $image)
                        <div
                            class="col-md-{{ count($galleryImages) <= 2 ? '6' : (count($galleryImages) == 3 ? '4' : '3') }} col-6 mb-3">
                            <img src="{{ asset($image['src']) }}" class="img-fluid gallery-img" loading="lazy"
                                alt="{{ $image['alt'] }}">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- HOTEL INFO -->
        <div class="info-card mb-4" style="margin-top:0;">
            <h4 class="section-title"><span class="icon-title"><i
                        class="bi bi-building"></i></span>{{ $hotelDetail ? $hotelDetail->nama : $hotel->title }}</h4>
            <p class="info-text"><strong><i class="bi bi-geo-alt text-primary"></i>
                    Location:</strong><br>{{ $hotelDetail ? $hotelDetail->location : $hotel->location }}</p>
            <p class="info-text">{{ $hotelDetail ? $hotelDetail->description : $hotel->description }}</p>
        </div>

        <!-- FACILITIES -->
        @if($hotelDetail && $hotelDetail->facilities)
            @php
                $facilities = [];
                if (is_array($hotelDetail->facilities)) {
                    $facilities = $hotelDetail->facilities;
                } elseif (is_string($hotelDetail->facilities)) {
                    $decoded = json_decode($hotelDetail->facilities, true);
                    if (is_array($decoded)) {
                        $facilities = $decoded;
                    } else {
                        $facilities = explode(',', $hotelDetail->facilities);
                    }
                }
            @endphp
            @if(count($facilities) > 0)
                <div class="info-card mb-4" style="margin-top:0;">
                    <h4 class="section-title"><span class="icon-title"><i class="bi bi-stars"></i></span>Hotel Facilities</h4>
                    <ul class="info-text feature-list">
                        @foreach($facilities as $facility)
                            @if(trim($facility))
                                <li>{{ trim($facility) }}</li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endif
        @endif

        <!-- TERMS & CONDITIONS -->
        @if($hotelDetail && $hotelDetail->syaratKetentuan)
            @php
                $terms = [];
                if (is_array($hotelDetail->syaratKetentuan)) {
                    $terms = $hotelDetail->syaratKetentuan;
                } elseif (is_string($hotelDetail->syaratKetentuan)) {
                    $decoded = json_decode($hotelDetail->syaratKetentuan, true);
                    if (is_array($decoded)) {
                        $terms = $decoded;
                    } else {
                        $terms = explode("\n", $hotelDetail->syaratKetentuan);
                    }
                }
            @endphp
            @if(count($terms) > 0)
                <div class="info-card mb-4" style="margin-top:0;">
                    <h4 class="section-title"><span class="icon-title"><i class="bi bi-exclamation-triangle"></i></span>Terms &
                        Conditions</h4>
                    <ul class="info-text rule-list">
                        @foreach($terms as $term)
                            @if(trim($term))
                                <li>{{ trim($term) }}</li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endif
        @endif

        <!-- ROOM SELECTION -->
        <div class="info-card mb-4" style="margin-top:0;">
            <h4 class="section-title"><span class="icon-title"><i class="bi bi-door-closed"></i></span>Available Rooms</h4>
            @forelse($hotelRooms as $room)
                <div class="room-card">
                    <div class="row align-items-center">
                        @if($room->image)
                            <div class="col-md-3">
                                <img src="{{ asset($room->image) }}" class="img-fluid room-img w-100" alt="{{ $room->name }}">
                            </div>
                        @endif
                        <div class="col-md-{{ $room->image ? '6' : '9' }}">
                            <div class="room-name">{{ $room->name }}</div>
                            @if($room->description)
                                <p class="info-text mb-2">{{ $room->description }}</p>
                            @endif
                            @if($room->facilities)
                                @php
                                    $roomFacilities = [];
                                    if (is_array($room->facilities)) {
                                        $roomFacilities = $room->facilities;
                                    } elseif (is_string($room->facilities)) {
                                        $decoded = json_decode($room->facilities, true);
                                        if (is_array($decoded)) {
                                            $roomFacilities = $decoded;
                                        } else {
                                            $roomFacilities = explode(',', $room->facilities);
                                        }
                                    }
                                @endphp
                                @if(count($roomFacilities) > 0)
                                    <div class="small text-muted mb-2">
                                        <strong>Facilities:</strong>
                                        {{ implode(', ', array_map('trim', $roomFacilities)) }}
                                    </div>
                                @endif
                            @endif
                            @if($room->max_guest)
                                <div class="small text-muted">
                                    <i class="bi bi-person"></i> Max {{ $room->max_guest }} guest(s)
                                </div>
                            @endif
                        </div>
                        <div class="col-md-3 text-end">
                            <div class="room-price">Rp {{ number_format($room->price, 0, ',', '.') }}</div>
                            <small class="text-muted d-block mb-2">per night</small>
                            <a href="{{ route('checkout.hotel') }}?room_id={{ $room->id }}" class="btn btn-primary btn-sm">Book
                                Now</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-4">
                    <p class="info-text">No rooms available at the moment.</p>
                </div>
            @endforelse
        </div>

        <a href="{{ route('hotels.index') }}" class="btn btn-outline-primary">
            <i class="bi bi-arrow-left me-2"></i>Back to Hotels
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
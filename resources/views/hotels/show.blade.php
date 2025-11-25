@extends('layouts.app')

@section('title', 'Hotel Detail')

@section('content')
    @php
        $hideNavbar = true; // sembunyikan navbar jika diperlukan
        $activeTab = $activeTab ?? 'details';
    @endphp

    <style>
        .room-card {
            border-radius: 15px;
            border: 1px solid #e6e6e6;
            overflow: hidden;
            background: #fff;
            transition: 0.2s ease-in-out;
        }

        .room-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .room-card img {
            width: 100%;
            height: 175px;
            /* semua gambar sama */
            object-fit: cover;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/hotel-info-card.css') }}">

    <div class="position-relative">
        <div class="hotel-info-card mx-auto"
            style="position: absolute; left: 0; right: 0; margin: auto; top: 320px; z-index: 10;">
            <h5 class="fw-bold mb-3">{{ $hotel['name'] }}</h5>
            <form method="GET" action="" class="row g-3 align-items-center">
                <div class="col-md-5">
                    <label for="checkin" class="form-label mb-1"><i class="bi bi-calendar-event"></i> Check-in</label>
                    <input type="date" class="form-control" id="checkin" name="checkin"
                        value="{{ request('checkin') ?? date('Y-m-d') }}">
                </div>
                <div class="col-md-5">
                    <label for="checkout" class="form-label mb-1"><i class="bi bi-calendar-event"></i> Check-out</label>
                    <input type="date" class="form-control" id="checkout" name="checkout"
                        value="{{ request('checkout') ?? date('Y-m-d', strtotime('+2 days')) }}">
                </div>
                <div class="w-100"></div>
                <div class="col-md-3">
                    <label for="adults" class="form-label mb-1"><i class="bi bi-person"></i> Adults</label>
                    <input type="number" min="1" class="form-control" id="adults" name="adults"
                        value="{{ request('adults') ?? 1 }}">
                </div>
                <div class="col-md-3">
                    <label for="children" class="form-label mb-1"><i class="bi bi-person"></i> Children</label>
                    <input type="number" min="0" class="form-control" id="children" name="children"
                        value="{{ request('children') ?? 0 }}">
                </div>
                <div class="col-md-3">
                    <label for="rooms" class="form-label mb-1"><i class="bi bi-door-closed"></i> Room</label>
                    <input type="number" min="1" class="form-control" id="rooms" name="rooms"
                        value="{{ request('rooms') ?? 1 }}">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Update</button>
                </div>
            </form>
        </div>
        @include('components.hotel', ['userName' => $user->name ?? 'User'])
    </div>

    <div class="container py-4" style="margin-top:120px;">
        <!-- IMAGES -->
        <div class="row mb-4 mt-5 pt-5">
            @foreach ($hotel['images'] as $img)
                <div class="col-md-2 mb-3">
                    <img src="{{ asset($img) }}" class="img-fluid rounded" style="height:140px;object-fit:cover;">
                </div>
            @endforeach
        </div>

        <h4 class="fw-bold mt-4 mb-2">{{ $hotel['name'] }}</h4>
        <p><strong>Location</strong><br>{{ $hotel['location'] }}</p>
        <p><strong>About {{ $hotel['name'] }}</strong><br>{{ $hotel['description'] }}</p>
        <hr>
        <!-- ROOM OPTIONS -->
        <h4 class="fw-bold mb-3">Available Rooms</h4>
        <div class="row g-4">
            @foreach ($rooms as $room)
                <div class="col-md-4 mb-4">
                    <div class="room-card shadow-sm">
                        <img src="{{ asset($room['image']) }}" class="img-fluid">

                        <div class="p-3">
                            <h6 class="fw-bold">{{ $room['name'] }}</h6>
                            <p class="text-muted mb-1">{{ $room['bed'] }}</p>
                            <p class="small mb-1"><i class="bi bi-check-circle text-success"></i> {{ $room['policy'] }}</p>
                            <p class="small mb-1"><i class="bi bi-award text-primary"></i> {{ $room['benefit'] }}</p>
                            <p class="small mb-1"><i class="bi bi-credit-card text-warning"></i> {{ $room['pay_type'] }}</p>

                            <h5 class="fw-bold mt-2">{{ $room['price'] }}</h5>

                            <button class="btn btn-primary w-100 mt-2">Choose</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <hr>
        <!-- FACILITIES -->
        <h4 class="fw-bold mb-3">Facilities</h4>
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="facility-title">Public Facilities</div>
                <ul class="facility-list">
                    @foreach ($facilities['public'] as $f)
                        <li>{{ $f }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-3 mb-3">
                <div class="facility-title">Hotel Services</div>
                <ul class="facility-list">
                    @foreach ($facilities['services'] as $f)
                        <li>{{ $f }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-3 mb-3">
                <div class="facility-title">Nearby Services</div>
                <ul class="facility-list">
                    @foreach ($facilities['nearby'] as $f)
                        <li>{{ $f }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-3 mb-3">
                <div class="facility-title">In-room Facilities</div>
                <ul class="facility-list">
                    @foreach ($facilities['inroom'] as $f)
                        <li>{{ $f }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

@endsection
@extends('layouts.app')

@section('title', 'Package Details | Travio')

@section('content')
    @php
        $hideNavbar = true; // sembunyikan navbar jika diperlukan
        $activeTab = $activeTab ?? 'details';
    @endphp
    @include('components.seead')

    <section class="py-5" style="background:#fff;">
        <div class="container">

            <div class="row g-4">
                {{-- Image Section --}}
                <div class="col-12 col-md-6">
                    <img src="{{ $package->image }}" class="img-fluid rounded-3 shadow-sm"
                        style="width:100%; height:350px; object-fit:cover;">
                </div>

                {{-- Detail Section --}}
                <div class="col-12 col-md-6">
                    <h2 class="fw-bold mb-2">{{ $package->title }}</h2>

                    <p class="text-muted mb-3">
                        {{ $package->description }}
                    </p>

                    <h4 class="fw-bold text-primary">Rp {{ number_format($package->price, 0, ',', '.') }} / person</h4>
                    <p class="text-muted small mb-3">Include {{ $package->include }}</p>
                    <div class="mb-3">
                        <h6 class="fw-bold">Facilities Included:</h6>
                        <ul class="small text-muted">
                            @foreach($package->facilities as $facility)
                                <li>{{ $facility }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="mt-4">
                        <a href="#" class="btn btn-primary w-100 rounded-3 py-2">
                            Book Now
                        </a>
                    </div>
                </div>
            </div>

            {{-- Itinerary --}}
            <div class="mt-5">
                <h4 class="fw-bold mb-3">Itinerary</h4>
                <div class="bg-light p-3 rounded-3 shadow-sm">
                    @foreach($package['itinerary'] as $item)
                        <p class="mb-1">{{ $item }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
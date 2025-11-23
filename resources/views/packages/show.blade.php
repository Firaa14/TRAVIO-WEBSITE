@extends('layouts.app')

@section('title', 'Package Details | Travio')

@section('content')
    @include('components.seead')

    <section class="py-5" style="background:#fff;">
        <div class="container">
            <a href="{{ route('packages.index') }}" class="btn btn-outline-secondary mb-3">&larr; Back to Packages</a>

            <div class="row g-4">
                {{-- Image Section --}}
                <div class="col-12 col-md-6">
                    <img src="{{ asset('photos/package' . $id . '.jpg') }}" class="img-fluid rounded-3 shadow-sm"
                        style="width:100%; height:350px; object-fit:cover;">
                </div>

                {{-- Detail Section --}}
                <div class="col-12 col-md-6">
                    <h2 class="fw-bold mb-2">Package #{{ $id }}</h2>

                    <p class="text-muted mb-3">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti corporis doloremque
                        incidunt, voluptate nemo quia impedit nobis! Atque natus totam nostrum recusandae voluptas non.
                    </p>

                    <h4 class="fw-bold text-primary">Rp 1.200.000 / person</h4>
                    <p class="text-muted small mb-3">Include Transportation & Meals</p>

                    <div class="mb-3">
                        <h6 class="fw-bold">Facilities Included:</h6>
                        <ul class="small text-muted">
                            <li>Hotel / Homestay</li>
                            <li>Transport & Jeep (if required)</li>
                            <li>Breakfast, Lunch, Dinner</li>
                            <li>Tour Guide</li>
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
                    <p class="mb-1"><strong>Day 1:</strong> Pick up, check in, sightseeing tour</p>
                    <p class="mb-1"><strong>Day 2:</strong> Main attractions and activities</p>
                    <p class="mb-1"><strong>Day 3:</strong> Free time and return trip</p>
                </div>
            </div>
        </div>
    </section>
@endsection
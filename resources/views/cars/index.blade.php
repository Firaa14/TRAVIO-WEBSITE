@extends('layouts.app')

@section('title', 'All Cars | Travio')

@section('content')
    @include('components.seead')
    @php
        $hideNavbar = true;
        $activeTab = $activeTab ?? 'details';
    @endphp

    {{-- === Search Section === --}}
    <section class="search-section py-4" style="background:#fff;">
        <div class="container text-center">
            <form class="row g-3 justify-content-center align-items-center">
                <div class="col-auto">
                    <label class="form-label fw-semibold">Pick Your Rental Dates:</label>
                </div>
                <div class="col-auto"><input type="date" class="form-control"></div>
                <div class="col-auto"><input type="date" class="form-control"></div>
                <div class="col-auto"><label class="form-label fw-semibold">Passengers</label></div>
                <div class="col-auto">
                    <input type="number" class="form-control" name="passenger" min="1" max="12"
                        placeholder="Jumlah Penumpang">
                </div>
                <div class="col-auto"><button class="btn btn-primary px-4">Search</button></div>
            </form>
        </div>
    </section>

    {{-- === Filter Section === --}}
    <section class="filter-section py-3" style="background:#fff;">
        <div class="container text-center">
            <span class="fw-semibold me-3">Filter:</span>
            <select class="form-select d-inline-block w-auto me-2">
                <option>Transmission</option>
                <option>Manual</option>
                <option>Automatic</option>
            </select>
            <select class="form-select d-inline-block w-auto me-2">
                <option>Car Type</option>
                <option>Family Car</option>
                <option>SUV</option>
                <option>City Car</option>
            </select>
            <select class="form-select d-inline-block w-auto">
                <option>Price Range</option>
                <option>Under 300K</option>
                <option>300K - 600K</option>
                <option>600K+</option>
            </select>
        </div>
    </section>

    <section class="section-padding section-white mt-0" style="background:#fff;">
        <div class="container px-8 sm:px-12 lg:px-16" style="max-width: 1200px;">
            <h2 class="fw-bold text-center mb-6">Car Rental</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"
                style="background:#fff; border-radius:1rem; padding:2rem;">
                @foreach($cars as $car)
                    <div class="fade-up">
                        <div class="card h-100 shadow-sm hotel-card overflow-hidden" style="width:100%; border-radius:1rem;">
                            <img src="{{ asset($car->image) }}" class="card-img-top" alt="{{ $car->title }}"
                                style="height:220px; object-fit:cover; width:100%; border-top-left-radius:1rem; border-top-right-radius:1rem;">
                            <div class="card-body p-4">
                                <h5 class="card-title fw-bold mb-2 text-center">{{ $car->title }}</h5>
                                <p class="mb-3 text-center" style="color:#666; font-size:0.95rem; min-height:40px;">
                                    {{ Str::limit($car->description, 75) }}
                                </p>
                                <div class="mb-3 d-flex flex-wrap gap-2 justify-content-center">
                                    @if($car->facilities)
                                        @foreach($car->facilities as $facility)
                                            <span class="badge bg-secondary" style="font-size:0.75rem;">{{ $facility }}</span>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="text-center mb-3">
                                    <div class="fw-bold mb-0" style="font-size:1.1rem; color:#12395D;">
                                        Rp {{ number_format($car->price, 0, ',', '.') }}
                                    </div>
                                    <small class="text-muted">per day</small>
                                </div>
                                <div class="mt-auto">
                                    <a href="{{ route('cars.show', $car->id) }}"
                                        class="btn btn-outline-primary btn-sm w-100 rounded-3 py-2">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- Pagination --}}
    @if($cars->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $cars->appends(request()->query())->links() }}
        </div>
    @endif

    <div class="text-center mt-3 mb-5">
        <p class="text-muted small mb-0">
            Showing {{ $cars->firstItem() ?: 0 }} to {{ $cars->lastItem() ?: 0 }}
            of {{ $cars->total() }} results
        </p>
    </div>

@endsection
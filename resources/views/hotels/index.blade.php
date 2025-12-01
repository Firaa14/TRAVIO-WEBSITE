@extends('layouts.app')

@section('title', 'All Hotels | Travio')

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
                    <label class="form-label fw-semibold">Check-in / Check-out:</label>
                </div>
                <div class="col-auto"><input type="date" class="form-control"></div>
                <div class="col-auto"><input type="date" class="form-control"></div>

                <div class="col-auto">
                    <label class="form-label fw-semibold">Guests</label>
                </div>
                <div class="col-auto">
                    <input type="number" class="form-control" name="guest" min="1" max="12" placeholder="Jumlah Tamu">
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
                <option>Hotel Type</option>
                <option>Resort</option>
                <option>Bintang 5</option>
                <option>Bintang 4</option>
                <option>Budget</option>
            </select>
            <select class="form-select d-inline-block w-auto me-2">
                <option>Room Type</option>
                <option>Deluxe</option>
                <option>Superior</option>
                <option>Presidential Suite</option>
            </select>
            <select class="form-select d-inline-block w-auto">
                <option>Price Range</option>
                <option>Under 1M</option>
                <option>1M - 2M</option>
                <option>2M+</option>
            </select>
        </div>
    </section>

    <section class="section-padding section-white mt-0" style="background:#fff;">
        <div class="container px-8 sm:px-12 lg:px-16" style="max-width: 1200px;">
            <h2 class="fw-bold text-center mb-6">Available Hotels</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"
                style="background:#fff; border-radius:1rem; padding:2rem;">
                @foreach($hotels as $hotel)
                    <div class="fade-up">
                        <div class="card h-100 shadow-sm hotel-card overflow-hidden" style="width:100%; border-radius:1rem;">
                            <img src="{{ asset($hotel->image) }}" class="card-img-top" alt="{{ $hotel->title }}"
                                style="height:220px; object-fit:cover; width:100%; border-top-left-radius:1rem; border-top-right-radius:1rem;">
                            <div class="card-body p-4">
                                <h5 class="card-title fw-bold mb-2 text-center">{{ $hotel->title }}</h5>
                                <p class="mb-3 text-center" style="color:#666; font-size:0.95rem; min-height:40px;">
                                    {{ Str::limit($hotel->description, 75) }}
                                </p>
                                <div class="mb-3 d-flex flex-wrap gap-2 justify-content-center">
                                    @foreach($hotel->facilities as $facility)
                                        <span class="badge bg-secondary" style="font-size:0.75rem;">{{ $facility }}</span>
                                    @endforeach
                                </div>
                                <div class="text-center mb-3">
                                    <div class="fw-bold mb-0" style="font-size:1.1rem; color:#12395D;">
                                        {{ $hotel->price }}
                                    </div>
                                    <small class="text-muted">per night</small>
                                </div>
                                <div class="mt-auto">
                                    <a href="{{ route('hotels.show', $hotel->id) }}"
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
    @if($hotels->hasPages())
        <div class="d-flex justify-content-center align-items-center mt-5">
            {{ $hotels->links() }}
        </div>
    @endif

    <div class="text-center mt-3 mb-5">
        <p class="text-muted small mb-0">
            Showing {{ $hotels->firstItem() ?: 0 }} to {{ $hotels->lastItem() ?: 0 }}
            of {{ $hotels->total() }} results
        </p>
    </div>

@endsection
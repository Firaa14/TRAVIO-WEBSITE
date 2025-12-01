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
        <div class="container">
            <h2 class="fw-bold text-center mb-4">Car Rent</h2>

            <div class="row g-4 justify-content-center" style="background:#fff; border-radius:0.75rem; padding:1rem 0;">
                @foreach($cars as $car)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center fade-up">
                        <div class="card h-100 shadow-sm hotel-card overflow-hidden"
                            style="max-width:370px; width:100%; border-radius:0.75rem;">
                            <img src="{{ asset($car->image) }}" class="card-img-top" alt="{{ $car->title }}"
                                style="height:220px; object-fit:cover; width:100%; border-top-left-radius:0.75rem; border-top-right-radius:0.75rem;">
                            <div class="card-body">
                                <h5 class="card-title fw-bold mb-1">{{ $car->title }}</h5>
                                <p class="mb-2" style="color:#666; font-size:0.97rem;">{{ $car->description }}</p>
                                <div class="mb-2 d-flex flex-wrap gap-2">
                                    @php
                                        $facilities = is_array($car->facilities) ? $car->facilities : json_decode($car->facilities, true);
                                    @endphp
                                    @foreach($facilities as $facility)
                                        <span class="badge bg-secondary">{{ $facility }}</span>
                                    @endforeach
                                </div>
                                <div class="fw-bold mb-0" style="font-size:1.1rem; color:#12395D;">Rp
                                    {{ number_format($car->price, 0, ',', '.') }},00
                                </div>
                                <small class="text-muted">per day</small>
                                <div class="mt-3">
                                    <a href="{{ route('cars.show', $car->id) }}"
                                        class="btn btn-outline-primary btn-sm w-100 rounded-2">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center align-items-center mt-5">
        <nav>
            <ul class="pagination mb-0">
                <li class="page-item disabled"><a class="page-link">&laquo;</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
            </ul>
        </nav>
    </div>
    <p class="text-center text-muted small mt-2">Showing 1 to 18 of 36 results</p>

@endsection
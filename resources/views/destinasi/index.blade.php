@extends('layouts.app')

@section('title', 'All Destinations | Travio')

@section('content')
    @include('components.seead')
    @php
        $hideNavbar = true; // sembunyikan navbar jika diperlukan
        $activeTab = $activeTab ?? 'details';
    @endphp

    {{-- === Search Section === --}}
    <section class="search-section py-4" style="background:#fff;">
        <div class="container text-center">
            <form class="row g-3 justify-content-center align-items-center">
                <div class="col-auto">
                    <label class="form-label fw-semibold">Pick Your Travel Dates:</label>
                </div>
                <div class="col-auto">
                    <input type="date" class="form-control" value="2025-11-10">
                </div>
                <div class="col-auto">
                    <input type="date" class="form-control" value="2025-11-12">
                </div>
                <div class="col-auto">
                    <label class="form-label fw-semibold">Passenger</label>
                </div>
                <div class="col-auto">
                    <input type="number" class="form-control" name="passenger" min="1" max="99"
                        placeholder="Jumlah Penumpang">
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary px-4">Search</button>
                </div>
            </form>
        </div>
    </section>

    {{-- === Filter Section === --}}
    <section class="filter-section py-3" style="background:#fff;">
        <div class="container text-center">
            <span class="fw-semibold me-3">Filter:</span>
            <select class="form-select d-inline-block w-auto me-2">
                <option>Tour Theme</option>
                <option>Nature</option>
                <option>Culture</option>
                <option>Family</option>
            </select>
            <select class="form-select d-inline-block w-auto me-2">
                <option>Package Type</option>
                <option>One Day</option>
                <option>Weekend</option>
            </select>
            <select class="form-select d-inline-block w-auto">
                <option>Trip Duration</option>
                <option>1 Day</option>
                <option>2 Days</option>
                <option>3+ Days</option>
            </select>
        </div>
    </section>

    {{-- === Destination Grid (New Size and Centered) === --}}
    <section class="destinations py-5">
        <div class="container">
            <div class="text-center mb-4">
            </div>

            <div class="d-flex justify-content-center">
                <div class="row justify-content-center g-4" style="max-width: 1600px;">
                    @foreach ($destinations as $destination)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center">
                            <div class="card shadow-sm border-0 rounded-4 overflow-hidden" style="width:340px;">
                                <img src="{{ asset('photos/' . $destination->image) }}" class="card-img-top"
                                    style="height:230px; object-fit:cover;">
                                <div class="card-body">
                                    <h5 class="fw-bold mb-2 text-truncate">{{ $destination->name }}</h5>
                                    <p class="text-muted small" style="height:45px; overflow:hidden;">
                                        {{ $destination->description }}
                                    </p>
                                </div>
                                <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center">
                                    <span class="fw-semibold text-primary">Rp.
                                        {{ number_format($destination->price, 0, ',', '.') }}</span>
                                    <a href="{{ route('destination.show', $destination->id) }}"
                                        class="btn btn-outline-primary btn-sm">View</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

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
        </div>
    </section>

    <style>
        html,
        body {
            overflow-x: hidden !important;
            width: 100vw;
            box-sizing: border-box;
        }
    </style>

@endsection
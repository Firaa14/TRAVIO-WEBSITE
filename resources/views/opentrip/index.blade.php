@extends('layouts.app')
@section('title', 'Open Trip | Travio')


@section('content')
    @include('components.heroop')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">


    <div class="container py-5">
        <h2 class="mb-5 text-center" style="margin-top: -40px; font-size:1.3rem; font-weight:400;">
            Share your open trip stories, tips, or favorite moments here! Inspire others to join the adventure.
        </h2>
        <div class="row g-4">
            @foreach($trips as $trip)
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100">
                        <img src="{{ asset($trip['gambar']) }}" class="card-img-top" alt="{{ $trip['judul'] }}"
                            style="height: 220px; object-fit: cover; border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem;">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title">{{ $trip['judul'] }}</h5>
                                <p class="card-text text-muted small mb-1"><i class="bi bi-geo-alt"></i> {{ $trip['lokasi'] }}
                                </p>
                                <p class="card-text text-muted small mb-1"><i class="bi bi-calendar-event"></i>
                                    {{ $trip['tanggal'] }}</p>
                                <p class="fw-semibold text-primary mb-2">
                                    Rp{{ number_format($trip['harga'], 0, ',', '.') }}/person</p>
                                <p class="small text-secondary">{{ Str::limit($trip['deskripsi'], 70) }}</p>
                            </div>
                            <div class="mt-3">
                                <a href="#" class="btn btn-outline-primary w-100">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        html,
        body {
            overflow-x: hidden !important;
            width: 100vw;
            box-sizing: border-box;
        }
    </style>
@endsection
@extends('layouts.app')

@section('title', 'Destination Detail')

@section('content')
    <div class="container py-5">
        <h2 class="fw-bold mb-3">{{ $destination->name }}</h2>
        <img src="{{ asset('photos/' . $destination->image) }}" alt="{{ $destination->name }}" class="mb-4"
            style="max-width:400px; height:auto; border-radius:16px;">
        <p class="mb-3">{{ $destination->description }}</p>
        <div class="mb-3">
            <span class="fw-semibold text-primary">Rp. {{ number_format($destination->price, 0, ',', '.') }}</span>
        </div>
        {{-- Tambahkan detail lain seperti itinerary, dsb jika ada --}}
    </div>
@endsection
@extends('layouts.app')

@php($hideNavbar = true)

@section('title', 'Details | Travio')

@section('content')
    {{-- HERO SECTION --}}
    @include('components.herolanjutanpopulartourist')

    {{-- TAB CONTENT --}}
    <div class="container my-5">
        <div class="card shadow-lg border-0 rounded-4 p-4" id="details">
            <h4 class="fw-bold mb-3">Package Details</h4>
            <p class="mb-0">
                {{ $destination['details'] }}
            </p>
            <h5 class="fw-bold mt-4">Itinerary</h5>
            <ul>
                @foreach($destination['itinerary'] as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
            <h5 class="fw-bold mt-4">Price Details</h5>
            <ul>
                @foreach($destination['price_details'] as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
            <div class="text-end mt-4">
                <button class="btn btn-primary px-4">Continue</button>
            </div>
        </div>
    </div>
@endsection
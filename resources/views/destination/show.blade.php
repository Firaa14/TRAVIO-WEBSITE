@extends('layouts.app')

@section('content')
    @php
        $hideNavbar = true; // sembunyikan navbar jika diperlukan
        $activeTab = $activeTab ?? 'details';
    @endphp

    @include('components.herosectiondetail', ['userName' => $user->name ?? 'User'])

    {{-- HERO SECTION --}}
    <section class="hero-section" style="position:relative;">
        <video autoplay muted loop playsinline
            style="position:absolute;top:0;left:0;width:100%;height:100%;object-fit:cover;z-index:0;">
            <source src="/videos/travel.mp4" type="video/mp4">
        </video>
        <div class="hero-overlay"></div>
        <a href="{{
            request()->has('from') && request('from') == 'planning' ? route('planning') : route('dashboard')
        }}" class="position-absolute top-0 start-0 m-3 text-white fw-semibold text-decoration-none"
            style="z-index:10;">
            Back
        </a>
        <div class="hero-content">
            <h1 class="fw-bold display-5">Almost There!</h1>
            <p>One last step to secure your adventure with Travio.</p>
        </div>
    </section>

    {{-- SUBMENU / TABS --}}
    <nav class="tab-navigation">
        <a href="{{ route('destination.show', ['id' => $destination['id'], 'tab' => 'details']) }}"
            class="{{ $activeTab === 'details' ? 'active' : '' }}">Details</a>
        <a href="{{ route('destination.show', ['id' => $destination['id'], 'tab' => 'itinerary']) }}"
            class="{{ $activeTab === 'itinerary' ? 'active' : '' }}">Itinerary</a>
        <a href="{{ route('destination.show', ['id' => $destination['id'], 'tab' => 'price']) }}"
            class="{{ $activeTab === 'price' ? 'active' : '' }}">Price</a>
    </nav>

    {{-- CONTENT --}}
    <div class="container my-5">
        @if ($activeTab === 'details')
            @include('destination.details')
        @elseif ($activeTab === 'itinerary')
            @include('destination.itinerary')
        @elseif ($activeTab === 'price')
            @include('destination.price')
        @endif
    </div>
@endsection
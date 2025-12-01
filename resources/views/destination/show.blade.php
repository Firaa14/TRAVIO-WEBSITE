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
                                        }}"
            class="position-absolute top-0 start-0 m-3 text-white fw-semibold text-decoration-none" style="z-index:10;">
            Back
        </a>
        <div class="hero-content">
            <h1 class="fw-bold display-5">Almost There!</h1>
            <p>One last step to secure your adventure with Travio.</p>
        </div>
    </section>

    {{-- SUBMENU / TABS --}}
    <nav class="tab-navigation">
        <a href="{{ route('destination.show', ['id' => $destination->id, 'tab' => 'details']) }}"
            class="{{ $activeTab === 'details' ? 'active' : '' }}">Details</a>
        <a href="{{ route('destination.show', ['id' => $destination->id, 'tab' => 'itinerary']) }}"
            class="{{ $activeTab === 'itinerary' ? 'active' : '' }}">Itinerary</a>
        <a href="{{ route('destination.show', ['id' => $destination->id, 'tab' => 'price']) }}"
            class="{{ $activeTab === 'price' ? 'active' : '' }}">Price</a>
    </nav>

    {{-- CONTENT --}}
    <div class="container my-5 px-4">
        @if ($activeTab === 'details')
            @include('destination.details')
        @elseif ($activeTab === 'itinerary')
            @include('destination.itinerary')
        @elseif ($activeTab === 'price')
            @include('destination.price')
        @endif
    </div>
@endsection

<style>
    .hero-section {
        height: 60vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
        z-index: 1;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .tab-navigation {
        background: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 0;
        display: flex;
        justify-content: center;
        gap: 0;
    }

    .tab-navigation a {
        padding: 15px 30px;
        text-decoration: none;
        color: #666;
        border-bottom: 3px solid transparent;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .tab-navigation a:hover {
        color: #12395D;
        background: #f8f9fa;
    }

    .tab-navigation a.active {
        color: #12395D;
        border-bottom-color: #12395D;
        background: #fff;
    }

    .container.px-4 {
        max-width: 800px;
    }
</style>
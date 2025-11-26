<section class="position-relative text-white" style="height: 400px; overflow: hidden;">
    <video autoplay loop muted playsinline class="w-100 h-100 position-absolute top-0 start-0 object-fit-cover"
        style="object-fit: cover; min-width:100%; min-height:100%; z-index:0;">
        <source src="{{ asset('videos/rental.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    {{-- Lapisan gelap transparan --}}
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.6); z-index:1;"></div>

    <div class="position-relative h-100 d-flex flex-column justify-content-center align-items-center"
        style="z-index:2;">
        {{-- Tombol Back --}}
        <a href="#"
            onclick="event.preventDefault(); if(document.referrer) { window.location = document.referrer; } else { window.location = '{{ route('dashboard') }}'; }"
            class="position-absolute top-0 start-0 m-4 text-white fw-semibold d-flex align-items-center"
            style="text-decoration:none; font-size:1rem;">
            <i class="bi bi-arrow-left-circle-fill me-1" style="font-size:1.5rem;"></i>
            Back </a>

        {{-- Judul Hero --}}
        <div class="text-center">
            <h1 class="fw-bold mb-2" style="font-size:2.8rem;">Drive Away Today</h1>
            <p class="lead mb-3" style="font-size:1.3rem;">Pick your ride and start your adventure.</p>
        </div>
    </div>
</section>
<style>
    /* Hero Section Styling */
    .hero-section {
        position: relative;
        background: url('/photos/hero3.jpg') center/cover no-repeat;
        height: 60vh;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
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

    /* Submenu / Tab Navigation */
    .tab-navigation {
        display: flex;
        justify-content: center;
        background: #fff;
        border-bottom: 2px solid #e5e7eb;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .tab-navigation a {
        padding: 15px 25px;
        text-decoration: none;
        color: #333;
        font-weight: 600;
        transition: all 0.2s;
    }

    .tab-navigation a.active {
        color: #007bff;
        border-bottom: 3px solid #007bff;
    }

    .tab-navigation a:hover {
        color: #007bff;
    }
</style>
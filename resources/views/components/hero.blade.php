<section class="hero-section d-flex align-items-center justify-content-center"
    style="position:relative; min-height:600px; width:100vw; left:50%; right:50%; margin-left:-50vw; margin-right:-50vw; overflow:hidden;">

    <!-- ✅ Video background -->
    <video autoplay muted loop playsinline
        style="position:absolute; top:0; left:0; width:100%; height:100%; object-fit:cover; z-index:0;">
        <source src="{{ asset('videos/hero.mp4') }}" type="video/mp4">
        Browser kamu tidak mendukung video tag.
    </video>

    <!-- ✅ Overlay gelap (tetap sama seperti sebelumnya) -->
    <div style="position:absolute;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.45);z-index:1;"></div>

    <!-- ✅ Konten tetap di atas -->
    <div class="container text-center" style="position:relative; z-index:2;">
        <h1 class="fw-bold text-white mb-3" style="font-size:2.2rem; text-shadow:2px 2px 8px rgba(0,0,0,0.7);">
            Welcome to Travio – Your Journey Starts Here!</h1>
        <p class="text-white mb-4" style="font-size:1.1rem; text-shadow:1px 1px 6px rgba(0,0,0,0.6);">
            Experience Malang Raya like never before – from local flavors to the Arema spirit.
        </p>
        <a href="/login" class="btn btn-primary px-4 py-2 fw-bold">Login / Register</a>
    </div>
</section>
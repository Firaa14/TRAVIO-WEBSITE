<section class="hero-section d-flex align-items-center justify-content-center"
    style="position:relative; min-height:600px; width:100vw; left:50%; right:50%; margin-left:-50vw; margin-right:-50vw; background: url('/photos/hero2.webp') center center/cover no-repeat;">
    <div class="container text-center" style="position:relative; z-index:2;">
        <h1 class="fw-bold text-white mb-3" style="font-size:2.2rem; text-shadow: 2px 2px 8px rgba(0,0,0,0.7);">
            Hai, {{ isset($userName) ? $userName : 'Firaa Dummy' }}!
        </h1>
        <p class="text-white mb-4" style="font-size:1.1rem; text-shadow: 1px 1px 6px rgba(0,0,0,0.6);">Manage your
            personal information, track bookings, and update your preferences – all in one place.</p>
    </div>
    <div style="position:absolute;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.45);z-index:1;"></div>
</section>
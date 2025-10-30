<section class="hero-section d-flex align-items-center justify-content-center"
    style="position:relative; min-height:100vh; width:100vw; left:50%; right:50vw; margin-left:-50vw; margin-right:-50vw; overflow:hidden; background:#fff;">
    <!-- Video background -->
    <video autoplay muted loop playsinline
        style="position:absolute; top:0; left:0; width:100%; height:100%; object-fit:cover; z-index:0;">
        <source src="{{ asset('videos/hero.mp4') }}" type="video/mp4">
        Browser kamu tidak mendukung video tag.
    </video>
    <!-- Overlay gelap -->
    <div style="position:absolute;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.45);z-index:1;"></div>
    <!-- Konten utama -->
    <div class="container text-center d-flex flex-column justify-content-center align-items-center"
        style="position:relative; z-index:2; min-height:100vh;">
        <h1 class="fw-bold text-white mb-3" style="font-size:2.7rem; text-shadow:2px 2px 8px rgba(0,0,0,0.7);">
            Welcome to Travio – Your Journey Starts Here!</h1>
        <p class="text-white mb-4" style="font-size:1.25rem; text-shadow:1px 1px 6px rgba(0,0,0,0.6);">
            Experience Malang Raya like never before – from local flavors to the Arema spirit.
        </p>
        <a href="/login" class="btn btn-primary px-4 py-2 fw-bold" style="font-size:1.1rem; border-radius:2rem;">Login /
            Register</a>
        <!-- Scroll indicator -->
        <div class="scroll-indicator mt-5"
            style="position:absolute;bottom:40px;left:50%;transform:translateX(-50%);z-index:3;">
            <button onclick="window.scrollTo({top: window.innerHeight, behavior: 'smooth'});"
                style="background:none;border:none;outline:none;">
                <span
                    style="display:block;width:40px;height:40px;border-radius:50%;background:rgba(255,255,255,0.15);box-shadow:0 2px 8px rgba(0,0,0,0.15);">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 28L12 18H28L20 28Z" fill="#fff" />
                    </svg>
                </span>
            </button>
        </div>
    </div>
    <!-- Wave transition to next section -->
    <div
        style="position:absolute;bottom:0;left:0;width:100vw;height:100px;z-index:2;overflow:hidden;pointer-events:none;">
        <svg viewBox="0 0 1920 100" preserveAspectRatio="none" style="width:100vw;height:100px;display:block;">
            <path d="M0,0 C480,100 1440,0 1920,100 L1920,100 L0,100 Z" fill="#fff" />
        </svg>
    </div>
</section>
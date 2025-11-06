<style>
    /* HERO SECTION */
    .hero-section {
        position: relative;
        width: 100vw;
        height: 100vh;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Video Background */
    .hero-section video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        object-fit: cover;
        z-index: 0;
    }

    /* Overlay Gelap */
    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 730px;
        background: rgba(0, 0, 0, 0.45);
        z-index: 1;
    }

    /* Konten Utama */
    .hero-content {
        position: relative;
        z-index: 2;
        color: #fff;
        text-align: center;
        animation: fadeUp 1.6s ease forwards;
        opacity: 0;
        transform: translateY(40px);
    }

    /* Judul dan Paragraf */
    .hero-content h1 {
        font-size: 3rem;
        font-weight: 700;
        text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.6);
    }

    .hero-content p {
        font-size: 1.2rem;
        margin-top: 15px;
        margin-bottom: 30px;
        text-shadow: 1px 1px 6px rgba(0, 0, 0, 0.6);
    }

    /* Tombol */
    .hero-content .btn-primary {
        background-color: #00a8e8;
        border: none;
        padding: 12px 45px;
        border-radius: 50px;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        box-shadow: 0 0 20px rgba(0, 168, 232, 0.6);
    }

    .hero-content .btn-primary:hover {
        background-color: #0077b6;
        transform: scale(1.05);
        box-shadow: 0 0 25px rgba(0, 168, 232, 0.8);
    }

    /* Scroll Indicator */
    .scroll-indicator {
        position: absolute;
        bottom: 40px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 3;
        animation: fadeUp 2.2s ease forwards;
        opacity: 0;
    }

    /* Wave Transition */
    .wave-transition {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100vw;
        height: 100px;
        z-index: 2;
        overflow: hidden;
        pointer-events: none;
    }

    /* Animasi */
    @keyframes fadeUp {
        0% {
            opacity: 0;
            transform: translateY(40px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .hero-content h1 {
            font-size: 2.2rem;
        }

        .hero-content p {
            font-size: 1rem;
        }
    }
</style>

<section class="hero-section">
    <!-- Video background -->
    <video autoplay muted loop playsinline>
        <source src="{{ asset('videos/opentrip.mp4') }}" type="video/mp4">
        Browser kamu tidak mendukung video tag.
    </video>

    <!-- Overlay gelap -->
    <div class="hero-overlay"></div>

    <!-- Konten utama -->
    <div class="container d-flex flex-column justify-content-center align-items-center hero-content">
        <h1 class="fw-bold mb-3">Discover Your Next Adventure</h1>
        <p>Join our open trips and explore new destinations with fellow travelers.</p>
    </div>

    <!-- Wave transition -->
    <div class="wave-transition">
        <svg viewBox="0 0 1920 100" preserveAspectRatio="none" style="width:100vw;height:100px;display:block;">
            <path d="M0,0 C480,100 1440,0 1920,100 L1920,100 L0,100 Z" fill="#ffffffff" />
        </svg>
    </div>
</section>
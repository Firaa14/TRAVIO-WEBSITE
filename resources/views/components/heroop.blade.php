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
        background: linear-gradient(135deg, #12395D 0%, #1e4a72 50%, #2a5f87 100%);
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

    /* Fallback Background Image */
    .hero-background-img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('{{ asset("photos/destination5.jpg") }}');
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        z-index: 0;
    }

    /* Overlay */
    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(18, 57, 93, 0.7) 0%, rgba(30, 74, 114, 0.6) 50%, rgba(42, 95, 135, 0.7) 100%);
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
        max-width: 800px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    /* Judul dan Paragraf */
    .hero-content h1 {
        font-size: 3.5rem;
        font-weight: 800;
        text-shadow: 2px 2px 20px rgba(0, 0, 0, 0.7);
        margin-bottom: 1.5rem;
        line-height: 1.2;
    }
    }

    .hero-content p {
        font-size: 1.4rem;
        margin-top: 1rem;
        margin-bottom: 2.5rem;
        text-shadow: 1px 1px 8px rgba(0, 0, 0, 0.7);
        opacity: 0.95;
        line-height: 1.6;
    }

    /* CTA Buttons */
    .hero-cta-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 2rem;
    }

    .hero-btn-primary {
        background: linear-gradient(135deg, #4A90E2, #357ABD);
        border: none;
        padding: 1rem 2.5rem;
        border-radius: 25px;
        font-size: 1.1rem;
        font-weight: 600;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 8px 25px rgba(74, 144, 226, 0.4);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .hero-btn-primary:hover {
        background: linear-gradient(135deg, #357ABD, #4A90E2);
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(74, 144, 226, 0.6);
        color: white;
        text-decoration: none;
    }

    .hero-btn-secondary {
        background: transparent;
        border: 2px solid rgba(255, 255, 255, 0.9);
        padding: 1rem 2.5rem;
        border-radius: 25px;
        font-size: 1.1rem;
        font-weight: 600;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .hero-btn-secondary:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: white;
        color: white;
        text-decoration: none;
        transform: translateY(-2px);
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
            font-size: 2.5rem;
        }

        .hero-content p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }
        
        .hero-cta-buttons {
            flex-direction: column;
            align-items: center;
            gap: 0.8rem;
        }

        .hero-btn-primary,
        .hero-btn-secondary {
            width: 100%;
            max-width: 280px;
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .hero-content h1 {
            font-size: 2rem;
        }
        
        .hero-content p {
            font-size: 1rem;
        }
    }
</style>

<section class="hero-section">
    <!-- Fallback Background Image -->
    <div class="hero-background-img"></div>
    
    <!-- Video background (if available) -->
    <video autoplay muted loop playsinline style="display: none;" onloadeddata="this.style.display='block'">
        <source src="{{ asset('videos/opentrip.mp4') }}" type="video/mp4">
    </video>

    <!-- Overlay -->
    <div class="hero-overlay"></div>

    <!-- Konten utama -->
    <div class="container hero-content">
        <h1 class="fw-bold mb-3">Discover Your Next Adventure</h1>
        <p>Join our open trips and explore new destinations with fellow travelers. Create unforgettable memories with like-minded adventurers.</p>
    </div>

    <!-- Wave transition -->
    <div class="wave-transition">
        <svg viewBox="0 0 1920 100" preserveAspectRatio="none" style="width:100vw;height:100px;display:block;">
            <path d="M0,0 C480,100 1440,0 1920,100 L1920,100 L0,100 Z" fill="#ffffff" />
        </svg>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Smooth scrolling for Explore Trips button
        const exploreBtn = document.querySelector('a[href="#trips"]');
        if (exploreBtn) {
            exploreBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const tripsSection = document.querySelector('#trips') || 
                                   document.querySelector('.container .row.g-4') || 
                                   document.querySelector('.py-5');
                
                if (tripsSection) {
                    tripsSection.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        }
    });
</script>
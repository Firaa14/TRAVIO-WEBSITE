@extends('layouts.app')
@section('title', 'Travio - Professional Travel Management System')

@php
    $hideFooter = true;
@endphp

@push('styles')
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    body {
        font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        overflow-x: hidden;
    }
    
    /* Custom Navbar Styles */
    .custom-navbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        background: rgba(18, 57, 93, 0.95);
        backdrop-filter: blur(10px);
        padding: 1rem 0;
        transition: all 0.3s ease;
        box-shadow: 0 2px 20px rgba(18, 57, 93, 0.1);
    }
    
    .navbar-brand {
        font-size: 1.8rem;
        font-weight: 700;
        color: white !important;
        text-decoration: none;
    }
    
    .navbar-nav .nav-link {
        color: rgba(255,255,255,0.9) !important;
        font-weight: 500;
        margin: 0 1rem;
        transition: color 0.3s ease;
    }
    
    .navbar-nav .nav-link:hover {
        color: white !important;
    }
    
    .contact-btn {
        background: linear-gradient(135deg, #12395D, #1a4a73);
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 25px;
        color: white;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(18, 57, 93, 0.3);
    }
    
    .contact-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(18, 57, 93, 0.5);
        color: white;
        text-decoration: none;
        background: linear-gradient(135deg, #1a4a73, #12395D);
    }
    
    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, #12395D 0%, #1e4a72 50%, #2a5f87 100%);
        min-height: 100vh;
        position: relative;
        display: flex;
        align-items: center;
        overflow: hidden;
    }
    
    .hero-bg {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 200px;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 200"><path d="M0,100 C150,180 300,40 450,120 C600,200 750,60 900,140 C1050,220 1200,80 1200,80 L1200,200 L0,200 Z" fill="rgba(0,0,0,0.2)"/></svg>') repeat-x bottom;
        background-size: cover;
        opacity: 0.6;
    }
    
    .hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
        color: white;
        padding-top: 100px;
    }
    
    .hero-title {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        line-height: 1.2;
    }
    
    .hero-highlight {
        color: #4A90E2;
        display: block;
    }
    
    .hero-subtitle {
        font-size: 1.2rem;
        font-weight: 400;
        max-width: 600px;
        margin: 0 auto 2.5rem;
        opacity: 0.95;
        line-height: 1.6;
    }
    
    .hero-cta {
        background: linear-gradient(135deg, #4A90E2, #357ABD);
        border: none;
        padding: 1rem 2.5rem;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 25px;
        color: white;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        box-shadow: 0 10px 30px rgba(74, 144, 226, 0.4);
    }
    
    .hero-cta:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(74, 144, 226, 0.6);
        color: white;
        text-decoration: none;
        background: linear-gradient(135deg, #357ABD, #4A90E2);
    }
    
    /* Features Section */
    .features-section {
        background: linear-gradient(to bottom, #f8f9ff, white);
        padding: 5rem 0;
    }
    
    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2d3748;
        text-align: center;
        margin-bottom: 1rem;
    }
    
    .section-subtitle {
        font-size: 1.1rem;
        color: #718096;
        text-align: center;
        max-width: 600px;
        margin: 0 auto 3rem;
        line-height: 1.6;
    }
    
    .feature-card {
        background: white;
        border-radius: 20px;
        padding: 2.5rem 2rem;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        height: 100%;
        border: 1px solid #e2e8f0;
    }
    
    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(0,0,0,0.15);
    }
    
    .feature-icon {
        background: linear-gradient(135deg, #4A90E2, #357ABD);
        width: 70px;
        height: 70px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
        color: white;
        box-shadow: 0 4px 15px rgba(74, 144, 226, 0.3);
    }
    
    .feature-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 1rem;
    }
    
    .feature-description {
        color: #718096;
        line-height: 1.6;
        font-size: 0.95rem;
    }
    
    /* Contact Section */
    .contact-section {
        background: linear-gradient(to bottom, white, #f7fafc);
        padding: 5rem 0;
    }
    
    .contact-info-card {
        background: white;
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        height: 100%;
    }
    
    .contact-form-card {
        background: white;
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        height: 100%;
    }
    
    .contact-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 2rem;
    }
    
    .contact-item-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        font-size: 1.2rem;
        flex-shrink: 0;
        color: white;
    }
    
    .contact-item-content h6 {
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 0.5rem;
    }
    
    .contact-item-content p {
        color: #718096;
        margin: 0;
        font-size: 0.9rem;
    }
    
    .social-links {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }
    
    .social-link {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        color: white;
        font-size: 1.2rem;
        transition: transform 0.3s ease;
    }
    
    .social-link:hover {
        transform: translateY(-3px);
        color: white;
    }
    
    .form-control {
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        transition: border-color 0.3s ease;
    }
    
    .form-control:focus {
        border-color: #4A90E2;
        box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.1);
    }
    
    .form-label {
        font-weight: 500;
        color: #2d3748;
        margin-bottom: 0.5rem;
    }
    
    .submit-btn {
        background: linear-gradient(135deg, #4A90E2, #357ABD);
        border: none;
        padding: 0.875rem 2rem;
        border-radius: 8px;
        color: white;
        font-weight: 600;
        width: 100%;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(74, 144, 226, 0.3);
    }
    
    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(74, 144, 226, 0.4);
        background: linear-gradient(135deg, #357ABD, #4A90E2);
    }
    
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }
        
        .section-title {
            font-size: 2rem;
        }
        
        .feature-card {
            margin-bottom: 2rem;
        }
        
        .contact-info-card,
        .contact-form-card {
            margin-bottom: 2rem;
        }
    }
    
    .fade-up {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s ease;
    }
    
    .fade-up.visible {
        opacity: 1;
        transform: translateY(0);
    }
</style>
@endpush

@section('content')
<!-- Custom Navbar -->
<nav class="custom-navbar">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('photos/logo-travio.png') }}" alt="Travio Logo" style="height: 85px; object-fit: contain;">
            </a>
            <div class="d-flex align-items-center">
                <ul class="navbar-nav d-flex flex-row mb-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact Us</a>
                    </li>
            </div>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="hero-content fade-up">
                    <h1 class="hero-title">
                        Explore the Beauty of
                        <span class="hero-highlight">Greater Malang</span>
                    </h1>
                    <p class="hero-subtitle">
                        Discover the charm of nature, culture, and unforgettable adventures in Greater Malang with Travio. 
                        From mountains to beaches, we are ready to take you to your dream destination.
                    </p>
                    <a href="{{ route('dashboard') }}" class="hero-cta">
                        Start Your Journey
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="features-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="section-title fade-up">Why Choose Travio?</h2>
                <p class="section-subtitle fade-up">
                    We are committed to providing the best travel experience with high-quality services
                </p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="feature-card fade-up">
                    <div class="feature-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <h4 class="feature-title">Professional Tour Guide</h4>
                    <p class="feature-description">
                        Experienced and licensed tour guides ready to accompany your journey with in-depth knowledge of local history and culture.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card fade-up">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4 class="feature-title">Guaranteed Safety</h4>
                    <p class="feature-description">
                        Comprehensive travel insurance and the highest safety standards to ensure your comfort and peace of mind while traveling.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card fade-up">
                    <div class="feature-icon">
                        <i class="fas fa-gem"></i>
                    </div>
                    <h4 class="feature-title">Best Price</h4>
                    <p class="feature-description">
                        Competitive and transparent travel packages with no hidden costs, providing the best value for unforgettable experiences.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card fade-up">
                    <div class="feature-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h4 class="feature-title">Flexible Schedule</h4>
                    <p class="feature-description">
                        Arrange your travel schedule according to your wishes with various departure time options that can be customized to personal needs.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card fade-up">
                    <div class="feature-icon">
                        <i class="fas fa-bus"></i>
                    </div>
                    <h4 class="feature-title">Comfortable Transportation</h4>
                    <p class="feature-description">
                        Modern and well-maintained air-conditioned vehicles for comfortable and safe journeys to all your chosen tourist destinations.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card fade-up">
                    <div class="feature-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h4 class="feature-title">24/7 Service</h4>
                    <p class="feature-description">
                        Responsive customer service team ready to help you anytime to ensure your journey runs smoothly without obstacles.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="section-title fade-up">Contact Us</h2>
                <p class="section-subtitle fade-up">
                    Ready to start your adventure? Contact us now for a free consultation
                </p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-5">
                <div class="contact-info-card fade-up">
                    <h4 style="color: #2d3748; font-weight: 600; margin-bottom: 2rem;">Contact Information</h4>
                    
                    <div class="contact-item">
                        <div class="contact-item-icon" style="background: #4A90E2;">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-item-content">
                            <h6>Address</h6>
                            <p>Jl. Soekarno Hatta No. 123, Malang, East Java 65141</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-item-icon" style="background: #12395D;">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-item-content">
                            <h6>Phone</h6>
                            <p>+62 341 123 4567<br>+62 812 3456 7890</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-item-icon" style="background: #357ABD;">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-item-content">
                            <h6>Email</h6>
                            <p>info@travio.com<br>booking@travio.com</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-item-icon" style="background: #2a5f87;">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="contact-item-content">
                            <h6>Operating Hours</h6>
                            <p>Monday - Friday: 08:00 - 17:00 WIB<br>Saturday - Sunday: 09:00 - 15:00 WIB</p>
                        </div>
                    </div>
                    
                    <div style="margin-top: 2rem;">
                        <h6 style="color: #2d3748; font-weight: 600; margin-bottom: 1rem;">Follow Us</h6>
                        <div class="social-links">
                            <a href="#" class="social-link" style="background: #4267B2;">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-link" style="background: #E4405F;">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="social-link" style="background: #1DA1F2;">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="social-link" style="background: #FF0000;">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-7">
                <div class="contact-form-card fade-up">
                    <h4 style="color: #2d3748; font-weight: 600; margin-bottom: 2rem;">Send Message</h4>
                    
                    <form action="#" method="POST">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name <span style="color: #e53e3e;">*</span></label>
                                <input type="text" class="form-control" placeholder="Enter your full name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone Number <span style="color: #e53e3e;">*</span></label>
                                <input type="tel" class="form-control" placeholder="08123456789" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Email <span style="color: #e53e3e;">*</span></label>
                                <input type="email" class="form-control" placeholder="email@example.com" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Destination Choice <span style="color: #e53e3e;">*</span></label>
                                <select class="form-control" required>
                                    <option value="">Select destination</option>
                                    <option value="bromo">Bromo Tengger Semeru</option>
                                    <option value="batu">Batu City Tourism</option>
                                    <option value="pantai">South Malang Beach</option>
                                    <option value="coban">Coban Rondo Waterfall</option>
                                    <option value="other">Others</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Departure Date <span style="color: #e53e3e;">*</span></label>
                                <input type="date" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Number of Participants <span style="color: #e53e3e;">*</span></label>
                                <select class="form-control" required>
                                    <option value="">Select number</option>
                                    <option value="1">1 Person</option>
                                    <option value="2">2 People</option>
                                    <option value="3-5">3-5 People</option>
                                    <option value="6-10">6-10 People</option>
                                    <option value="10+">More than 10 People</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Additional Message</label>
                                <textarea class="form-control" rows="4" placeholder="Tell us about your travel needs..."></textarea>
                                <small style="color: #718096;">Maximum 500 characters</small>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="submit-btn">
                                    <i class="fas fa-paper-plane me-2"></i>Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Intersection Observer for fade animations
    document.addEventListener('DOMContentLoaded', function() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);
        
        // Observe all fade-up elements
        document.querySelectorAll('.fade-up').forEach(el => {
            observer.observe(el);
        });
        
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Navbar scroll effect
        const navbar = document.querySelector('.custom-navbar');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(18, 57, 93, 0.98)';
                navbar.style.backdropFilter = 'blur(15px)';
            } else {
                navbar.style.background = 'rgba(18, 57, 93, 0.95)';
                navbar.style.backdropFilter = 'blur(10px)';
            }
        });
        
        // Form validation and submission
        const contactForm = document.querySelector('form');
        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Simple form validation
                const requiredFields = this.querySelectorAll('[required]');
                let isValid = true;
                
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.style.borderColor = '#e53e3e';
                        isValid = false;
                    } else {
                        field.style.borderColor = '#e2e8f0';
                    }
                });
                
                if (isValid) {
                    // Show success message (you can replace this with actual form submission)
                    const submitBtn = this.querySelector('.submit-btn');
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '✅ Message Sent!';
                    submitBtn.style.background = '#48bb78';
                    
                    setTimeout(() => {
                        submitBtn.innerHTML = originalText;
                        submitBtn.style.background = 'linear-gradient(135deg, #4A90E2, #357ABD)';
                        this.reset();
                    }, 2000);
                } else {
                    // Show error message
                    const submitBtn = this.querySelector('.submit-btn');
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '❌ Please complete the form';
                    submitBtn.style.background = '#e53e3e';
                    
                    setTimeout(() => {
                        submitBtn.innerHTML = originalText;
                        submitBtn.style.background = 'linear-gradient(135deg, #4A90E2, #357ABD)';
                    }, 2000);
                }
            });
        }
        
        // Add hover effects for feature cards
        document.querySelectorAll('.feature-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
    });
</script>
@endpush
@extends('layouts.app')
@section('title', 'Dashboard | Travio')

@section('content')


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="/resources/css/custom-dashboard.css" rel="stylesheet">

@include('components.navbar')

<script>
    // Sticky Navbar Scroll Effect
    document.addEventListener('DOMContentLoaded', function () {
        var navbar = document.querySelector('.navbar');
        window.addEventListener('scroll', function () {
            if (window.scrollY > 40) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Fade-up animation for cards
        var fadeUps = document.querySelectorAll('.fade-up');
        function showFadeUps() {
            fadeUps.forEach(function (el) {
                var rect = el.getBoundingClientRect();
                if (rect.top < window.innerHeight - 40) {
                    el.classList.add('visible');
                }
            });
        }
        window.addEventListener('scroll', showFadeUps);
        showFadeUps();
    });
</script>
@include('components.hero')

<!-- Popular Tourist Destinations -->
<section class="section-padding section-white" style="background:#fff;">
    <div class="container px-8">
        <h2 class="fw-bold text-center mb-2">Popular Tourist Destinations</h2>
        <p class="text-center mb-4">Explore amazing places in Greater Malang that are ready to provide an unforgettable
            experience.</p>

        <div class="row g-6 justify-content-center mb-4">
            @foreach($destinations->take(8) as $destination)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex align-items-stretch justify-content-center fade-up">
                    {{-- semua data sekarang dari DB --}}
                    <a href="{{ route('destination.show', $destination->id) }}" style="text-decoration: none; width: 100%;">
                        <div class="card destination-card h-100" style="max-width: 280px; margin: 0 auto;">
                            <img src="{{ asset('photos/' . $destination->image) }}" class="card-img-top"
                                alt="{{ $destination->name }}" style="height: 200px; object-fit: cover;">

                            <div class="card-body text-center d-flex flex-column justify-content-between">
                                <div>
                                    <h6 class="card-title fw-bold mb-2" style="font-size:1.1rem; color:#12395D;">
                                        {{ $destination->name }}
                                    </h6>
                                    <p class="card-text text-muted mb-2"
                                        style="font-size: 0.9rem; height: 60px; overflow: hidden;">
                                        {{ strlen($destination->description) > 80 ? substr($destination->description, 0, 80) . '...' : $destination->description }}
                                    </p>
                                </div>
                                <div class="mt-auto">
                                    <span class="fw-bold text-primary" style="font-size: 1rem;">
                                        Rp {{ number_format($destination->price, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

            <div class="text-center mt-5 mb-5">
                <a href="{{ route('destinasi.index') }}" class="btn btn-gradient fw-bold">
                    See all Destination
                </a>
            </div>
        </div>
</section>


<!-- Best Hotels & Accommodations Section -->
<section class="section-padding section-white" style="background:#fff;">
    <div class="container">
        <h2 class="fw-bold text-center mb-2" style="color:#222;">Best Hotels & Accommodations</h2>
        <p class="text-center mb-4" style="color:#555;">Enjoy the comfort of staying in selected hotels with complete
            facilities and affordable prices.</p>
        <div class="row g-4 justify-content-center" style="background:#fff; border-radius:1.5rem; padding:2rem 0;">
            @foreach($hotels->take(4) as $hotel)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center fade-up">
                    <a href="{{ route('hotels.show', $hotel->id) }}" style="text-decoration:none;">
                        <div class="card h-100 shadow-sm hotel-card" style="max-width:370px; width:100%; cursor:pointer;">
                            <img src="{{ asset($hotel->image) }}" class="card-img-top" alt="{{ $hotel->title }}">
                            <div class="card-body">
                                <h5 class="card-title fw-bold mb-1">{{ $hotel->title }}</h5>
                                <p class="mb-2" style="color:#666; font-size:0.97rem;">{{ $hotel->location }}</p>
                                <div class="mb-2 d-flex flex-wrap gap-2">
                                    @foreach($hotel->facilities as $facility)
                                        <span class="badge bg-secondary">{{ $facility }}</span>
                                    @endforeach
                                </div>
                                <div class="fw-bold mb-0" style="font-size:1.1rem; color:#12395D;">
                                    {{ $hotel->price }}
                                </div>
                                <small class="text-muted">per night</small>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-5 mb-5">
            <a href="{{ route('hotels.index') }}" class="btn btn-gradient fw-bold">See all Hotels</a>
        </div>
    </div>
</section>


<!-- Rental Car Advantages Section -->
<section class="section-padding section-white mb-2" style="background:#fff;">
    <div class="container">
        <h2 class="fw-bold text-center mb-2" style="color:#222;">Trusted Car Rental</h2>
        <p class="text-center mb-2" style="color:#555;">Rent a quality car, a selection of popular options for comfort
            and safe driving.</p>
        <div class="row justify-content-center" style="background:#fff; border-radius:1.5rem; padding:1rem 0 0.5rem 0;">
            @foreach($rentalAdvantages as $advantage)
                <div class="col-12 col-md-3 d-flex flex-column align-items-center text-center mb-2 mb-md-0 fade-up">
                    <img src="{{ asset('photos/' . $advantage['image']) }}" alt="{{ $advantage['title'] }}"
                        style="width:120px; height:120px; margin-bottom:0.5rem; object-fit:contain;">
                    <h6 class="fw-bold mb-2" style="color:#12395D; font-size:1.18rem;">{{ $advantage['title'] }}</h6>
                    <p class="text-muted" style="font-size:0.97rem;">{{ $advantage['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Car Rentals Section -->
<section class="section-padding section-white mt-0" style="background:#fff;">
    <div class="container">
        <div class="row g-4 justify-content-center" style="background:#fff; border-radius:1.5rem; padding:1rem 0;">
            @foreach($cars->take(4) as $car)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center fade-up">
                    @if(isset($car->id))
                        <a href="{{ route('cars.show', $car->id) }}" style="text-decoration:none; width:100%; max-width:370px;"
                            class="card-link-wrapper">
                            <div class="card h-100 shadow-sm hotel-card" style="max-width:370px; width:100%; cursor:pointer;">
                                <img src="{{ asset($car->image) }}" class="card-img-top" alt="{{ $car->title }}">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold mb-1">{{ $car->title }}</h5>
                                    <p class="mb-2" style="color:#666; font-size:0.97rem;">{{ $car->description }}</p>
                                    <div class="mb-2 d-flex flex-wrap gap-2">
                                        @php
                                            $facilities = is_array($car->facilities) ? $car->facilities : json_decode($car->facilities, true);
                                        @endphp
                                        @foreach($facilities as $facility)
                                            <span class="badge bg-secondary">{{ $facility }}</span>
                                        @endforeach
                                    </div>
                                    <div class="fw-bold mb-0" style="font-size:1.1rem; color:#12395D;">Rp
                                        {{ number_format($car->price, 0, ',', '.') }},00
                                    </div>
                                    <small class="text-muted">per day</small>
                                </div>
                            </div>
                        </a>
                    @else
                        <div class="card h-100 shadow-sm hotel-card" style="max-width:370px; width:100%; opacity:0.6;">
                            <img src="{{ asset($car->image) }}" class="card-img-top" alt="{{ $car->title }}">
                            <div class="card-body">
                                <h5 class="card-title fw-bold mb-1">{{ $car->title }}</h5>
                                <p class="mb-2" style="color:#666; font-size:0.97rem;">{{ $car->description }}</p>
                                <div class="mb-2 d-flex flex-wrap gap-2">
                                    @foreach(json_decode($car->facilities, true) as $facility)
                                        <span class="badge bg-secondary">{{ $facility }}</span>
                                    @endforeach
                                </div>
                                <div class="fw-bold mb-0" style="font-size:1.1rem; color:#12395D;">Rp
                                    {{ number_format($car->price, 0, ',', '.') }},00
                                </div>
                                <small class="text-muted">per day</small>
                                <div class="text-danger mt-2">Car ID not found</div>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        <div class="text-center mt-5 mb-5">
            <a href="{{ route('cars.index') }}" class="btn btn-gradient fw-bold">See all Cars</a>
        </div>
    </div>
</section>

<!-- Special Tour Packages Section -->

<section class="section-padding section-white" style="background:#fff;">
    <div class="container">
        <h2 class="fw-bold text-center mb-2" style="color:#222;">Special Tour Packages</h2>
        <p class="text-center mb-4" style="color:#555;">Enjoy a complete travel experience with attractive packages that
            include accommodation, transportation, and a tour guide.</p>
        <div class="row g-4 justify-content-center" style="background:#fff; border-radius:1.5rem; padding:2rem 0;">
            @foreach($packages as $index => $package)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center fade-up">
                    <a href="{{ route('packages.show', $index + 1) }}?from=dashboard"
                        style="text-decoration:none; width:100%; max-width:260px;">
                        <div class="card shadow-sm package-card" style="width:100%; max-width:260px;">
                            <img src="{{ asset('photos/' . $package->image) }}" class="card-img-top"
                                alt="{{ $package->title }}">
                            <div class="card-body">
                                <h6 class="card-title fw-bold mb-1">{{ $package->title }}</h6>
                                <p class="mb-0" style="color:#12395D; font-weight:500;">Rp
                                    {{ number_format($package->price, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <div class="text-center mt-5 mb-5">
        <a href="{{ route('packages.index') }}" class="btn btn-gradient fw-bold">See all Packages</a>
    </div>
    </div>
</section>

<!-- Get Special Offer Section -->
<section class="section-padding section-white mb-5"
    style="background:#fff; border-radius:1rem; max-width:90%; margin:2rem auto 0 auto;">
    <div class="container d-flex justify-content-center">
        <div class="card shadow-sm" style="border-radius:1rem; max-width:600px; width:100%;">
            <div class="card-body py-4">
                <h2 class="fw-bold text-center mb-2" style="color:#222;">Get Special Offer!</h2>
                <p class="text-center mb-3" style="font-size:0.97rem; color:#222;">Sign up for our newsletter and get up
                    to 40% off selected tour packages.</p>
                <form class="d-flex justify-content-center align-items-center gap-2"
                    style="max-width:600px; margin:0 auto;">
                    <input type="email" class="form-control" placeholder="Enter your email"
                        style="border-radius:0.5rem;">
                    <button type="submit" class="btn btn-gradient fw-bold" style="min-width:100px;">Send</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section
<section class="section-padding section-white" style="background:#fff;">
    <div class="container" style="max-width:900px;">
        <h2 class="fw-bold text-center mb-2" style="color:#222;">Frequently Asked Questions</h2>
        <div class="accordion" id="faqAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="faq1">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1"
                        aria-expanded="true" aria-controls="collapse1">
                        How do I book a tour package?
                    </button>
                </h2>
                <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="faq1"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">You can book a tour package directly on our website by selecting your
                        desired package and following the booking instructions.</div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="faq2">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                        Can I customize my travel itinerary?
                    </button>
                </h2>
                <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="faq2"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">Yes, you can contact our support team to discuss custom travel plans and
                        special requests.</div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="faq3">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                        What payment methods are accepted?
                    </button>
                </h2>
                <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="faq3"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">We accept various payment methods including credit cards, bank transfer,
                        and e-wallets.</div>
                </div>
            </div>
        </div>
    </div>
</section>  -->

<!-- Chat Section 
<section class="py-5" style="background:#fff;">
    <div class="container" style="max-width:700px;">
        <h2 class="fw-bold text-center mb-2" style="color:#222;">Live Chat Support</h2>
        <div class="card live-chat-card mx-auto"
            style="max-width:600px; width:100%; background:#e6f2ff !important; border-radius:20px !important; box-shadow:0 4px 24px rgba(0,0,0,0.08);">
            <div class="card-body p-4" style="background:transparent; min-height:250px; color:#333;">
                <div class="mb-3 text-center text-muted">Chat with our team for any questions or assistance.</div>
                <div
                    style="height:120px; overflow-y:auto; background:#fff; border-radius:0.5rem; padding:1rem; margin-bottom:1rem;">
                    <div class="d-flex mb-2">
                        <div class="bg-primary text-white px-3 py-2 rounded-pill me-auto" style="max-width:70%;">Hi! How
                            can we help you today?</div>
                    </div>
                    <div class="d-flex mb-2 justify-content-end">
                        <div class="bg-light px-3 py-2 rounded-pill ms-auto" style="max-width:70%;">I want to know about
                            tour packages.</div>
                    </div>
                </div>
                <form class="d-flex gap-2">
                    <input type="text" class="form-control" placeholder="Type your message..."
                        style="border-radius:0.5rem;">
                    <button type="submit" class="btn btn-primary fw-bold"
                        style="border-radius:0.5rem; min-width:80px;">Send</button>
                </form>
            </div>
        </div>
    </div>
</section> -->


<!-- Roboto font import -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet">
<style>
    .btn,
    .btn-primary,
    .btn-success,
    .btn-outline-secondary,
    .btn-lg,
    .btn-light,
    .btn-gradient {
        background: linear-gradient(90deg, #6ec1e4 0%, #0088FF 100%);
        color: #fff !important;
        border: none !important;
        transition: background 0.5s, box-shadow 0.5s;
        box-shadow: 0 2px 8px rgba(0, 136, 255, 0.08);
    }

    .btn:hover,
    .btn-primary:hover,
    .btn-success:hover,
    .btn-outline-secondary:hover,
    .btn-lg:hover,
    .btn-light:hover,
    .btn-gradient:hover {
        background: linear-gradient(90deg, #0088FF 0%, #0056b3 100%);
        color: #fff !important;
        box-shadow: 0 4px 16px rgba(0, 136, 255, 0.15);
    }

    .btn-outline-secondary {
        border: 2px solid #0088FF !important;
        background: #fff !important;
        color: #0088FF !important;
    }

    .btn-outline-secondary:hover {
        background: #0066bb !important;
        color: #fff !important;
        border-color: #0066bb !important;
    }

    html,
    body {
        overflow-x: hidden !important;
        width: 100vw;
        box-sizing: border-box;
    }

    body,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    p,
    a,
    .btn,
    .navbar,
    .card,
    .card-title,
    .card-text,
    .fw-bold,
    .lead {
        font-family: 'Roboto', sans-serif !important;
    }

    .destination-card,
    .hotel-card,
    .package-card {
        border-radius: 22px;
        transition: box-shadow 0.5s, transform 0.5s;
        background: #fff;
        overflow: hidden;
    }

    .destination-card:hover,
    .hotel-card:hover,
    .package-card:hover {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.10);
        transform: scale(1.03);
        cursor: pointer;
    }

    .card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-top-left-radius: inherit !important;
        border-top-right-radius: inherit !important;
        margin: 0;
        display: block;
    }
</style>>
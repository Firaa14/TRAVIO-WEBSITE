@extends('layouts.app')
@section('title', 'Dashboard | Travio')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

@include('components.navbar')
@include('components.hero')

<!-- Popular Tourist Destinations -->
<section class="py-5" style="background:#fff;">
    <div class="container">
        <h2 class="fw-bold text-center mb-2">Popular Tourist Destinations</h2>
        <p class="text-center mb-4">Explore amazing places in Greater Malang that are ready to provide an unforgettable
            experience.</p>
        <div class="row g-4 justify-content-center">
            @foreach($destinations as $index => $destination)
                <div class="col-12 col-sm-6 col-md-3 d-flex justify-content-center">
                    <a href="{{ route('travel.show', $index + 1) }}" style="text-decoration: none; color: inherit;">
                        <div class="card destination-card" style="width: 100%; max-width: 220px;">
                            <img src="{{ asset('photos/' . $destination['image']) }}" class="card-img-top"
                                alt="{{ $destination['name'] }}">
                            <div class="card-body text-center">
                                <h6 class="card-title fw-bold mb-1" style="font-size:1.1rem; color:#12395D;">
                                    {{ $destination['name'] }}
                                </h6>
                                <p class="card-text text-muted mb-0">{{ $destination['discount'] }} off</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
        <div class="text-center mt-4 mb-5">
            <a href="#" class="btn fw-bold"
                style="background:#12395D; color:#fff; border-radius:0.5rem; padding:0.5rem 2rem;">See all
                Destination</a>
        </div>
    </div>
</section>

<!-- Best Hotels & Accommodations Section -->
<section class="py-5" style="background:#f5f6fa;">
    <div class="container">
        <h2 class="fw-bold text-center mb-2" style="color:#222;">Best Hotels & Accommodations</h2>
        <p class="text-center mb-4" style="color:#555;">Enjoy the comfort of staying in selected hotels with complete
            facilities and affordable prices.</p>
        <div class="row g-4 justify-content-center" style="background:#f5f6fa; border-radius:1.5rem; padding:2rem 0;">
            @foreach($hotels as $hotel)
                <div class="col-12 col-md-6 d-flex justify-content-center">
                    <div class="card h-100 shadow-sm hotel-card" style="max-width:370px; width:100%;">
                        <img src="{{ asset('photos/' . $hotel['image']) }}" class="card-img-top" alt="{{ $hotel['name'] }}">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-1">{{ $hotel['name'] }}</h5>
                            <p class="mb-2" style="color:#666; font-size:0.97rem;">{{ $hotel['address'] }}</p>
                            <div class="mb-2 d-flex flex-wrap gap-2">
                                @foreach($hotel['facilities'] as $facility)
                                    <span class="badge bg-secondary">{{ $facility }}</span>
                                @endforeach
                            </div>
                            <div class="fw-bold mb-0" style="font-size:1.1rem; color:#12395D;">Rp
                                {{ number_format($hotel['price'], 0, ',', '.') }},00
                            </div>
                            <small class="text-muted">per night</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="#" class="btn fw-bold"
                style="background:#12395D; color:#fff; border-radius:0.5rem; padding:0.5rem 2rem;">See All Hotel</a>
        </div>
    </div>
</section>


<!-- Rental Car Advantages Section -->
<section class="py-4 mb-2" style="background:#fff;">
    <div class="container">
        <h2 class="fw-bold text-center mb-2" style="color:#222;">Trusted Car Rental</h2>
        <p class="text-center mb-2" style="color:#555;">Rent a quality car, a selection of popular options for comfort
            and safe driving.</p>
        <div class="row justify-content-center" style="background:#fff; border-radius:1.5rem; padding:1rem 0 0.5rem 0;">
            @foreach($rentalAdvantages as $advantage)
                <div class="col-12 col-md-3 d-flex flex-column align-items-center text-center mb-2 mb-md-0">
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
<section class="py-5 mt-0" style="background:#fff;">
    <div class="container">
        <div class="row g-4 justify-content-center" style="background:#fff; border-radius:1.5rem; padding:1rem 0;">
            @foreach($cars as $car)
                <div class="col-12 col-md-6 d-flex justify-content-center">
                    <div class="card h-100 shadow-sm hotel-card" style="max-width:370px; width:100%;">
                        <img src="{{ asset('photos/' . $car['image']) }}" class="card-img-top" alt="{{ $car['name'] }}">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-1">{{ $car['name'] }}</h5>
                            <p class="mb-2" style="color:#666; font-size:0.97rem;">{{ $car['spec'] }}</p>
                            <div class="mb-2 d-flex flex-wrap gap-2">
                                @foreach($car['features'] as $feature)
                                    <span class="badge bg-secondary">{{ $feature }}</span>
                                @endforeach
                            </div>
                            <div class="fw-bold mb-0" style="font-size:1.1rem; color:#12395D;">Rp
                                {{ number_format($car['price'], 0, ',', '.') }},00
                            </div>
                            <small class="text-muted">per day</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="#" class="btn fw-bold"
                style="background:#12395D; color:#fff; border-radius:0.5rem; padding:0.5rem 2rem;">See All Car</a>
        </div>
    </div>
</section>

<!-- Special Tour Packages Section -->

<section class="py-5" style="background:#f5f6fa;">
    <div class="container">
        <h2 class="fw-bold text-center mb-2" style="color:#222;">Special Tour Packages</h2>
        <p class="text-center mb-4" style="color:#555;">Enjoy a complete travel experience with attractive packages that
            include accommodation, transportation, and a tour guide.</p>
        <div class="row g-4 justify-content-center" style="background:#f5f6fa; border-radius:1.5rem; padding:2rem 0;">
            @foreach($packages as $package)
                <div class="col-12 col-md-4 col-lg-3 d-flex justify-content-center">
                    <div class="card shadow-sm" style="width:100%; max-width:260px;">
                        <img src="{{ asset('photos/' . $package['image']) }}" class="card-img-top"
                            alt="{{ $package['name'] }}">
                        <div class="card-body">
                            <h6 class="card-title fw-bold mb-1">{{ $package['name'] }}</h6>
                            <p class="mb-0" style="color:#12395D; font-weight:500;">{{ $package['discount'] }} off</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="text-center mt-4">
        <a href="#" class="btn fw-bold"
            style="background:#12395D; color:#fff; border-radius:0.5rem; padding:0.5rem 2rem;">See All Packages</a>
    </div>
    </div>
</section>

<!-- Get Special Offer Section -->
<section class="py-4" style="background:#d2d8df; border-radius:1rem; max-width:90%; margin:2rem auto 0 auto;">
    <div class="container">
        <h2 class="fw-bold text-center mb-2" style="color:#222;">Get Special Offer!</h2>
        <p class="text-center mb-3" style="font-size:0.97rem; color:#222;">Sign up for our newsletter and get up to 40%
            off selected tour packages.</p>
        <form class="d-flex justify-content-center align-items-center gap-2" style="max-width:600px; margin:0 auto;">
            <input type="email" class="form-control" placeholder="Enter your email" style="border-radius:0.5rem;">
            <button type="submit" class="btn btn-light fw-bold"
                style="border-radius:0.5rem; min-width:100px;">Send</button>
        </form>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-5" style="background:#fffff;">
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
</section>

<!-- Chat Section -->
<section class="py-5" style="background:#fff;">
    <div class="container" style="max-width:700px;">
        <h2 class="fw-bold text-center mb-2" style="color:#222;">Live Chat Support</h2>
        <div class="card shadow-sm" style="border-radius:1rem;">
            <div class="card-body" style="background:#f5f6fa; min-height:250px;">
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
</section>


<!-- Roboto font import -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet">
<style>
    .btn,
    .btn-primary,
    .btn-success,
    .btn-outline-secondary,
    .btn-lg,
    .btn-light {
        background-color: #0088FF !important;
        color: #fff !important;
        border: none !important;
        transition: background 0.2s;
    }

    .btn:hover,
    .btn-primary:hover,
    .btn-success:hover,
    .btn-outline-secondary:hover,
    .btn-lg:hover,
    .btn-light:hover {
        background-color: #0066bb !important;
        color: #fff !important;
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

    .destination-card {
        border-radius: 1rem;
        transition: box-shadow 0.3s, transform 0.3s;
    }

    .destination-card:hover {
        box-shadow: var(--bs-box-shadow-lg);
        transform: translateY(-6px) scale(1.03);
        cursor: pointer;
    }

    .card.shadow-sm:hover {
        cursor: pointer;
    }

    .card-img-top {
        border-top-left-radius: 1rem !important;
        border-top-right-radius: 1rem !important;
        height: 180px;
        object-fit: cover;
    }

    .hotel-card {
        border-radius: 1rem;
        transition: box-shadow 0.3s, transform 0.3s;
    }

    .hotel-card:hover {
        box-shadow: var(--bs-box-shadow-lg);
        transform: translateY(-6px) scale(1.03);
        cursor: pointer;
    }

    .hotel-card .card-img-top {
        border-top-left-radius: 1rem !important;
        border-top-right-radius: 1rem !important;
        height: 200px;
        object-fit: cover;
    }
</style>
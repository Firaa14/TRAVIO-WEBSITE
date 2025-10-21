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
            <!-- Destination Cards -->
            <div class="col-12 col-sm-6 col-md-3 d-flex justify-content-center">
                <div class="card destination-card" style="width: 100%; max-width: 220px;">
                    <img src="/photos/destination1.jpg" class="card-img-top" alt="Cultural City Discovery">
                    <div class="card-body text-center">
                        <h6 class="card-title fw-bold mb-1" style="font-size:1.1rem; color:#12395D;">Cultural City
                            Discovery</h6>
                        <p class="card-text text-muted mb-0">15% off</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3 d-flex justify-content-center">
                <div class="card destination-card" style="width: 100%; max-width: 220px;">
                    <img src="/photos/destination2.jpg" class="card-img-top" alt="Mountain Explorer Adventure">
                    <div class="card-body text-center">
                        <h6 class="card-title fw-bold mb-1" style="font-size:1.1rem; color:#12395D;">Mountain Explorer
                            Adventure</h6>
                        <p class="card-text text-muted mb-0">20% off</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3 d-flex justify-content-center">
                <div class="card destination-card" style="width: 100%; max-width: 220px;">
                    <img src="/photos/destination3.jpg" class="card-img-top" alt="Tropical Beach Escape">
                    <div class="card-body text-center">
                        <h6 class="card-title fw-bold mb-1" style="font-size:1.1rem; color:#12395D;">Tropical Beach
                            Escape</h6>
                        <p class="card-text text-muted mb-0">30% off</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3 d-flex justify-content-center">
                <div class="card destination-card" style="width: 100%; max-width: 220px;">
                    <img src="/photos/destination4.jpg" class="card-img-top" alt="Majestic Waterfall Journey">
                    <div class="card-body text-center">
                        <h6 class="card-title fw-bold mb-1" style="font-size:1.1rem; color:#12395D;">Majestic Waterfall
                            Journey</h6>
                        <p class="card-text text-muted mb-0">25% off</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3 d-flex justify-content-center">
                <div class="card destination-card" style="width: 100%; max-width: 220px;">
                    <img src="/photos/destination5.jpg" class="card-img-top" alt="City Lights Nightlife">
                    <div class="card-body text-center">
                        <h6 class="card-title fw-bold mb-1" style="font-size:1.1rem; color:#12395D;">City Lights
                            Nightlife</h6>
                        <p class="card-text text-muted mb-0">10% off</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3 d-flex justify-content-center">
                <div class="card destination-card" style="width: 100%; max-width: 220px;">
                    <img src="/photos/destination6.webp" class="card-img-top" alt="Eco Green Park">
                    <div class="card-body text-center">
                        <h6 class="card-title fw-bold mb-1" style="font-size:1.1rem; color:#12395D;">Eco Green Park</h6>
                        <p class="card-text text-muted mb-0">18% off</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3 d-flex justify-content-center">
                <div class="card destination-card" style="width: 100%; max-width: 220px;">
                    <img src="/photos/destination7.jpg" class="card-img-top" alt="Safari Adventure">
                    <div class="card-body text-center">
                        <h6 class="card-title fw-bold mb-1" style="font-size:1.1rem; color:#12395D;">Safari Adventure
                        </h6>
                        <p class="card-text text-muted mb-0">22% off</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3 d-flex justify-content-center">
                <div class="card destination-card" style="width: 100%; max-width: 220px;">
                    <img src="/photos/destination8.webp" class="card-img-top" alt="Waterfall Trekking">
                    <div class="card-body text-center">
                        <h6 class="card-title fw-bold mb-1" style="font-size:1.1rem; color:#12395D;">Waterfall Trekking
                        </h6>
                        <p class="card-text text-muted mb-0">12% off</p>
                    </div>
                </div>
            </div>
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
            <!-- Hotel 1 -->
            <div class="col-12 col-md-6 d-flex justify-content-center">
                <div class="card h-100 shadow-sm hotel-card" style="max-width:370px; width:100%;">
                    <img src="/photos/hotel1.jpg" class="card-img-top" alt="Grand Malang Hotel">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-1">Grand Malang Hotel</h5>
                        <p class="mb-2" style="color:#666; font-size:0.97rem;">Jl. A. Yani no. 123, Klojen, Kota Malang
                        </p>
                        <div class="mb-2 d-flex flex-wrap gap-2">
                            <span class="badge bg-secondary">Free WiFi</span>
                            <span class="badge bg-secondary">Spa</span>
                            <span class="badge bg-secondary">Restaurant</span>
                            <span class="badge bg-secondary">Swimming Pool</span>
                        </div>
                        <div class="fw-bold mb-0" style="font-size:1.1rem; color:#12395D;">Rp 800.000,00</div>
                        <small class="text-muted">per night</small>
                    </div>
                </div>
            </div>
            <!-- Hotel 2 -->
            <div class="col-12 col-md-6 d-flex justify-content-center">
                <div class="card h-100 shadow-sm hotel-card" style="max-width:370px; width:100%;">
                    <img src="/photos/hotel2.jpg" class="card-img-top" alt="Swiss-Belinn Malang">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-1">Swiss-Belinn Malang</h5>
                        <p class="mb-2" style="color:#666; font-size:0.97rem;">Jl. KH. Agus Salim, Dau, Kab. Malang</p>
                        <div class="mb-2 d-flex flex-wrap gap-2">
                            <span class="badge bg-secondary">Free WiFi</span>
                            <span class="badge bg-secondary">Spa</span>
                            <span class="badge bg-secondary">Restaurant</span>
                            <span class="badge bg-secondary">Swimming Pool</span>
                        </div>
                        <div class="fw-bold mb-0" style="font-size:1.1rem; color:#12395D;">Rp 410.000,00</div>
                        <small class="text-muted">per night</small>
                    </div>
                </div>
            </div>
            <!-- Hotel 3 -->
            <div class="col-12 col-md-6 d-flex justify-content-center">
                <div class="card h-100 shadow-sm hotel-card" style="max-width:370px; width:100%;">
                    <img src="/photos/hotel3.jpg" class="card-img-top" alt="Jiwa Jawa Resort Ijen">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-1">Jiwa Jawa Resort Ijen</h5>
                        <p class="mb-2" style="color:#666; font-size:0.97rem;">Jl. Boulevard Ijen, Klojen, Kota Malang
                        </p>
                        <div class="mb-2 d-flex flex-wrap gap-2">
                            <span class="badge bg-secondary">Free WiFi</span>
                            <span class="badge bg-secondary">Spa</span>
                            <span class="badge bg-secondary">Restaurant</span>
                            <span class="badge bg-secondary">Swimming Pool</span>
                        </div>
                        <div class="fw-bold mb-0" style="font-size:1.1rem; color:#12395D;">Rp 450.000,00</div>
                        <small class="text-muted">per night</small>
                    </div>
                </div>
            </div>
            <!-- Hotel 4 -->
            <div class="col-12 col-md-6 d-flex justify-content-center">
                <div class="card h-100 shadow-sm hotel-card" style="max-width:370px; width:100%;">
                    <img src="/photos/hotel4.jpg" class="card-img-top" alt="Grand Savero Hotel Malang">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-1">Grand Savero Hotel Malang</h5>
                        <p class="mb-2" style="color:#666; font-size:0.97rem;">Jl. Kalibiru no. 45, Kab. Malang</p>
                        <div class="mb-2 d-flex flex-wrap gap-2">
                            <span class="badge bg-secondary">Free WiFi</span>
                            <span class="badge bg-secondary">Spa</span>
                            <span class="badge bg-secondary">Restaurant</span>
                            <span class="badge bg-secondary">Swimming Pool</span>
                        </div>
                        <div class="fw-bold mb-0" style="font-size:1.1rem; color:#12395D;">Rp 550.000,00</div>
                        <small class="text-muted">per night</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="#" class="btn fw-bold"
                style="background:#12395D; color:#fff; border-radius:0.5rem; padding:0.5rem 2rem;">See All Hotel</a>
        </div>
    </div>
</section>

<!-- Car Rentals Section -->
<section class="py-5" style="background:#fff;">
    <div class="container">
        <h2 class="fw-bold text-center mb-2" style="color:#222;">Trusted Car Rental</h2>
        <p class="text-center mb-4" style="color:#555;">Rent a quality car, a selection of popular options for comfort
            and safe driving.</p>
        <div class="row g-4 justify-content-center" style="background:#fff; border-radius:1.5rem; padding:2rem 0;">
            <!-- Car 1 -->
            <div class="col-12 col-md-6 d-flex justify-content-center">
                <div class="card h-100 shadow-sm hotel-card" style="max-width:370px; width:100%;">
                    <img src="/photos/mobil1.jpg" class="card-img-top" alt="Toyota Avanza">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-1">Toyota Avanza</h5>
                        <p class="mb-2" style="color:#666; font-size:0.97rem;">Manual/Automatic, 7 seats, AC, Audio</p>
                        <div class="mb-2 d-flex flex-wrap gap-2">
                            <span class="badge bg-secondary">Free Pickup</span>
                            <span class="badge bg-secondary">Full Tank</span>
                            <span class="badge bg-secondary">Insurance</span>
                        </div>
                        <div class="fw-bold mb-0" style="font-size:1.1rem; color:#12395D;">Rp 350.000,00</div>
                        <small class="text-muted">per day</small>
                    </div>
                </div>
            </div>
            <!-- Car 2 -->
            <div class="col-12 col-md-6 d-flex justify-content-center">
                <div class="card h-100 shadow-sm hotel-card" style="max-width:370px; width:100%;">
                    <img src="/photos/mobil2.jpg" class="card-img-top" alt="Daihatsu Xenia">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-1">Daihatsu Xenia</h5>
                        <p class="mb-2" style="color:#666; font-size:0.97rem;">Manual/Automatic, 7 seats, AC, Audio</p>
                        <div class="mb-2 d-flex flex-wrap gap-2">
                            <span class="badge bg-secondary">Free Pickup</span>
                            <span class="badge bg-secondary">Full Tank</span>
                            <span class="badge bg-secondary">Insurance</span>
                        </div>
                        <div class="fw-bold mb-0" style="font-size:1.1rem; color:#12395D;">Rp 320.000,00</div>
                        <small class="text-muted">per day</small>
                    </div>
                </div>
            </div>
            <!-- Car 3 -->
            <div class="col-12 col-md-6 d-flex justify-content-center">
                <div class="card h-100 shadow-sm hotel-card" style="max-width:370px; width:100%;">
                    <img src="/photos/mobil3.jpg" class="card-img-top" alt="Honda Brio">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-1">Honda Brio</h5>
                        <p class="mb-2" style="color:#666; font-size:0.97rem;">Automatic, 5 seats, AC, Audio</p>
                        <div class="mb-2 d-flex flex-wrap gap-2">
                            <span class="badge bg-secondary">Free Pickup</span>
                            <span class="badge bg-secondary">Full Tank</span>
                            <span class="badge bg-secondary">Insurance</span>
                        </div>
                        <div class="fw-bold mb-0" style="font-size:1.1rem; color:#12395D;">Rp 300.000,00</div>
                        <small class="text-muted">per day</small>
                    </div>
                </div>
            </div>
            <!-- Car 4 -->
            <div class="col-12 col-md-6 d-flex justify-content-center">
                <div class="card h-100 shadow-sm hotel-card" style="max-width:370px; width:100%;">
                    <img src="/photos/mobil4.jpg" class="card-img-top" alt="Suzuki Ertiga">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-1">Suzuki Ertiga</h5>
                        <p class="mb-2" style="color:#666; font-size:0.97rem;">Manual/Automatic, 7 seats, AC, Audio</p>
                        <div class="mb-2 d-flex flex-wrap gap-2">
                            <span class="badge bg-secondary">Free Pickup</span>
                            <span class="badge bg-secondary">Full Tank</span>
                            <span class="badge bg-secondary">Insurance</span>
                        </div>
                        <div class="fw-bold mb-0" style="font-size:1.1rem; color:#12395D;">Rp 330.000,00</div>
                        <small class="text-muted">per day</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="#" class="btn fw-bold"
                style="background:#12395D; color:#fff; border-radius:0.5rem; padding:0.5rem 2rem;">See All Car</a>
        </div>
    </div>
</section>

@include('components.footer')

<!-- Roboto font import -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet">
<style>
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
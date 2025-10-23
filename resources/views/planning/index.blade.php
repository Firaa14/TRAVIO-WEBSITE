<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

@include('components.navbar')
@include('components.heroplanning')
<!-- Section: Pilih Tanggal -->
<div class="container mt-4">
    <div class="card p-4 mb-4">
        <h5>Select Travel Dates</h5>
        <form id="tanggalForm">
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <label for="tanggalBerangkat" class="col-form-label">Departure Date:</label>
                </div>
                <div class="col-auto">
                    <input type="date" class="form-control" id="tanggalBerangkat" name="tanggalBerangkat" required>
                </div>
                <div class="col-auto">
                    <label for="tanggalPulang" class="col-form-label">Return Date:</label>
                </div>
                <div class="col-auto">
                    <input type="date" class="form-control" id="tanggalPulang" name="tanggalPulang" required>
                </div>
            </div>
            <div class="row g-3 align-items-center mt-2">
                <div class="col-auto">
                    <label for="adultCount" class="col-form-label">Adults:</label>
                </div>
                <div class="col-auto">
                    <input type="number" class="form-control" id="adultCount" name="adultCount" min="1" value="1"
                        required>
                </div>
                <div class="col-auto">
                    <label for="childCount" class="col-form-label">Children:</label>
                </div>
                <div class="col-auto">
                    <input type="number" class="form-control" id="childCount" name="childCount" min="0" value="0">
                </div>
                <div class="col-auto">
                    <label for="specialCount" class="col-form-label">Special Needs:</label>
                </div>
                <div class="col-auto">
                    <input type="number" class="form-control" id="specialCount" name="specialCount" min="0" value="0">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>



    <div id="hotelSection" style="display:none;">
        <h5>Hotels Available on <span id="tanggalDipilih"></span></h5>
        <div class="row" id="hotelList">
            <!-- Hotel cards will appear here -->
        </div>
    </div>

</div>

<script>
    // Hide all sections on page load
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('hotelSection').style.display = 'none';
        document.getElementById('destinationSection').style.display = 'none';
        document.getElementById('carRentalSection').style.display = 'none';
        // Hide terms & summary if exist
        var terms = document.getElementById('termsSection');
        if (terms) terms.style.display = 'none';
        var summary = document.getElementById('summarySection');
        if (summary) summary.style.display = 'none';
    });
    // Dummy hotel data, can be replaced with backend data
    // Hotel data key format is YYYY-MM-DD
    const hotelData = {
        '2025-05-10': [
            {
                nama: 'Hotel Santika',
                gambar: '/photos/hotel1.jpg',
                lokasi: 'Jakarta',
                rating: 4.5,
                harga: 'Rp 850.000/malam',
                deskripsi: 'Hotel nyaman di pusat kota.'
            },
            {
                nama: 'Hotel Mulia',
                gambar: '/photos/hotel2.jpg',
                lokasi: 'Jakarta',
                rating: 4.8,
                harga: 'Rp 1.200.000/malam',
                deskripsi: 'Kemewahan dan pelayanan terbaik.'
            }
        ],
        '2025-06-15': [
            {
                nama: 'Hotel Puri',
                gambar: '/photos/hotel1.jpg',
                lokasi: 'Bandung',
                rating: 4.2,
                harga: 'Rp 700.000/malam',
                deskripsi: 'Dekat dengan tempat wisata.'
            }
        ]
    };

    document.getElementById('tanggalForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const tanggalBerangkat = document.getElementById('tanggalBerangkat').value;
        const tanggalPulang = document.getElementById('tanggalPulang').value;
        const adultCount = document.getElementById('adultCount').value;
        if (!tanggalBerangkat || !tanggalPulang || !adultCount) {
            alert('Please fill in travel dates and number of passengers first.');
            return;
        }
        document.getElementById('tanggalDipilih').textContent = `${tanggalBerangkat} - ${tanggalPulang}`;
        document.getElementById('hotelSection').style.display = 'block';
        document.getElementById('destinationSection').style.display = 'block';
        document.getElementById('carRentalSection').style.display = 'block';
        // Hide terms & summary first
        var terms = document.getElementById('termsSection');
        if (terms) terms.style.display = 'none';
        var summary = document.getElementById('summarySection');
        if (summary) summary.style.display = 'none';
        // Show calculate button outside car rental card
        document.getElementById('calculateBtnContainer').style.display = 'block';
        var btn = document.getElementById('btnCalculateAll');
        btn.style.display = 'inline-block';
        btn.onclick = function () {
            var checkedHotel = document.querySelectorAll('.hotel-select:checked').length;
            var checkedDest = document.querySelectorAll('.destination-select:checked').length;
            var checkedCar = document.querySelectorAll('.car-select:checked').length;
            if (checkedHotel + checkedDest + checkedCar === 0) {
                alert('Please select at least one hotel, destination, or car!');
                return;
            }
            if (terms) terms.style.display = 'block';
            if (summary) {
                let total = 0;
                total += checkedHotel * 800000;
                total += checkedCar * 400000;
                document.querySelector('#summarySection .fw-bold:last-child').textContent = 'Rp ' + total.toLocaleString();
                summary.style.display = 'block';
            }
            btn.style.display = 'none';
        };
        // ...render hotel cards as before...
        const hotelList = document.getElementById('hotelList');
        hotelList.innerHTML = `
        <div class="container py-2">
            <div class="d-flex overflow-auto gap-3 pb-2" style="scroll-snap-type:x mandatory;">
                ${[1, 2, 3, 4].map(i => `
                <div class="card hotel-card shadow-sm" style="min-width:260px; max-width:260px; scroll-snap-align:start; position:relative;">
                    <input type="checkbox" class="hotel-select" style="position:absolute; top:10px; left:10px; width:22px; height:22px; z-index:2; cursor:pointer;">
                    <img src="/photos/hotel${i}.jpg" class="card-img-top" style="height:160px; object-fit:cover;" alt="Hotel ${i}">
                    <div class="card-body p-3 text-center d-flex flex-column justify-content-center" style="min-height:140px;">
                        <h6 class="card-title fw-bold mb-1" style="font-size:1.05rem; color:#12395D;">Hotel ${i}</h6>
                        <p class="mb-1" style="color:#666; font-size:0.95rem;">Hotel Address ${i}</p>
                        <div class="mb-1 d-flex flex-wrap gap-1 justify-content-center">
                            <span class="badge bg-secondary" style="font-size:0.8rem;">WiFi</span>
                            <span class="badge bg-secondary" style="font-size:0.8rem;">Spa</span>
                            <span class="badge bg-secondary" style="font-size:0.8rem;">Restaurant</span>
                        </div>
                        <div class="fw-bold mb-0" style="font-size:1rem; color:#12395D;">Rp 800,000</div>
                    </div>
                </div>
                `).join('')}
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="#" class="btn fw-bold"
                style="background:#12395D; color:#fff; border-radius:0.5rem; padding:0.5rem 2rem;">See All Hotels</a>
        </div>
        `;
        // Hotel selection accumulation
        document.querySelectorAll('.hotel-card').forEach(card => {
            const checkbox = card.querySelector('.hotel-select');
            checkbox.addEventListener('click', function (e) {
                e.stopPropagation();
                // update hotel selection
            });
            card.addEventListener('click', function (e) {
                if (e.target.classList.contains('hotel-select')) return;
                alert('Hotel details: ' + card.querySelector('.card-title').innerText);
            });
        });
    });
</script>
<style>
    html,
    html,
    body {
        overflow-x: hidden !important;
        box-sizing: border-box;
    }
    }

    .card.destination-card:hover,
    .card.hotel-card:hover,
    #carRentalCarousel .card:hover {
        cursor: pointer !important;
    }

    .btn,
    .btn-primary,
    .btn-success,
    .btn-outline-secondary,
    .btn-lg {
        background-color: #0088FF !important;
        color: #fff !important;
        border: none !important;
        transition: background 0.2s;
    }

    .btn:hover,
    .btn-primary:hover,
    .btn-success:hover,
    .btn-outline-secondary:hover,
    .btn-lg:hover {
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
</style>

<!-- Section: Tourist Destination Selection -->
<div class="container mt-4">
    <div class="card p-4 mb-4">
        <h5 class="mb-3">Where do you want to travel?</h5>
        <div class="d-flex gap-3 mb-3">
            <button id="btnYes" class="btn btn-success">Yes</button>
            <button id="btnNo" class="btn btn-outline-secondary">No</button>
        </div>
        <div id="destinationSection" style="display:none;">
            <h6 class="mb-3">Popular Tourist Destinations</h6>
            <div id="destinationCarousel" class="d-flex overflow-auto gap-3 pb-2" style="scroll-snap-type:x mandatory;">
                <!-- Destination cards will appear here -->
            </div>
            <div class="text-center mt-4">
                <a href="#" class="btn fw-bold"
                    style="background:#12395D; color:#fff; border-radius:0.5rem; padding:0.5rem 2rem;">See all
                    Destinations</a>
            </div>
        </div>
    </div>
</div>

<script>
    // Dummy tourist destination data
    const destinationData = [
        {
            nama: 'Cultural City Discovery',
            gambar: '/photos/destination1.jpg',
            lokasi: 'Malang',
            deskripsi: 'Explore the culture and history of Malang.'
        },
        {
            nama: 'Mountain Explorer Adventure',
            gambar: '/photos/destination2.jpg',
            lokasi: 'Batu',
            deskripsi: 'Adventure to the beautiful mountains.'
        },
        {
            nama: 'Tropical Beach Escape',
            gambar: '/photos/destination3.jpg',
            lokasi: 'Balekambang Beach',
            deskripsi: 'Relax at the tropical beach.'
        },
        {
            nama: 'Majestic Waterfall Journey',
            gambar: '/photos/destination4.jpg',
            lokasi: 'Coban Rondo',
            deskripsi: 'Visit the majestic waterfall.'
        }
    ];

    document.getElementById('btnYes').addEventListener('click', function () {
        const section = document.getElementById('destinationSection');
        section.style.display = 'block';
        const carousel = document.getElementById('destinationCarousel');
        carousel.innerHTML = destinationData.map((dest, idx) => `
            <div class="destination-card shadow-sm" style="min-width:260px; max-width:260px; scroll-snap-align:start; border-radius:1rem; box-shadow:var(--bs-box-shadow-sm); position:relative;">
                <input type="checkbox" class="destination-select" style="position:absolute; top:10px; left:10px; width:22px; height:22px; z-index:2; cursor:pointer;">
                <img src="${dest.gambar}" class="card-img-top" style="height:160px; object-fit:cover; border-radius:1rem 1rem 0 0;" alt="${dest.nama}">
                <div class="card-body p-3 text-center d-flex flex-column justify-content-center" style="min-height:120px;">
                    <h6 class="card-title fw-bold mb-1" style="font-size:1.05rem; color:#12395D;">${dest.nama}</h6>
                    <p class="mb-1" style="color:#666; font-size:0.95rem;">${dest.lokasi}</p>
                    <div class="mb-1" style="font-size:0.9rem; color:#555;">${dest.deskripsi}</div>
                </div>
            </div>
        `).join('');
        // Destination selection accumulation
        document.querySelectorAll('.destination-card').forEach(card => {
            const checkbox = card.querySelector('.destination-select');
            checkbox.addEventListener('click', function (e) {
                e.stopPropagation();
                // update destination selection
            });
            card.addEventListener('click', function (e) {
                if (e.target.classList.contains('destination-select')) return;
                alert('Destination details: ' + card.querySelector('.card-title').innerText);
            });
        });
    });
    document.getElementById('btnNo').addEventListener('click', function () {
        document.getElementById('destinationSection').style.display = 'none';
    });
</script>

<!-- Section: Car Rental -->
<div class="container mt-4">
    <div class="card p-4 mb-4">
        <h5 class="mb-3">Do you want to rent a car from us?</h5>
        <div class="d-flex gap-3 mb-3">
            <button id="btnCarYes" class="btn btn-success">Yes</button>
            <button id="btnCarNo" class="btn btn-outline-secondary">No</button>
        </div>
        <div id="carRentalSection" style="display:none;">
            <div class="d-flex overflow-auto gap-3 pb-2" id="carRentalCarousel" style="scroll-snap-type:x mandatory;">
                <!-- Car cards will be rendered here -->
            </div>
            <div class="text-center mt-4">
                <a href="#" class="btn fw-bold"
                    style="background:#12395D; color:#fff; border-radius:0.5rem; padding:0.5rem 2rem;">See All Cars</a>
            </div>

        </div>
    </div>
</div>

<script>
    // Dummy data for car rental
    const carRentalData = [
        {
            name: 'Toyota Avanza',
            image: '/photos/mobil1.jpg',
            type: 'MPV',
            seats: 7,
            price: 'Rp 450.000/day',
            description: 'Comfortable family car, fuel efficient.'
        },
        {
            name: 'Honda Brio',
            image: '/photos/mobil2.jpg',
            type: 'City Car',
            seats: 5,
            price: 'Rp 350.000/day',
            description: 'Compact and easy to drive in the city.'
        },
        {
            name: 'Suzuki Ertiga',
            image: '/photos/mobil3.jpg',
            type: 'MPV',
            seats: 7,
            price: 'Rp 400.000/day',
            description: 'Spacious and comfortable for group travel.'
        },
        {
            name: 'Daihatsu Xenia',
            image: '/photos/mobil4.jpg',
            type: 'MPV',
            seats: 7,
            price: 'Rp 420.000/day',
            description: 'Reliable and suitable for long trips.'
        }
    ];

    // Car rental Yes/No logic
    document.getElementById('btnCarYes').addEventListener('click', function () {
        const section = document.getElementById('carRentalSection');
        section.style.display = 'block';
        const carCarousel = document.getElementById('carRentalCarousel');
        carCarousel.innerHTML = carRentalData.map((car, idx) => `
            <div class="card car-card shadow-sm" style="min-width:260px; max-width:260px; scroll-snap-align:start; border-radius:1rem; box-shadow:var(--bs-box-shadow-sm); position:relative;">
                <input type="checkbox" class="car-select" style="position:absolute; top:10px; left:10px; width:22px; height:22px; z-index:2; cursor:pointer;">
                <img src="${car.image}" class="card-img-top" style="height:160px; object-fit:cover; border-radius:1rem 1rem 0 0;" alt="${car.name}">
                <div class="card-body p-3 text-center d-flex flex-column justify-content-center" style="min-height:120px;">
                    <h6 class="card-title fw-bold mb-1" style="font-size:1.05rem; color:#12395D;">${car.name}</h6>
                    <div class="mb-1" style="font-size:0.95rem; color:#666;">${car.type} &bull; ${car.seats} seats</div>
                    <div class="mb-1" style="font-size:0.9rem; color:#555;">${car.description}</div>
                    <div class="fw-bold mb-0 mt-2" style="font-size:1rem; color:#12395D;">${car.price}</div>
                </div>
            </div>
        `).join('');
        // Car selection accumulation
        document.querySelectorAll('.car-card').forEach(card => {
            const checkbox = card.querySelector('.car-select');
            checkbox.addEventListener('click', function (e) {
                e.stopPropagation();
                // update car selection
            });
            card.addEventListener('click', function (e) {
                if (e.target.classList.contains('car-select')) return;
                alert('Car details: ' + card.querySelector('.card-title').innerText);
            });
        });
    });
    document.getElementById('btnCarNo').addEventListener('click', function () {
        document.getElementById('carRentalSection').style.display = 'none';
    });
</script>

<!-- Section: Terms & Conditions and Summary -->
<div class="container mt-4">
    <div id="termsSection" style="display:none;">
        <div class="card p-4 mb-4">
            <h5 class="mb-3">Terms & Conditions for Rental</h5>
            <ul>
                <li>Rental is subject to availability and confirmation.</li>
                <li>Valid ID and payment are required before pickup.</li>
                <li>Driver option includes professional driver service and fuel.</li>
                <li>Without driver option requires a valid driving license.</li>
                <li>Cancellation within 24 hours will incur a 50% fee.</li>
                <li>All prices include basic insurance.</li>
            </ul>
        </div>
    </div>
    <div id="summarySection" style="display:none;">
        <div class="card p-4 mb-4">
            <h6 class="mb-3">Your Selection Summary</h6>
            <div class="mb-2">Hotel: <span class="fw-bold">Grand Malang Hotel</span></div>
            <div class="mb-2">Destination: <span class="fw-bold">Cultural City Discovery</span></div>
            <div class="mb-2">Accommodation: <span class="fw-bold">Luxury Villa Malang</span></div>
            <div class="mb-2">Car Rental: <span class="fw-bold">Toyota Avanza (With Driver)</span></div>
            <div class="mb-2">Total Price: <span class="fw-bold">Rp 3,900,000</span></div>
            <div class="text-end mt-4">
                <button class="btn btn-primary fw-bold" style="padding:0.5rem 2rem;">Continue</button>
            </div>
        </div>
    </div>
</div>

<style>
    .card.destination-card:hover,
    .card.hotel-card:hover,
    #carRentalCarousel .card:hover {
        cursor: pointer !important;
    }
</style>

<div class="text-center mt-4" id="calculateBtnContainer" style="display:none;">
    <button id="btnCalculateAll" class="btn btn-success fw-bold" style="padding:0.8rem 2.3rem; font-size:1rem;">
        Calculate Selection
    </button>
</div>
<div style="height:48px;"></div>

@include('components.footer')
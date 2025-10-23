<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

@include('components.navbar')
@include('components.heroplanning')
<!-- Section: Pilih Tanggal -->
<div class="container mt-4">
    <div class="card p-4 mb-4">
        <h5>Pilih Tanggal Perjalanan</h5>
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
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>

    <div id="hotelSection" style="display:none;">
        <h5>Hotel Tersedia di Tanggal <span id="tanggalDipilih"></span></h5>
        <div class="row" id="hotelList">
            <!-- Hotel cards akan muncul di sini -->
        </div>
    </div>
</div>

<script>
    // Dummy data hotel, bisa diganti dengan data dari backend
    // Format kunci data hotel sekarang YYYY-MM-DD
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
        document.getElementById('tanggalDipilih').textContent = `${tanggalBerangkat} - ${tanggalPulang}`;
        const hotelList = document.getElementById('hotelList');
        hotelList.innerHTML = `
        <div class="container py-2">
            <div class="d-flex overflow-auto gap-3 pb-2" style="scroll-snap-type:x mandatory;">
                <div class="card hotel-card shadow-sm" style="min-width:260px; max-width:260px; scroll-snap-align:start;">
                    <img src="/photos/hotel1.jpg" class="card-img-top" style="height:160px; object-fit:cover;" alt="Grand Malang Hotel">
                    <div class="card-body p-3 text-center d-flex flex-column justify-content-center" style="min-height:140px;">
                        <h6 class="card-title fw-bold mb-1" style="font-size:1.05rem; color:#12395D;">Grand Malang Hotel</h6>
                        <p class="mb-1" style="color:#666; font-size:0.95rem;">Jl. A. Yani no. 123</p>
                        <div class="mb-1 d-flex flex-wrap gap-1 justify-content-center">
                            <span class="badge bg-secondary" style="font-size:0.8rem;">WiFi</span>
                            <span class="badge bg-secondary" style="font-size:0.8rem;">Spa</span>
                            <span class="badge bg-secondary" style="font-size:0.8rem;">Restoran</span>
                        </div>
                        <div class="fw-bold mb-0" style="font-size:1rem; color:#12395D;">Rp 800.000</div>
                    </div>
                </div>
                <div class="card hotel-card shadow-sm" style="min-width:260px; max-width:260px; scroll-snap-align:start;">
                    <img src="/photos/hotel2.jpg" class="card-img-top" style="height:160px; object-fit:cover;" alt="Swiss-Belinn Malang">
                    <div class="card-body p-3 text-center d-flex flex-column justify-content-center" style="min-height:140px;">
                        <h6 class="card-title fw-bold mb-1" style="font-size:1.05rem; color:#12395D;">Swiss-Belinn Malang</h6>
                        <p class="mb-1" style="color:#666; font-size:0.95rem;">Jl. KH. Agus Salim</p>
                        <div class="mb-1 d-flex flex-wrap gap-1 justify-content-center">
                            <span class="badge bg-secondary" style="font-size:0.8rem;">WiFi</span>
                            <span class="badge bg-secondary" style="font-size:0.8rem;">Spa</span>
                            <span class="badge bg-secondary" style="font-size:0.8rem;">Restoran</span>
                        </div>
                        <div class="fw-bold mb-0" style="font-size:1rem; color:#12395D;">Rp 410.000</div>
                    </div>
                </div>
                <div class="card hotel-card shadow-sm" style="min-width:260px; max-width:260px; scroll-snap-align:start;">
                    <img src="/photos/hotel3.jpg" class="card-img-top" style="height:160px; object-fit:cover;" alt="Jiwa Jawa Resort Ijen">
                    <div class="card-body p-3 text-center d-flex flex-column justify-content-center" style="min-height:140px;">
                        <h6 class="card-title fw-bold mb-1" style="font-size:1.05rem; color:#12395D;">Jiwa Jawa Resort Ijen</h6>
                        <p class="mb-1" style="color:#666; font-size:0.95rem;">Jl. Boulevard Ijen</p>
                        <div class="mb-1 d-flex flex-wrap gap-1 justify-content-center">
                            <span class="badge bg-secondary" style="font-size:0.8rem;">WiFi</span>
                            <span class="badge bg-secondary" style="font-size:0.8rem;">Spa</span>
                            <span class="badge bg-secondary" style="font-size:0.8rem;">Restoran</span>
                        </div>
                        <div class="fw-bold mb-0" style="font-size:1rem; color:#12395D;">Rp 450.000</div>
                    </div>
                </div>
                <div class="card hotel-card shadow-sm" style="min-width:260px; max-width:260px; scroll-snap-align:start;">
                    <img src="/photos/hotel4.jpg" class="card-img-top" style="height:160px; object-fit:cover;" alt="Grand Savero Hotel Malang">
                    <div class="card-body p-3 text-center d-flex flex-column justify-content-center" style="min-height:140px;">
                        <h6 class="card-title fw-bold mb-1" style="font-size:1.05rem; color:#12395D;">Grand Savero Hotel Malang</h6>
                        <p class="mb-1" style="color:#666; font-size:0.95rem;">Jl. Kalibiru no. 45</p>
                        <div class="mb-1 d-flex flex-wrap gap-1 justify-content-center">
                            <span class="badge bg-secondary" style="font-size:0.8rem;">WiFi</span>
                            <span class="badge bg-secondary" style="font-size:0.8rem;">Spa</span>
                            <span class="badge bg-secondary" style="font-size:0.8rem;">Restoran</span>
                        </div>
                        <div class="fw-bold mb-0" style="font-size:1rem; color:#12395D;">Rp 550.000</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="#" class="btn fw-bold"
                style="background:#12395D; color:#fff; border-radius:0.5rem; padding:0.5rem 2rem;">See All Hotel</a>
        </div>
        `;
        document.getElementById('hotelSection').style.display = 'block';
    });
</script>
<style>
    .card.destination-card:hover {
        cursor: pointer !important;
    }
</style>

<!-- Section: Pilihan Destinasi Wisata -->
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
                    Destination</a>
            </div>
        </div>
    </div>
</div>

<script>
    // Dummy data destinasi wisata
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
            lokasi: 'Pantai Balekambang',
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
        carousel.innerHTML = destinationData.map(dest => `
            <div class="destination-card shadow-sm" style="min-width:260px; max-width:260px; scroll-snap-align:start; border-radius:1rem; box-shadow:var(--bs-box-shadow-sm);">
                <img src="${dest.gambar}" class="card-img-top" style="height:160px; object-fit:cover; border-radius:1rem 1rem 0 0;" alt="${dest.nama}">
                <div class="card-body p-3 text-center d-flex flex-column justify-content-center" style="min-height:120px;">
                    <h6 class="card-title fw-bold mb-1" style="font-size:1.05rem; color:#12395D;">${dest.nama}</h6>
                    <p class="mb-1" style="color:#666; font-size:0.95rem;">${dest.lokasi}</p>
                    <div class="mb-1" style="font-size:0.9rem; color:#555;">${dest.deskripsi}</div>
                </div>
            </div>
        `).join('');
    });
    document.getElementById('btnNo').addEventListener('click', function () {
        document.getElementById('destinationSection').style.display = 'none';
    });
</script>

@include('components.footer')
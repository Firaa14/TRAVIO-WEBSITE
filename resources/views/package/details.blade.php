@extends('layouts.app')

@section('content')
    @php
        $hideNavbar = true; // sembunyikan navbar
    @endphp

    <style>
        .hero-section {
            position: relative;
            background: url('/photos/hero3.jpg') center/cover no-repeat;
            height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.45);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .back-btn {
            position: absolute;
            top: 20px;
            left: 25px;
            color: white;
            text-decoration: none;
            z-index: 3;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .back-btn:hover {
            text-decoration: underline;
        }

        .tab-menu {
            display: flex;
            justify-content: center;
            border-bottom: 2px solid #dee2e6;
            background-color: #fff;
            margin-top: -50px;
            z-index: 3;
            position: relative;
        }

        .tab-menu button {
            border: none;
            background: none;
            padding: 15px 30px;
            font-weight: 500;
            font-size: 16px;
            color: #6c757d;
            transition: all 0.3s;
        }

        .tab-menu button.active {
            color: #0d6efd;
            border-bottom: 3px solid #0d6efd;
        }

        .tab-content {
            padding: 40px 20px;
            max-width: 900px;
            margin: 0 auto;
        }

        .tab-card {
            background-color: #fff;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            padding: 2rem;
            transition: 0.3s;
        }

        .tab-card:hover {
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        }

        .continue-btn {
            display: block;
            margin: 30px auto 80px;
            padding: 12px 30px;
            font-size: 16px;
        }
    </style>

    <div class="hero-section">
        <div class="hero-overlay"></div>

        <a href="{{ url()->previous() }}" class="back-btn">
            Back
        </a>

        <div class="hero-content">
            <h1 class="fw-bold">Almost There!</h1>
            <p class="lead">One last step to secure your adventure with Travio</p>
        </div>
    </div>

    <!-- Submenu Tabs -->
    <div class="tab-menu shadow-sm">
        <button class="active" data-target="details">Details</button>
        <button data-target="itinerary">Itinerary</button>
        <button data-target="price">Price Details</button>
    </div>

    <!-- Tab Contents -->
    <div class="tab-content" id="tab-contents">
        <!-- Details -->
        <div id="details" class="tab-pane active">
            <div class="tab-card">
                <h3 class="fw-bold mb-3">Package Details</h3>
                <img src="/images/detail1.jpg" class="img-fluid rounded-3 mb-3" alt="Brakseng & Bedengan">
                <p>
                    Paket wisata Brakseng & Bedengan menghadirkan pengalaman berlibur yang menyegarkan
                    dengan pesona alam pegunungan khas Kota Batu, Malang. Perjalanan dimulai di kawasan Brakseng,
                    sebuah dataran tinggi yang dikelilingi hamparan kebun sayur hijau dengan latar belakang Gunung Arjuno.
                </p>
                <ul>
                    <li>Spot foto panorama alam</li>
                    <li>Camping di Bedengan</li>
                    <li>Transportasi lokal</li>
                    <li>Harga mulai Rp50.000</li>
                </ul>
            </div>
        </div>

        <!-- Itinerary -->
        <div id="itinerary" class="tab-pane d-none">
            <div class="tab-card">
                <h3 class="fw-bold mb-3">Itinerary</h3>
                <div class="mb-4">
                    <h5 class="fw-semibold">Day 1 - Welcome to Malang</h5>
                    <p>Selamat datang di Kota Malang! Awali perjalananmu di Coban Rondo Waterfall dan lanjutkan ke Cafe
                        Sawah untuk makan siang.</p>
                </div>
                <div class="mb-4">
                    <h5 class="fw-semibold">Day 2 - Bromo Sunrise Adventure</h5>
                    <p>Rasakan pengalaman melihat matahari terbit di Bromo dan kunjungi Candi Singosari serta Museum Tempo
                        Doeloe.</p>
                </div>
                <div>
                    <h5 class="fw-semibold">Day 3 - Nature & Culture Tour</h5>
                    <p>Eksplorasi pasar Oro-Oro Dowo, jelajahi Alun-Alun Kota, dan nikmati kuliner khas Malang sebelum
                        pulang.</p>
                </div>
            </div>
        </div>

        <!-- Price Details -->
        <div id="price" class="tab-pane d-none">
            <div class="tab-card">
                <h3 class="fw-bold mb-3">Price Details</h3>
                <table class="table table-bordered rounded-3 overflow-hidden">
                    <thead class="table-light">
                        <tr>
                            <th>Item</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tiket masuk</td>
                            <td>Rp 20.000</td>
                        </tr>
                        <tr>
                            <td>Transportasi lokal</td>
                            <td>Rp 30.000</td>
                        </tr>
                        <tr>
                            <td><strong>Total</strong></td>
                            <td><strong>Rp 50.000</strong></td>
                        </tr>
                    </tbody>
                </table>
                <small class="text-muted">*Harga dapat berubah sesuai musim dan kebijakan pengelola.</small>
            </div>
        </div>

        <a href="#" class="btn btn-primary continue-btn rounded-3">Continue</a>
    </div>

    <script>
        const buttons = document.querySelectorAll('.tab-menu button');
        const panes = document.querySelectorAll('.tab-pane');

        buttons.forEach(btn => {
            btn.addEventListener('click', () => {
                buttons.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                panes.forEach(p => p.classList.add('d-none'));
                document.getElementById(btn.dataset.target).classList.remove('d-none');
            });
        });
    </script>
@endsection
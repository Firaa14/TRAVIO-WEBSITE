@extends('layouts.app')
@section('title', 'Checkout Destinasi')

@section('content')
    <div class="container py-5">
        <!-- Step Indicator -->
        <div class="mb-4">
            <ul class="nav nav-pills justify-content-center">
                <li class="nav-item">
                    <button type="button" class="nav-link active" id="step1Tab">Step 1: Tambah Opsi</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" id="step2Tab">Step 2: Data Diri</button>
                </li>
            </ul>
        </div>
        <h3 class="fw-bold mb-4 text-gradient">Checkout Destinasi</h3>

        <div id="step1">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Tambahkan Opsi (Opsional)</h5>
                    <form id="opsiForm">
                        <div class="mb-3">
                            <label class="form-label">Hotel</label>
                            <select name="hotel_id" class="form-select">
                                <option value="">Tidak menambah hotel</option>
                                @foreach($hotels as $hotel)
                                    <option value="{{ $hotel['id'] }}">{{ $hotel['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mobil</label>
                            <select name="car_id" class="form-select">
                                <option value="">Tidak menambah mobil</option>
                                @foreach($cars as $car)
                                    <option value="{{ $car['id'] }}">{{ $car['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Destinasi Lain</label>
                            <select name="destination_id" class="form-select">
                                <option value="">Tidak menambah destinasi</option>
                                @foreach($destinations as $dest)
                                    <option value="{{ $dest['id'] }}">{{ $dest['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="button" class="btn btn-primary w-100" id="nextStepBtn">Lanjut ke Data Diri</button>
                    </form>
                </div>
            </div>
        </div>

        <div id="step2" style="display:none;">
            <form id="checkoutForm" method="POST" action="{{ route('checkout.submit') }}" enctype="multipart/form-data"
                autocomplete="off">
                @csrf
                <div class="card mb-4 shadow-sm animated-card">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3"><i class="bi bi-person-circle me-2"></i>Data Diri Pemesan</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label"><i class="bi bi-person-fill me-1"></i>Nama Lengkap</label>
                                <input type="text" name="full_name" class="form-control input-animated" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><i class="bi bi-whatsapp me-1"></i>No. HP (WhatsApp)</label>
                                <input type="text" name="phone" class="form-control input-animated" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><i class="bi bi-envelope-fill me-1"></i>Email</label>
                                <input type="email" name="email" class="form-control input-animated" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label"><i class="bi bi-gender-ambiguous me-1"></i>Jenis Kelamin</label>
                                <select name="gender" class="form-select input-animated" required>
                                    <option value="" disabled selected>Pilih Gender</option>
                                    <option value="male">Laki-laki</option>
                                    <option value="female">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label"><i class="bi bi-calendar-date me-1"></i>Tanggal Lahir</label>
                                <input type="date" name="dob" class="form-control input-animated" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label"><i class="bi bi-geo-alt-fill me-1"></i>Alamat Lengkap</label>
                                <textarea name="address" rows="2" class="form-control input-animated" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><i class="bi bi-person-bounding-box me-1"></i>Nama Kontak
                                    Darurat</label>
                                <input type="text" name="emergency_name" class="form-control input-animated" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><i class="bi bi-telephone-fill me-1"></i>No. HP Kontak
                                    Darurat</label>
                                <input type="text" name="emergency_phone" class="form-control input-animated" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4 shadow-sm animated-card">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3"><i class="bi bi-geo-alt me-2"></i>Informasi Trip</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Judul Trip</label>
                                <input type="text" name="trip_title" class="form-control" value="" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tanggal / Jadwal Trip</label>
                                <input type="text" name="trip_date" class="form-control" value="" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Harga per Orang</label>
                                <input type="text" name="price" class="form-control" value="" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Jumlah Peserta</label>
                                <input type="number" name="participants" class="form-control" min="1" value="1" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Total Harga</label>
                                <input type="text" name="total_price" class="form-control" value="" readonly
                                    id="totalPrice">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4 shadow-sm animated-card">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3"><i class="bi bi-credit-card-2-front me-2"></i>Pembayaran</h5>
                        <div class="mb-3">
                            <label class="form-label">Metode Pembayaran</label>
                            <select name="payment_method" class="form-select" id="paymentMethod" required>
                                <option value="" disabled selected>Pilih Metode Pembayaran</option>
                                <option value="bank_transfer">Bank Transfer</option>
                                <option value="qris">QRIS</option>
                                <option value="e_wallet">E-wallet (Dana, OVO, Gopay)</option>
                                <option value="cash">Cash di Meeting Point</option>
                            </select>
                        </div>
                        <div id="adminWaInfo" class="alert alert-info d-none">
                            Silakan kirim bukti pembayaran ke admin WhatsApp: <b>+62 812-3456-7890</b>
                        </div>
                        <div class="mb-3" id="paymentProofSection" style="display:none;">
                            <label class="form-label">Upload Bukti Pembayaran</label>
                            <input type="file" name="payment_proof" class="form-control" accept=".jpg,.jpeg,.png,.pdf"
                                required>
                            <small class="text-muted">Max 5MB. Format: JPG, PNG, PDF.</small>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success w-100 py-3 fw-bold btn-animated">Submit Pembayaran</button>
            </form>
            <!-- Toast Notification -->
            <div id="toast"
                class="toast align-items-center text-white bg-success border-0 position-fixed bottom-0 end-0 m-4"
                role="alert" aria-live="assertive" aria-atomic="true" style="display:none;z-index:9999;">
                <div class="d-flex">
                    <div class="toast-body">
                        Pembayaran berhasil! Anda akan diarahkan ke halaman invoice...
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const participantsInput = document.querySelector('input[name="participants"]');
                    const priceInput = document.querySelector('input[name="price"]');
                    const totalPriceInput = document.getElementById('totalPrice');
                    const paymentMethod = document.getElementById('paymentMethod');
                    const adminWaInfo = document.getElementById('adminWaInfo');
                    const paymentProofSection = document.getElementById('paymentProofSection');
                    const checkoutForm = document.getElementById('checkoutForm');
                    const toast = document.getElementById('toast');

                    function updateTotal() {
                        const price = parseInt(priceInput.value.replace(/\D/g, '')) || 0;
                        const qty = parseInt(participantsInput.value) || 1;
                        const total = price * qty;
                        totalPriceInput.value = 'Rp' + total.toLocaleString('id-ID');
                    }
                    if (participantsInput) participantsInput.addEventListener('input', updateTotal);

                    if (paymentMethod) paymentMethod.addEventListener('change', function () {
                        if (this.value) {
                            adminWaInfo.classList.remove('d-none');
                            paymentProofSection.style.display = 'block';
                        } else {
                            adminWaInfo.classList.add('d-none');
                            paymentProofSection.style.display = 'none';
                        }
                    });

                    if (checkoutForm) checkoutForm.addEventListener('submit', function (e) {
                        e.preventDefault();
                        toast.style.display = 'block';
                        setTimeout(function () {
                            checkoutForm.submit();
                        }, 2000);
                    });
                });
            </script>
        </div>
    </div>
    <script>
        const step1Tab = document.getElementById('step1Tab');
        const step2Tab = document.getElementById('step2Tab');
        const step1Div = document.getElementById('step1');
        const step2Div = document.getElementById('step2');
        const nextStepBtn = document.getElementById('nextStepBtn');

        // Step 1 tab click
        step1Tab.onclick = function () {
            step1Div.style.display = 'block';
            step2Div.style.display = 'none';
            step1Tab.classList.add('active');
            step2Tab.classList.remove('active');
        };

        // Step 2 tab click
        step2Tab.onclick = function () {
            // Redirect ke halaman checkout utama
            window.location.href = '/checkout';
        };

        // Next step button
        nextStepBtn.onclick = function () {
            step1Div.style.display = 'none';
            step2Div.style.display = 'block';
            step1Tab.classList.remove('active');
            step2Tab.classList.add('active');
        };
    </script>
@endsection
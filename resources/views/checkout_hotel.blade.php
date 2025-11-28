@extends('layouts.app')
@section('title', 'Checkout Hotel')

@section('content')
    <div class="container py-5">
        <h3 class="fw-bold mb-4 text-gradient">Checkout Hotel</h3>
        <form id="checkoutForm" method="POST" action="{{ route('checkout.hotel.submit') }}" enctype="multipart/form-data"
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
                    <h5 class="fw-bold mb-3"><i class="bi bi-building me-2"></i>Informasi Hotel</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Hotel</label>
                            <input type="text" name="hotel_name" class="form-control" value="" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tipe Kamar</label>
                            <input type="text" name="room_type" class="form-control" value="" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Check-in</label>
                            <input type="text" name="check_in" class="form-control" value="" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Check-out</label>
                            <input type="text" name="check_out" class="form-control" value="" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Harga per Malam</label>
                            <input type="text" name="price_per_night" class="form-control" value="" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Jumlah Malam</label>
                            <input type="number" name="nights" class="form-control" min="1" value="1" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Total Harga</label>
                            <input type="text" name="total_price" class="form-control" value="" readonly id="totalPrice">
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
                            <option value="cash">Cash di Hotel</option>
                        </select>
                    </div>
                    <div id="adminWaInfo" class="alert alert-info d-none">
                        Silakan kirim bukti pembayaran ke admin WhatsApp: <b>+62 812-3456-7890</b>
                    </div>
                    <div class="mb-3" id="paymentProofSection" style="display:none;">
                        <label class="form-label">Upload Bukti Pembayaran</label>
                        <input type="file" name="payment_proof" class="form-control" accept=".jpg,.jpeg,.png,.pdf" required>
                        <small class="text-muted">Max 5MB. Format: JPG, PNG, PDF.</small>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success w-100 py-3 fw-bold btn-animated">Submit Pembayaran</button>
        </form>
        <!-- Toast Notification -->
        <div id="toast" class="toast align-items-center text-white bg-success border-0 position-fixed bottom-0 end-0 m-4"
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
                const nightsInput = document.querySelector('input[name="nights"]');
                const priceInput = document.querySelector('input[name="price_per_night"]');
                const totalPriceInput = document.getElementById('totalPrice');
                const paymentMethod = document.getElementById('paymentMethod');
                const adminWaInfo = document.getElementById('adminWaInfo');
                const paymentProofSection = document.getElementById('paymentProofSection');
                const checkoutForm = document.getElementById('checkoutForm');
                const toast = document.getElementById('toast');

                function updateTotal() {
                    const price = parseInt(priceInput.value.replace(/\D/g, '')) || 0;
                    const nights = parseInt(nightsInput.value) || 1;
                    const total = price * nights;
                    totalPriceInput.value = 'Rp' + total.toLocaleString('id-ID');
                }
                if (nightsInput) nightsInput.addEventListener('input', updateTotal);

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
@endsection
@extends('layouts.app')
@section('title', 'Checkout')

@section('content')
    <div class="container py-5">
        <h3 class="fw-bold mb-4">Checkout</h3>


        <form id="checkoutForm" method="POST" action="{{ route('checkout.submit') }}" enctype="multipart/form-data"
            autocomplete="off">
            @csrf
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Traveler Information</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="full_name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone Number (WhatsApp)</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-select" required>
                                <option value="" disabled selected>Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" name="dob" class="form-control" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Full Address</label>
                            <textarea name="address" rows="2" class="form-control" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Emergency Contact Name</label>
                            <input type="text" name="emergency_name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Emergency Contact Phone</label>
                            <input type="text" name="emergency_phone" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Trip Information</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Trip Title</label>
                            <input type="text" name="trip_title" class="form-control" value="{{ $trip->title ?? '' }}"
                                readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Trip Date / Schedule</label>
                            <input type="text" name="trip_date" class="form-control" value="{{ $trip->schedule ?? '' }}"
                                readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Price per Person</label>
                            <input type="text" name="price" class="form-control"
                                value="{{ number_format($trip->price ?? 0, 0, ',', '.') }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Number of Participants</label>
                            <input type="number" name="participants" class="form-control" min="1" value="1" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Total Price</label>
                            <input type="text" name="total_price" class="form-control"
                                value="{{ number_format($trip->price ?? 0, 0, ',', '.') }}" readonly id="totalPrice">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Payment</h5>
                    <div class="mb-3">
                        <label class="form-label">Payment Method</label>
                        <select name="payment_method" class="form-select" id="paymentMethod" required>
                            <option value="" disabled selected>Select Payment Method</option>
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="qris">QRIS</option>
                            <option value="e_wallet">E-wallet (Dana, OVO, Gopay)</option>
                            <option value="cash">Cash at Meeting Point</option>
                        </select>
                    </div>
                    <div id="adminWaInfo" class="alert alert-info d-none">
                        Please send the payment proof to our admin WhatsApp number: <b>+62 812-3456-7890</b>
                    </div>
                    <div class="mb-3" id="paymentProofSection" style="display:none;">
                        <label class="form-label">Upload Payment Proof</label>
                        <input type="file" name="payment_proof" class="form-control" accept=".jpg,.jpeg,.png,.pdf" required>
                        <small class="text-muted">Max 5MB. Allowed: JPG, PNG, PDF.</small>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success w-100 py-3 fw-bold">Submit Payment</button>
        </form>
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

            function updateTotal() {
                const price = parseInt(priceInput.value.replace(/\D/g, '')) || 0;
                const qty = parseInt(participantsInput.value) || 1;
                const total = price * qty;
                totalPriceInput.value = 'Rp' + total.toLocaleString('id-ID');
            }
            participantsInput.addEventListener('input', updateTotal);

            paymentMethod.addEventListener('change', function () {
                if (this.value) {
                    adminWaInfo.classList.remove('d-none');
                    paymentProofSection.style.display = 'block';
                } else {
                    adminWaInfo.classList.add('d-none');
                    paymentProofSection.style.display = 'none';
                }
            });

            // Tidak ada notifikasi toast di checkout, langsung redirect ke invoice
        });
    </script>
@endsection
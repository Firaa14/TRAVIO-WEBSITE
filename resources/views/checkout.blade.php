@extends('layouts.app')
@section('title', 'Checkout')

@section('content')
    <div class="container py-5">
        <!-- Step Indicator -->
        <div class="mb-4">
        </div>
        <h3 class="fw-bold mb-4 text-gradient">Checkout</h3>

        <form id="checkoutForm" method="POST" action="{{ route('checkout.submit') }}" enctype="multipart/form-data"
            autocomplete="off">
            @csrf
            <div class="card mb-4 shadow-sm animated-card">
                <div class="card-body">
                    <h5 class="fw-bold mb-3"><i class="bi bi-person-circle me-2"></i>Traveler Information</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-person-fill me-1"></i>Full Name</label>
                            <input type="text" name="full_name" class="form-control input-animated" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-whatsapp me-1"></i>Phone Number (WhatsApp)</label>
                            <input type="text" name="phone" class="form-control input-animated" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-envelope-fill me-1"></i>Email Address</label>
                            <input type="email" name="email" class="form-control input-animated" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label"><i class="bi bi-gender-ambiguous me-1"></i>Gender</label>
                            <select name="gender" class="form-select input-animated" required>
                                <option value="" disabled selected>Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label"><i class="bi bi-calendar-date me-1"></i>Date of Birth</label>
                            <input type="date" name="dob" class="form-control input-animated" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label"><i class="bi bi-geo-alt-fill me-1"></i>Full Address</label>
                            <textarea name="address" rows="2" class="form-control input-animated" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-person-bounding-box me-1"></i>Emergency Contact
                                Name</label>
                            <input type="text" name="emergency_name" class="form-control input-animated" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-telephone-fill me-1"></i>Emergency Contact
                                Phone</label>
                            <input type="text" name="emergency_phone" class="form-control input-animated" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4 shadow-sm animated-card">
                <div class="card-body">
                    <h5 class="fw-bold mb-3"><i class="bi bi-geo-alt me-2"></i>Trip Information</h5>
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
            <div class="card mb-4 shadow-sm animated-card">
                <div class="card-body">
                    <h5 class="fw-bold mb-3"><i class="bi bi-credit-card-2-front me-2"></i>Payment</h5>
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
            <button type="submit" class="btn btn-success w-100 py-3 fw-bold btn-animated">Submit Payment</button>
        </form>
    </div>
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

            checkoutForm.addEventListener('submit', function (e) {
                e.preventDefault();
                toast.style.display = 'block';
                setTimeout(function () {
                    checkoutForm.submit();
                }, 2000);
            });
        });
    </script>
    <style>
        .step-indicator {
            display: flex;
            list-style: none;
            padding: 0;
            margin-bottom: 0;
            justify-content: center;
        }

        .step-indicator li {
            position: relative;
            padding: 0 30px 0 0;
            color: #aaa;
            font-weight: 500;
            font-size: 1rem;
            transition: color 0.3s;
        }

        .step-indicator li.active {
            color: #28a745;
        }

        .step-indicator li span {
            background: #28a745;
            color: #fff;
            border-radius: 50%;
            padding: 6px 12px;
            margin-right: 8px;
            font-weight: bold;
            box-shadow: 0 2px 8px rgba(40, 167, 69, 0.15);
        }

        .step-indicator li:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 50%;
            right: 10px;
            width: 30px;
            height: 3px;
            background: #e0e0e0;
            transform: translateY(-50%);
        }

        .text-gradient {
            background: linear-gradient(90deg, #28a745, #20c997);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .animated-card {
            transition: box-shadow 0.3s, transform 0.3s;
        }

        .animated-card:hover {
            box-shadow: 0 8px 32px rgba(40, 167, 69, 0.15);
            transform: translateY(-4px) scale(1.01);
        }

        .input-animated:focus {
            border-color: #28a745;
            box-shadow: 0 0 0 2px rgba(40, 167, 69, 0.15);
            transition: box-shadow 0.2s;
        }

        .btn-animated {
            transition: background 0.3s, transform 0.2s;
        }

        .btn-animated:hover {
            background: linear-gradient(90deg, #28a745, #20c997);
            transform: scale(1.03);
        }
    </style>
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection
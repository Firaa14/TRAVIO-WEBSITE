@extends('layouts.app')

@section('title', 'Register for ' . $trip->title)

@section('content')
    <section class="container py-5 min-vh-100 d-flex justify-content-center align-items-center">
        <div class="col-lg-6 col-md-8 mx-auto">
            <div class="card shadow-lg border-0 rounded-4 p-4">
                <div class="card-body">
                    <h3 class="fw-bold mb-4 text-center text-primary">Register for {{ $trip->title }}</h3>

                    @if(session('success'))
                        <div
                            class="alert alert-success d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
                            <span>{{ session('success') }}</span>
                            <div>
                                @if(session('invoice_url'))
                                    <a href="{{ session('invoice_url') }}"
                                        class="btn btn-outline-primary btn-sm ms-md-3 mt-2 mt-md-0" target="_blank">
                                        <i class="bi bi-download me-1"></i> Unduh Invoice
                                    </a>
                                @else
                                    <button class="btn btn-outline-secondary btn-sm ms-md-3 mt-2 mt-md-0" disabled>
                                        <i class="bi bi-file-earmark-text me-1"></i> Invoice belum tersedia
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('opentrip.register.submit', $trip->id) }}" method="POST" autocomplete="off"
                        enctype="multipart/form-data" id="registerForm">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label fw-semibold">Full Name</label>
                                <input type="text" name="full_name" class="form-control form-control-lg rounded-3"
                                    placeholder="Enter your full name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Phone Number</label>
                                <input type="text" name="phone" class="form-control form-control-lg rounded-3"
                                    placeholder="08xxxxxxxxxx" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email Address</label>
                                <input type="email" name="email" class="form-control form-control-lg rounded-3"
                                    placeholder="your@email.com" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Complete Address</label>
                                <textarea name="address" rows="3" class="form-control form-control-lg rounded-3"
                                    placeholder="Enter your address" required></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Payment Method</label>
                                <select name="payment_method" class="form-select form-select-lg rounded-3" required
                                    id="paymentMethod">
                                    <option value="" disabled selected>Select Payment Method</option>
                                    <option value="bank_transfer">Bank Transfer</option>
                                    <option value="qris">QRIS</option>
                                    <option value="e_wallet">E-Wallet (Dana, OVO, Gopay)</option>
                                    <option value="cash">Cash on Meeting Point</option>
                                </select>
                            </div>
                        </div>
                        <div id="adminContact" class="mb-3 mt-4" style="display:none;">
                            <div class="alert alert-info">
                                <strong>Admin WhatsApp:</strong> <a href="https://wa.me/6281234567890" target="_blank">+62
                                    812-3456-7890</a><br>
                                Silakan transfer sesuai metode pembayaran yang dipilih, lalu upload bukti pembayaran di
                                bawah ini.
                            </div>
                        </div>
                        <div id="uploadSection" class="mb-3" style="display:none;">
                            <label class="form-label fw-semibold">Upload Bukti Pembayaran</label>
                            <input type="file" name="payment_proof" class="form-control form-control-lg rounded-3"
                                accept="image/*,application/pdf" required>
                        </div>
                        <button type="submit" id="submitBtn"
                            class="btn btn-primary w-100 py-3 mt-2 rounded-3 fw-bold shadow-sm" style="display:none;">
                            Submit &amp; Get Invoice <i class="bi bi-file-earmark-text ms-2"></i>
                        </button>
                    </form>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const paymentMethod = document.getElementById('paymentMethod');
                            const adminContact = document.getElementById('adminContact');
                            const uploadSection = document.getElementById('uploadSection');
                            const submitBtn = document.getElementById('submitBtn');
                            paymentMethod.addEventListener('change', function () {
                                if (this.value && this.value !== '') {
                                    adminContact.style.display = 'block';
                                    uploadSection.style.display = 'block';
                                    submitBtn.style.display = 'block';
                                } else {
                                    adminContact.style.display = 'none';
                                    uploadSection.style.display = 'none';
                                    submitBtn.style.display = 'none';
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </section>
@endsection
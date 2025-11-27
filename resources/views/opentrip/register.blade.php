@extends('layouts.app')

@section('title', 'Register for ' . $trip->title)

@section('content')
    <section class="container py-5 min-vh-100 d-flex justify-content-center align-items-center">
        <div class="col-lg-6 col-md-8 mx-auto">
            <div class="card shadow-lg border-0 rounded-4 p-4">
                <div class="card-body">
                    <h3 class="fw-bold mb-4 text-center text-primary">Register for {{ $trip->title }}</h3>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('opentrip.register.submit', $trip->id) }}" method="POST" autocomplete="off">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" name="full_name" class="form-control form-control-lg rounded-3"
                                placeholder="Enter your full name" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Phone Number</label>
                            <input type="text" name="phone" class="form-control form-control-lg rounded-3"
                                placeholder="08xxxxxxxxxx" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email Address</label>
                            <input type="email" name="email" class="form-control form-control-lg rounded-3"
                                placeholder="your@email.com" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Complete Address</label>
                            <textarea name="address" rows="3" class="form-control form-control-lg rounded-3"
                                placeholder="Enter your address" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Payment Method</label>
                            <select name="payment_method" class="form-select form-select-lg rounded-3" required>
                                <option value="" disabled selected>Select Payment Method</option>
                                <option value="bank_transfer">Bank Transfer</option>
                                <option value="qris">QRIS</option>
                                <option value="e_wallet">E-Wallet (Dana, OVO, Gopay)</option>
                                <option value="cash">Cash on Meeting Point</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-3 mt-2 rounded-3 fw-bold shadow-sm">
                            Continue to Payment <i class="bi bi-arrow-right-circle ms-2"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
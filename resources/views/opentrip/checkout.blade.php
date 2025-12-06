@extends('layouts.app')

@section('title', 'Checkout Open Trip | Travio')
@section('content')
    @php
        $hideNavbar = true;
    @endphp

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card shadow-lg border-0" style="border-radius: 16px; overflow: hidden;">
                    <div class="card-header bg-primary text-white py-4">
                        <h3 class="mb-0 fw-bold">
                            <i class="bi bi-credit-card me-2"></i> Checkout - Open Trip
                        </h3>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        {{-- Trip Summary --}}
                        <div class="bg-light p-4 rounded-3 mb-4">
                            <div class="row">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <h5 class="fw-bold text-primary mb-3">
                                        <i class="bi bi-map me-2"></i>Trip Details
                                    </h5>
                                    <h6 class="fw-bold mb-3">{{ $trip['judul'] }}</h6>
                                    <div class="mb-2">
                                        <i class="bi bi-geo-alt text-danger me-2"></i>
                                        <span>{{ $trip['lokasi'] }}</span>
                                    </div>
                                    <div class="mb-2">
                                        <i class="bi bi-calendar-event text-primary me-2"></i>
                                        <span>{{ $trip['tanggal'] }}</span>
                                    </div>
                                    <div class="mb-0">
                                        <i class="bi bi-cash-stack text-success me-2"></i>
                                        <span class="fw-bold">Rp{{ number_format($trip['harga'], 0, ',', '.') }}</span>
                                        <small class="text-muted">/person</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="fw-bold text-primary mb-3">
                                        <i class="bi bi-check-circle me-2"></i>What's Included
                                    </h5>
                                    <ul class="list-unstyled mb-0">
                                        @if(isset($trip['included']))
                                            @foreach($trip['included'] as $item)
                                                <li class="mb-2">
                                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                                    <span>{{ $item }}</span>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        {{-- Checkout Form --}}
                        <form action="{{ route('opentrip.checkout.submit', $trip['id']) }}" method="POST"
                            enctype="multipart/form-data" id="checkoutForm">
                            @csrf

                            <div class="row g-4">
                                {{-- Personal Information --}}
                                <div class="col-md-6">
                                    <h5 class="fw-bold text-dark mb-4">
                                        <i class="bi bi-person-circle me-2"></i>Personal Information
                                    </h5>

                                    <div class="mb-3">
                                        <label for="full_name" class="form-label fw-semibold">Full Name *</label>
                                        <input type="text" class="form-control form-control-lg @error('full_name') is-invalid @enderror"
                                            id="full_name" name="full_name"
                                            value="{{ old('full_name', Auth::user()->name ?? '') }}" 
                                            placeholder="Enter your full name" required>
                                        @error('full_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label fw-semibold">Phone Number *</label>
                                                <input type="text" class="form-control form-control-lg @error('phone') is-invalid @enderror"
                                                    id="phone" name="phone"
                                                    value="{{ old('phone', Auth::user()->phone ?? '') }}" 
                                                    placeholder="08xxxxxxxxxx" required>
                                                @error('phone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label fw-semibold">Email Address *</label>
                                                <input type="email"
                                                    class="form-control form-control-lg @error('email') is-invalid @enderror" id="email"
                                                    name="email" value="{{ old('email', Auth::user()->email ?? '') }}"
                                                    placeholder="your@email.com" required>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="gender" class="form-label fw-semibold">Gender *</label>
                                                <select class="form-select form-select-lg @error('gender') is-invalid @enderror"
                                                    id="gender" name="gender" required>
                                                    <option value="">Select Gender</option>
                                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male
                                                    </option>
                                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>
                                                        Female</option>
                                                </select>
                                                @error('gender')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="dob" class="form-label fw-semibold">Date of Birth *</label>
                                                <input type="date" class="form-control form-control-lg @error('dob') is-invalid @enderror"
                                                    id="dob" name="dob" value="{{ old('dob') }}" required>
                                                @error('dob')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="address" class="form-label fw-semibold">Address *</label>
                                        <textarea class="form-control form-control-lg @error('address') is-invalid @enderror" id="address"
                                            name="address" rows="3" placeholder="Enter your full address" required>{{ old('address') }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="participants" class="form-label fw-semibold">Number of Participants *</label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text"><i class="bi bi-people"></i></span>
                                            <input type="number"
                                                class="form-control @error('participants') is-invalid @enderror"
                                                id="participants" name="participants" value="{{ old('participants', 1) }}"
                                                min="1" required>
                                        </div>
                                        <div class="form-text mt-2">
                                            <i class="bi bi-info-circle me-1"></i>
                                            Price per person: <strong>Rp{{ number_format($trip['harga'], 0, ',', '.') }}</strong>
                                        </div>
                                        @error('participants')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Emergency Contact & Payment --}}
                                <div class="col-md-6">
                                    <h5 class="fw-bold text-dark mb-4">
                                        <i class="bi bi-telephone-fill me-2"></i>Emergency Contact
                                    </h5>

                                    <div class="mb-3">
                                        <label for="emergency_name" class="form-label fw-semibold">Emergency Contact Name *</label>
                                        <input type="text"
                                            class="form-control form-control-lg @error('emergency_name') is-invalid @enderror"
                                            id="emergency_name" name="emergency_name" value="{{ old('emergency_name') }}"
                                            placeholder="Enter emergency contact name" required>
                                        @error('emergency_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="emergency_phone" class="form-label fw-semibold">Emergency Contact Phone *</label>
                                        <input type="text"
                                            class="form-control form-control-lg @error('emergency_phone') is-invalid @enderror"
                                            id="emergency_phone" name="emergency_phone" value="{{ old('emergency_phone') }}"
                                            placeholder="08xxxxxxxxxx" required>
                                        @error('emergency_phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="notes" class="form-label fw-semibold">Special Notes <span class="text-muted">(Optional)</span></label>
                                        <textarea class="form-control form-control-lg @error('notes') is-invalid @enderror" id="notes"
                                            name="notes" rows="3"
                                            placeholder="Any special requests or dietary restrictions...">{{ old('notes') }}</textarea>
                                        @error('notes')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <h5 class="fw-bold text-dark mb-4 mt-5">
                                        <i class="bi bi-credit-card-2-front me-2"></i>Payment Information
                                    </h5>

                                    <div class="mb-3">
                                        <label for="payment_method" class="form-label fw-semibold">Payment Method *</label>
                                        <select class="form-select form-select-lg @error('payment_method') is-invalid @enderror"
                                            id="payment_method" name="payment_method" required>
                                            <option value="">Select Payment Method</option>
                                            <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>
                                                <i class="bi bi-bank"></i> Bank Transfer
                                            </option>
                                            <option value="qris" {{ old('payment_method') == 'qris' ? 'selected' : '' }}>
                                                QRIS
                                            </option>
                                            <option value="e_wallet" {{ old('payment_method') == 'e_wallet' ? 'selected' : '' }}>
                                                E-Wallet (OVO, GoPay, Dana)
                                            </option>
                                            <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>
                                                Cash
                                            </option>
                                        </select>
                                        @error('payment_method')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="payment_proof" class="form-label fw-semibold">Payment Proof *</label>
                                        <input type="file" class="form-control form-control-lg @error('payment_proof') is-invalid @enderror"
                                            id="payment_proof" name="payment_proof" accept=".jpg,.jpeg,.png,.pdf" required>
                                        <div class="form-text mt-2">
                                            <i class="bi bi-info-circle me-1"></i>
                                            Upload payment proof (JPG, PNG, PDF, max 5MB)
                                        </div>
                                        @error('payment_proof')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Payment Instructions --}}
                                    <div class="alert alert-info border-0 shadow-sm">
                                        <h6 class="fw-bold mb-3">
                                            <i class="bi bi-info-circle-fill me-2"></i>Payment Instructions
                                        </h6>
                                        <div class="mb-2">
                                            <i class="bi bi-bank2 me-2"></i>
                                            <strong>Bank Transfer:</strong> BCA 1234567890 a.n. Travio Travel
                                        </div>
                                        <div class="mb-2">
                                            <i class="bi bi-person me-2"></i>
                                            <strong>Price per person:</strong>
                                            <span class="text-primary fw-bold">Rp{{ number_format($trip['harga'], 0, ',', '.') }}</span>
                                        </div>
                                        <div class="mb-3 pb-3 border-bottom">
                                            <i class="bi bi-calculator me-2"></i>
                                            <strong>Total Amount:</strong> 
                                            <span class="fs-5 text-success fw-bold" id="totalAmount">
                                                Rp{{ number_format($trip['harga'], 0, ',', '.') }}
                                            </span>
                                        </div>
                                        <p class="mb-0 small">
                                            <i class="bi bi-exclamation-triangle me-2"></i>
                                            Please upload your payment proof after completing the transfer.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-5">

                            {{-- Submit Button --}}
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary btn-lg px-5 py-3 me-3 shadow-sm" style="border-radius: 12px;">
                                    <i class="bi bi-check-circle-fill me-2"></i> Complete Booking
                                </button>
                                <a href="{{ route('opentrip.show', $trip['id']) }}"
                                    class="btn btn-outline-secondary btn-lg px-5 py-3 shadow-sm" style="border-radius: 12px;">
                                    <i class="bi bi-x-circle me-2"></i> Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div class="toast show" role="alert">
                <div class="toast-header bg-success text-white">
                    <strong class="me-auto">Success</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div class="toast show" role="alert">
                <div class="toast-header bg-danger text-white">
                    <strong class="me-auto">Error</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body">
                    {{ session('error') }}
                </div>
            </div>
        </div>
    @endif

    <script>
        // Calculate total amount based on participants
        document.getElementById('participants').addEventListener('input', function () {
            const pricePerPerson = {{ $trip['harga'] }};
            const participants = parseInt(this.value) || 1;
            const total = pricePerPerson * participants;

            document.getElementById('totalAmount').textContent = 'Rp' + total.toLocaleString('id-ID');
        });
    </script>

@endsection
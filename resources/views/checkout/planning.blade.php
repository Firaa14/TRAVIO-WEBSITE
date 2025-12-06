@extends('layouts.app')

@section('title', 'Checkout Planning | Travio')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="bi bi-credit-card"></i> Checkout - Travel Planning Package</h4>
                    </div>
                    <div class="card-body">
                        {{-- Package Summary --}}
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5>Package Details</h5>
                                <p><strong>{{ $checkoutData['title'] }}</strong></p>
                                <p><i class="bi bi-calendar"></i> {{ date('d M Y', strtotime($checkoutData['trip_date'])) }}
                                    - {{ date('d M Y', strtotime($checkoutData['return_date'])) }}</p>
                                <p><i class="bi bi-clock"></i> {{ $checkoutData['days'] }} days</p>
                                <p><i class="bi bi-people"></i> {{ $checkoutData['guests'] }} guest(s)</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Included Items</h5>
                                <ul class="list-unstyled">
                                    @if(isset($checkoutData['items']['destinations']))
                                        <li><i class="bi bi-geo-alt text-success"></i>
                                            {{ count($checkoutData['items']['destinations']) }} Destination(s)</li>
                                    @endif
                                    @if(isset($checkoutData['items']['hotel']))
                                        <li><i class="bi bi-building text-success"></i>
                                            {{ $checkoutData['items']['hotel']['hotel_name'] }}</li>
                                    @endif
                                    @if(isset($checkoutData['items']['cars']))
                                        <li><i class="bi bi-car-front text-success"></i>
                                            {{ count($checkoutData['items']['cars']) }} Car(s)</li>
                                    @endif
                                </ul>
                                <div class="alert alert-info">
                                    <strong>Total: Rp{{ number_format($checkoutData['total_price'], 0, ',', '.') }}</strong>
                                </div>
                            </div>
                        </div>

                        {{-- Checkout Form --}}
                        <form action="{{ route('checkout.planning.submit') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                {{-- Personal Information --}}
                                <div class="col-md-6">
                                    <h5 class="mb-3">Personal Information</h5>

                                    <div class="mb-3">
                                        <label for="full_name" class="form-label">Full Name *</label>
                                        <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                                            id="full_name" name="full_name"
                                            value="{{ old('full_name', $userData['name'] ?? '') }}" required>
                                        @error('full_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Phone Number *</label>
                                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                                    id="phone" name="phone"
                                                    value="{{ old('phone', $userData['phone'] ?? '') }}" required>
                                                @error('phone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email *</label>
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                                    name="email" value="{{ old('email', $userData['email'] ?? '') }}"
                                                    required>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="gender" class="form-label">Gender *</label>
                                                <select class="form-select @error('gender') is-invalid @enderror"
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
                                                <label for="dob" class="form-label">Date of Birth *</label>
                                                <input type="date" class="form-control @error('dob') is-invalid @enderror"
                                                    id="dob" name="dob" value="{{ old('dob') }}" required>
                                                @error('dob')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address *</label>
                                        <textarea class="form-control @error('address') is-invalid @enderror" id="address"
                                            name="address" rows="3" required>{{ old('address') }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="guests" class="form-label">Number of Guests *</label>
                                        <input type="number" class="form-control @error('guests') is-invalid @enderror"
                                            id="guests" name="guests" value="{{ old('guests', $checkoutData['guests']) }}"
                                            min="1" required>
                                        @error('guests')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Emergency Contact & Payment --}}
                                <div class="col-md-6">
                                    <h5 class="mb-3">Emergency Contact</h5>

                                    <div class="mb-3">
                                        <label for="emergency_name" class="form-label">Emergency Contact Name *</label>
                                        <input type="text"
                                            class="form-control @error('emergency_name') is-invalid @enderror"
                                            id="emergency_name" name="emergency_name" value="{{ old('emergency_name') }}"
                                            required>
                                        @error('emergency_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="emergency_phone" class="form-label">Emergency Contact Phone *</label>
                                        <input type="text"
                                            class="form-control @error('emergency_phone') is-invalid @enderror"
                                            id="emergency_phone" name="emergency_phone" value="{{ old('emergency_phone') }}"
                                            required>
                                        @error('emergency_phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <h5 class="mb-3 mt-4">Payment Information</h5>

                                    <div class="mb-3">
                                        <label for="payment_method" class="form-label">Payment Method *</label>
                                        <select class="form-select @error('payment_method') is-invalid @enderror"
                                            id="payment_method" name="payment_method" required>
                                            <option value="">Select Payment Method</option>
                                            <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                            <option value="qris" {{ old('payment_method') == 'qris' ? 'selected' : '' }}>QRIS
                                            </option>
                                            <option value="e_wallet" {{ old('payment_method') == 'e_wallet' ? 'selected' : '' }}>E-Wallet</option>
                                        </select>
                                        @error('payment_method')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="payment_proof" class="form-label">Payment Proof *</label>
                                        <input type="file" class="form-control @error('payment_proof') is-invalid @enderror"
                                            id="payment_proof" name="payment_proof" accept=".jpg,.jpeg,.png,.pdf" required>
                                        <div class="form-text">Upload payment proof (JPG, PNG, PDF, max 5MB)</div>
                                        @error('payment_proof')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Payment Instructions --}}
                                    <div class="alert alert-warning">
                                        <h6><i class="bi bi-info-circle"></i> Payment Instructions:</h6>
                                        <p class="mb-1"><strong>Bank Transfer:</strong> BCA 1234567890 (Travio Travel)</p>
                                        <p class="mb-1"><strong>Total Amount:</strong>
                                            Rp{{ number_format($checkoutData['total_price'], 0, ',', '.') }}</p>
                                        <p class="mb-0">Please upload your payment proof after transfer.</p>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            {{-- Submit Button --}}
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg px-5">
                                    <i class="bi bi-check-circle"></i> Complete Booking
                                </button>
                                <a href="{{ route('planning') }}" class="btn btn-outline-secondary btn-lg px-4 ms-2">
                                    Cancel
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

@endsection
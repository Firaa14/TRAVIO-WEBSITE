@extends('layouts.app')

@section('title', 'Checkout Planning | Travio')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-primary text-white rounded-top-4">
                        <h4 class="mb-0">
                            <i class="bi bi-credit-card"></i> Checkout - Travel Planning Package
                        </h4>
                    </div>
                    <div class="card-body p-5">
                        
                        {{-- Package Summary --}}
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <h5 class="fw-bold mb-3"><i class="bi bi-suitcase"></i> Package Details</h5>
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item px-0 py-2">
                                        <strong>Travel Period:</strong><br>
                                        {{ date('d M Y', strtotime($checkoutData['leaving_date'])) }} - 
                                        {{ date('d M Y', strtotime($checkoutData['return_date'])) }}
                                    </div>
                                    <div class="list-group-item px-0 py-2">
                                        <strong>Duration:</strong> {{ $checkoutData['days'] }} days
                                    </div>
                                    <div class="list-group-item px-0 py-2">
                                        <strong>Total Guests:</strong> {{ $checkoutData['guests'] }} person(s)
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <h5 class="fw-bold mb-3"><i class="bi bi-check2-square"></i> Included Items</h5>
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item px-0 py-2">
                                        <i class="bi bi-geo-alt text-success"></i> 
                                        <strong>{{ count($checkoutData['destinations']) }} Destination(s)</strong>
                                    </div>
                                    <div class="list-group-item px-0 py-2">
                                        <i class="bi bi-building text-success"></i> 
                                        <strong>{{ $checkoutData['hotel']['hotel_name'] ??  'Hotel' }}</strong>
                                    </div>
                                    @if(count($checkoutData['cars']) > 0)
                                        <div class="list-group-item px-0 py-2">
                                            <i class="bi bi-car-front text-success"></i> 
                                            <strong>{{ count($checkoutData['cars']) }} Car(s)</strong>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="alert alert-info mt-3 mb-0">
                                    <strong>Total Price:</strong><br>
                                    <h4 class="mb-0 text-primary">Rp{{ number_format($checkoutData['pricing']['grand_total'], 0, ',', '.') }}</h4>
                                </div>
                            </div>
                        </div>

                        <hr class="my-5">

                        {{-- Checkout Form --}}
                        <form action="{{ route('checkout.submit') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                {{-- Personal Information --}}
                                <div class="col-lg-6">
                                    <h5 class="fw-bold mb-4"><i class="bi bi-person"></i> Personal Information</h5>

                                    <div class="mb-3">
                                        <label for="full_name" class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                                            id="full_name" name="full_name"
                                            value="{{ old('full_name', $userData['name'] ?? '') }}" required>
                                        @error('full_name')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label fw-semibold">Phone <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                                    id="phone" name="phone"
                                                    value="{{ old('phone', $userData['phone'] ??  '') }}" required>
                                                @error('phone')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                    id="email" name="email" 
                                                    value="{{ old('email', $userData['email'] ?? '') }}" required>
                                                @error('email')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="gender" class="form-label fw-semibold">Gender <span class="text-danger">*</span></label>
                                                <select class="form-select @error('gender') is-invalid @enderror"
                                                    id="gender" name="gender" required>
                                                    <option value="">Select Gender</option>
                                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                                </select>
                                                @error('gender')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="dob" class="form-label fw-semibold">Date of Birth <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control @error('dob') is-invalid @enderror"
                                                    id="dob" name="dob" value="{{ old('dob') }}" required>
                                                @error('dob')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="address" class="form-label fw-semibold">Address <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('address') is-invalid @enderror" 
                                            id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="guests" class="form-label fw-semibold">Number of Guests <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('guests') is-invalid @enderror"
                                            id="guests" name="guests" 
                                            value="{{ old('guests', $checkoutData['guests']) }}" min="1" readonly>
                                        @error('guests')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Emergency Contact & Payment --}}
                                <div class="col-lg-6">
                                    <h5 class="fw-bold mb-4"><i class="bi bi-telephone"></i> Emergency Contact</h5>

                                    <div class="mb-3">
                                        <label for="emergency_name" class="form-label fw-semibold">Contact Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('emergency_name') is-invalid @enderror"
                                            id="emergency_name" name="emergency_name" 
                                            value="{{ old('emergency_name') }}" required>
                                        @error('emergency_name')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="emergency_phone" class="form-label fw-semibold">Contact Phone <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('emergency_phone') is-invalid @enderror"
                                            id="emergency_phone" name="emergency_phone" 
                                            value="{{ old('emergency_phone') }}" required>
                                        @error('emergency_phone')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <h5 class="fw-bold mb-4 mt-5"><i class="bi bi-wallet2"></i> Payment Information</h5>

                                    <div class="mb-3">
                                        <label for="payment_method" class="form-label fw-semibold">Payment Method <span class="text-danger">*</span></label>
                                        <select class="form-select @error('payment_method') is-invalid @enderror"
                                            id="payment_method" name="payment_method" required>
                                            <option value="">Select Payment Method</option>
                                            <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' :  '' }}>Bank Transfer</option>
                                            <option value="qris" {{ old('payment_method') == 'qris' ? 'selected' : '' }}>QRIS</option>
                                            <option value="e_wallet" {{ old('payment_method') == 'e_wallet' ? 'selected' : '' }}>E-Wallet</option>
                                        </select>
                                        @error('payment_method')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="payment_proof" class="form-label fw-semibold">Payment Proof <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control @error('payment_proof') is-invalid @enderror"
                                            id="payment_proof" name="payment_proof" 
                                            accept=".jpg,.jpeg,.png,.pdf" required>
                                        <div class="form-text">JPG, PNG, or PDF (max 5MB)</div>
                                        @error('payment_proof')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Payment Instructions --}}
                                    <div class="alert alert-warning border-warning">
                                        <h6 class="fw-bold"><i class="bi bi-info-circle"></i> Payment Instructions</h6>
                                        <hr class="my-2">
                                        <p class="mb-2"><strong>Bank Transfer:</strong><br>
                                        BCA:  1234567890<br>
                                        A/N: PT Travio Travel</p>
                                        <p class="mb-2"><strong>Total: </strong><br>
                                        <strong class="text-danger">Rp{{ number_format($checkoutData['pricing']['grand_total'], 0, ',', '. ') }}</strong></p>
                                        <p class="mb-0 small text-muted">Upload proof after making the payment.</p>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-5">

                            {{-- Submit Buttons --}}
                            <div class="d-flex gap-3 justify-content-center">
                                <a href="{{ route('planning') }}" class="btn btn-outline-secondary btn-lg px-5">
                                    <i class="bi bi-arrow-left"></i> Back
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg px-5">
                                    <i class="bi bi-check-circle"></i> Complete Booking
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
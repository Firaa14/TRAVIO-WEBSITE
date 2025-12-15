@extends('layouts.app')

@section('title', 'Booking Success | Travio')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-success text-white rounded-top-4">
                        <h4 class="mb-0 text-center">
                            <i class="bi bi-check-circle-fill"></i> Booking Successful!
                        </h4>
                    </div>
                    <div class="card-body p-5 text-center">
                        
                        {{-- Success Icon --}}
                        <div class="mb-4">
                            <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                        </div>
                        
                        {{-- Success Message --}}
                        <h3 class="fw-bold mb-3">Your Travel Planning Booking is Confirmed!</h3>
                        <p class="text-muted mb-4">
                            Thank you for choosing Travio. We have received your booking and payment proof.
                            Our team will process your booking shortly.
                        </p>

                        {{-- Booking Details --}}
                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h5 class="fw-bold mb-3"><i class="bi bi-receipt"></i> Booking Details</h5>
                                <div class="row text-start">
                                    <div class="col-md-6">
                                        <p class="mb-2"><strong>Booking ID:</strong> #{{ $booking->id }}</p>
                                        <p class="mb-2"><strong>Traveler:</strong> {{ $booking->item_data['full_name'] ?? 'N/A' }}</p>
                                        <p class="mb-2"><strong>Email:</strong> {{ $booking->item_data['email'] ?? 'N/A' }}</p>
                                        <p class="mb-2"><strong>Phone:</strong> {{ $booking->item_data['phone'] ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-2"><strong>Travel Period:</strong> 
                                            @if($booking->start_date && $booking->end_date)
                                                {{ $booking->start_date->format('d M Y') }} - {{ $booking->end_date->format('d M Y') }}
                                            @else
                                                N/A
                                            @endif
                                        </p>
                                        <p class="mb-2"><strong>Guests:</strong> {{ $booking->guests }} person(s)</p>
                                        <p class="mb-2"><strong>Total Amount:</strong> <span class="text-success fw-bold">Rp{{ number_format($booking->total_price, 0, ',', '.') }}</span></p>
                                        <p class="mb-2"><strong>Status:</strong> <span class="badge bg-warning">{{ ucfirst($booking->status) }}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Next Steps --}}
                        <div class="alert alert-info">
                            <h6 class="fw-bold"><i class="bi bi-info-circle"></i> What's Next?</h6>
                            <ul class="list-unstyled mb-0 text-start">
                                <li><i class="bi bi-check2"></i> We will verify your payment within 24 hours</li>
                                <li><i class="bi bi-check2"></i> You will receive a confirmation email</li>
                                <li><i class="bi bi-check2"></i> Our travel consultant will contact you for final itinerary</li>
                                <li><i class="bi bi-check2"></i> Check your booking status in your profile</li>
                            </ul>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="d-flex gap-3 justify-content-center mt-4">
                            <a href="{{ route('profile.show') }}" class="btn btn-outline-primary btn-lg">
                                <i class="bi bi-person-circle"></i> View My Bookings
                            </a>
                            <a href="{{ route('planning') }}" class="btn btn-success btn-lg">
                                <i class="bi bi-plus-circle"></i> Plan Another Trip
                            </a>
                        </div>

                        {{-- Contact Support --}}
                        <div class="mt-4">
                            <p class="text-muted small">
                                Need help? Contact our support team at 
                                <a href="mailto:support@travio.com">support@travio.com</a> 
                                or WhatsApp <a href="tel:+6281234567890">+62 812 3456 7890</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Auto redirect to home after 30 seconds --}}
    <script>
        // Optional: Auto redirect after 30 seconds
        // setTimeout(function() {
        //     window.location.href = "{{ route('dashboard') }}";
        // }, 30000);
    </script>
@endsection
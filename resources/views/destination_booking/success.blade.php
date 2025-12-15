@extends('layouts.app')

@section('title', 'Booking Success | Travio')

@section('content')
    @php
        $hideNavbar = true;
    @endphp

    <style>
        .success-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
        }

        .success-card {
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom: 24px;
        }

        .booking-details {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 24px;
            margin-top: 24px;
            text-align: left;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 1px solid #e8e8e8;
        }

        .detail-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .detail-label {
            font-weight: 600;
            color: #555;
            flex: 1;
        }

        .detail-value {
            font-weight: 700;
            color: #1a1a1a;
            flex: 1;
            text-align: right;
        }

        .btn-primary {
            background: linear-gradient(90deg, #1f5eff 60%, #1546c1 100%);
            border: none;
            padding: 14px 24px;
            border-radius: 12px;
            font-weight: 700;
            transition: transform 0.2s;
            margin: 8px;
        }

        .btn-primary:hover {
            transform: scale(1.02);
        }

        .btn-secondary {
            background: linear-gradient(90deg, #6c757d 60%, #495057 100%);
            border: none;
            padding: 14px 24px;
            border-radius: 12px;
            font-weight: 700;
            transition: transform 0.2s;
            margin: 8px;
            color: white;
        }

        .btn-secondary:hover {
            transform: scale(1.02);
            color: white;
        }

        .success-icon {
            color: #28a745;
            font-size: 4rem;
            margin-bottom: 16px;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-confirmed {
            background-color: #d4edda;
            color: #155724;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .next-steps {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            margin-top: 24px;
        }

        .step-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .step-number {
            background: #007bff;
            color: white;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-weight: bold;
            font-size: 0.875rem;
        }
    </style>

    <div class="container py-5">
        <div class="success-container">
            <!-- Success Message -->
            <div class="success-card">
                <i class="bi bi-check-circle success-icon"></i>
                <h2 class="fw-bold text-success mb-3">Booking Successful!</h2>
                <p class="lead text-muted">Your destination booking has been submitted successfully. We will process your
                    request shortly.</p>
                <p class="text-muted">Booking ID: <strong class="text-primary">{{ $booking->booking_id }}</strong></p>

                <!-- Booking Details -->
                <div class="booking-details">
                    <h5 class="fw-bold mb-3 text-primary">Booking Details</h5>

                    @if($booking->destination && $booking->destination->destinasi)
                        <div class="detail-row">
                            <span class="detail-label">Destination:</span>
                            <span class="detail-value">{{ $booking->destination->destinasi->name ?? 'N/A' }}</span>
                        </div>

                        <div class="detail-row">
                            <span class="detail-label">Location:</span>
                            <span class="detail-value">{{ $booking->destination->location ?? 'N/A' }}</span>
                        </div>
                    @endif

                    <div class="detail-row">
                        <span class="detail-label">Customer Name:</span>
                        <span class="detail-value">{{ $booking->full_name }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Email:</span>
                        <span class="detail-value">{{ $booking->email }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Phone:</span>
                        <span class="detail-value">{{ $booking->phone }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Trip Date:</span>
                        <span class="detail-value">{{ \Carbon\Carbon::parse($booking->trip_date)->format('d M Y') }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Participants:</span>
                        <span class="detail-value">{{ $booking->participants }}
                            {{ $booking->participants == 1 ? 'Person' : 'People' }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Payment Method:</span>
                        <span class="detail-value">{{ ucwords(str_replace('_', ' ', $booking->payment_method)) }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Total Amount:</span>
                        <span class="detail-value text-success fw-bold">Rp
                            {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Status:</span>
                        <span class="detail-value">
                            <span
                                class="status-badge {{ $booking->status === 'confirmed' ? 'status-confirmed' : 'status-pending' }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </span>
                    </div>

                    @if($booking->emergency_name)
                        <div class="detail-row">
                            <span class="detail-label">Emergency Contact:</span>
                            <span class="detail-value">{{ $booking->emergency_name }} ({{ $booking->emergency_phone }})</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Next Steps -->
            <div class="next-steps">
                <h4 class="fw-bold mb-4 text-primary">What's Next?</h4>

                <div class="step-item">
                    <div class="step-number">1</div>
                    <div>
                        <h6 class="fw-bold mb-2">Confirmation Email</h6>
                        <p class="text-muted mb-0">You will receive a confirmation email with all booking details within 24
                            hours.</p>
                    </div>
                </div>

                <div class="step-item">
                    <div class="step-number">2</div>
                    <div>
                        <h6 class="fw-bold mb-2">Payment Verification</h6>
                        <p class="text-muted mb-0">Our team will verify your payment and update the booking status
                            accordingly.</p>
                    </div>
                </div>

                <div class="step-item">
                    <div class="step-number">3</div>
                    <div>
                        <h6 class="fw-bold mb-2">Trip Preparation</h6>
                        <p class="text-muted mb-0">We will contact you with detailed itinerary and preparation guidelines
                            before your trip.</p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="text-center mt-4">
                <a href="{{ route('checkout.destination.invoice', $booking->booking_id) }}" class="btn btn-primary">
                    <i class="bi bi-receipt me-2"></i>View Invoice
                </a>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                    <i class="bi bi-house-door me-2"></i>Back to Dashboard
                </a>
                <button onclick="window.print()" class="btn btn-secondary">
                    <i class="bi bi-printer me-2"></i>Print Booking
                </button>
            </div>
        </div>
    </div>

    <style>
        @media print {

            .btn,
            .next-steps {
                display: none !important;
            }

            .container {
                max-width: 100% !important;
                padding: 0 !important;
            }

            .success-container {
                padding: 1rem !important;
            }

            body {
                background: white !important;
            }
        }
    </style>
@endsection
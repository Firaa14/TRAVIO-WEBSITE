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
            justify-content: between;
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
        }

        .btn-primary:hover {
            transform: scale(1.02);
        }

        .success-icon {
            color: #28a745;
            font-size: 4rem;
            margin-bottom: 16px;
        }
    </style>

    <div class="container py-5">
        <div class="success-container">

            <!-- Success Message -->
            <div class="success-card">
                <i class="bi bi-check-circle success-icon"></i>
                <h2 class="fw-bold text-success mb-3">Booking Successful!</h2>
                <p class="lead text-muted">Your car rental booking has been submitted successfully. We will process your
                    request shortly.</p>

                <!-- Booking Details -->
                <div class="booking-details">
                    <h5 class="fw-bold mb-3 text-primary">Booking Details</h5>

                    <div class="detail-row">
                        <span class="detail-label">Car:</span>
                        <span class="detail-value">{{ $booking->car->title }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Renter Name:</span>
                        <span class="detail-value">{{ $booking->renter_name }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Start Date:</span>
                        <span class="detail-value">{{ $booking->start_date->format('d M Y') }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">End Date:</span>
                        <span class="detail-value">{{ $booking->end_date->format('d M Y') }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Duration:</span>
                        <span class="detail-value">{{ $booking->days }} days</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Passengers:</span>
                        <span class="detail-value">{{ $booking->passengers }} person(s)</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Driver Option:</span>
                        <span class="detail-value">{{ $booking->with_driver ? 'With Driver' : 'Self Drive' }}</span>
                    </div>

                    @if(!$booking->with_driver && $booking->driver_name)
                        <div class="detail-row">
                            <span class="detail-label">Driver Name:</span>
                            <span class="detail-value">{{ $booking->driver_name }}</span>
                        </div>
                    @endif

                    <div class="detail-row">
                        <span class="detail-label">Status:</span>
                        <span class="detail-value">
                            <span class="badge bg-warning">{{ ucfirst($booking->status) }}</span>
                        </span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label h5 text-primary">Total Price:</span>
                        <span class="detail-value h5 text-primary">{{ $booking->formatted_total_price }}</span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="row mt-4">
                    <div class="col-md-6 mb-2">
                        <a href="{{ route('cars.index') }}" class="btn btn-outline-primary w-100">
                            <i class="bi bi-arrow-left me-2"></i>Back to Cars
                        </a>
                    </div>
                    <div class="col-md-6 mb-2">
                        <button class="btn btn-primary w-100" onclick="window.print()">
                            <i class="bi bi-printer me-2"></i>Print Invoice
                        </button>
                    </div>
                </div>
            </div>

            <!-- Important Notes -->
            <div class="alert alert-info">
                <h6 class="fw-bold mb-2">Important Notes:</h6>
                <ul class="mb-0">
                    <li>Please keep this booking reference for your records</li>
                    <li>Our team will contact you within 24 hours to confirm the booking</li>
                    <li>Payment instructions will be provided during confirmation</li>
                    <li>Please bring required documents on pickup day</li>
                </ul>
            </div>
        </div>
    </div>

    <style media="print">
        .btn,
        .alert,
        .navbar,
        .footer {
            display: none !important;
        }

        .success-card {
            box-shadow: none;
            border: 1px solid #ddd;
        }
    </style>
@endsection
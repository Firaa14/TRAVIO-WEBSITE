@extends('layouts.app')

@section('title', 'Booking Success | Travio')
@section('content')
@php
    $hideNavbar = true;
@endphp

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-success text-white text-center">
                        <h3 class="mb-0"><i class="bi bi-check-circle-fill"></i> Booking Successful!</h3>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <div class="mb-3">
                                <i class="bi bi-check-circle text-success" style="font-size: 5rem;"></i>
                            </div>
                            <h4 class="text-success">Thank you for your booking!</h4>
                            <p class="text-muted">Your open trip booking has been submitted successfully. We will review
                                your payment and send a confirmation to your email.</p>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mb-3">Booking Details</h5>
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Booking ID:</strong></td>
                                        <td>#{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Trip:</strong></td>
                                        <td>{{ $booking->trip_title }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Location:</strong></td>
                                        <td>{{ $booking->trip_location }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Schedule:</strong></td>
                                        <td>{{ $booking->trip_schedule }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Participants:</strong></td>
                                        <td>{{ $booking->participants }} person(s)</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status:</strong></td>
                                        <td>
                                            <span class="badge bg-warning text-dark">
                                                <i class="bi bi-clock"></i> {{ ucfirst($booking->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-md-6">
                                <h5 class="mb-3">Personal Information</h5>
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Name:</strong></td>
                                        <td>{{ $booking->full_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email:</strong></td>
                                        <td>{{ $booking->email }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Phone:</strong></td>
                                        <td>{{ $booking->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Payment:</strong></td>
                                        <td>{{ strtoupper(str_replace('_', ' ', $booking->payment_method)) }}</td>
                                    </tr>
                                </table>

                                <div class="alert alert-info mt-3">
                                    <h6><i class="bi bi-cash-stack"></i> Total Payment</h6>
                                    <h4 class="mb-0">Rp{{ number_format($booking->total_price, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                        </div>

                        @if($booking->notes)
                            <div class="alert alert-light mt-3">
                                <strong><i class="bi bi-journal-text"></i> Special Notes:</strong><br>
                                {{ $booking->notes }}
                            </div>
                        @endif

                        <hr>

                        <div class="alert alert-warning">
                            <h6><i class="bi bi-info-circle"></i> What's Next?</h6>
                            <ul class="mb-0">
                                <li>We will verify your payment within 1-2 business days</li>
                                <li>You will receive a confirmation email once your payment is verified</li>
                                <li>Please check your profile for booking history and updates</li>
                                <li>For any inquiries, contact us at <strong>info@travio.com</strong> or <strong>+62
                                        812-3456-7890</strong></li>
                            </ul>
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ route('profile.show') }}" class="btn btn-primary btn-lg px-5 me-2">
                                <i class="bi bi-person-circle"></i> View My Bookings
                            </a>
                            <a href="{{ route('opentrip.index') }}" class="btn btn-outline-primary btn-lg px-5">
                                <i class="bi bi-arrow-left"></i> Back to Open Trips
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Booking Confirmation Card --}}
                <div class="card shadow mt-4 d-print-block">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <h5>Share Your Adventure!</h5>
                            <p class="text-muted">Don't forget to share your travel experience in our Gallery section after
                                your trip!</p>
                            <a href="{{ route('gallery.index') }}" class="btn btn-outline-success">
                                <i class="bi bi-camera"></i> Go to Gallery
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {

            .btn,
            .alert-warning {
                display: none !important;
            }
        }
    </style>
@endsection
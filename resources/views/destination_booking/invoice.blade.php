@extends('layouts.app')

@section('title', 'Invoice #' . $booking->booking_id . ' | Travio')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                {{-- Invoice Card --}}
                <div class="card shadow-lg border-0 rounded-4" id="invoice-container">
                    
                    {{-- Header --}}
                    <div class="card-body p-5 border-bottom">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h3 class="fw-bold mb-2">
                                    <i class="bi bi-receipt-cutoff text-primary"></i> INVOICE
                                </h3>
                                <p class="text-muted mb-0">Travio Destination Booking</p>
                            </div>
                            <div class="col-md-6 text-end">
                                <h5 class="text-primary fw-bold mb-2">{{ $booking->booking_id }}</h5>
                                <p class="mb-1"><strong>Invoice Date:</strong> {{ $booking->created_at->format('d M Y') }}</p>
                                <p class="mb-0"><strong>Trip Date:</strong> {{ \Carbon\Carbon::parse($booking->trip_date)->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Billing Info --}}
                    <div class="card-body p-5 border-bottom">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="fw-bold text-uppercase text-secondary mb-3">From</h6>
                                <p class="mb-1"><strong>PT Travio Travel</strong></p>
                                <p class="mb-1">Jl. Sudirman No. 123</p>
                                <p class="mb-1">Jakarta, Indonesia 12190</p>
                                <p class="mb-1"><strong>Phone:</strong> +62 21 1234 5678</p>
                                <p class="mb-0"><strong>Email:</strong> info@travio.com</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold text-uppercase text-secondary mb-3">To</h6>
                                <p class="mb-1"><strong>{{ $booking->full_name }}</strong></p>
                                <p class="mb-1">{{ $booking->address }}</p>
                                <p class="mb-1"><strong>Phone:</strong> {{ $booking->phone }}</p>
                                <p class="mb-0"><strong>Email:</strong> {{ $booking->email }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Trip Details --}}
                    <div class="card-body p-5 border-bottom">
                        <h6 class="fw-bold text-uppercase text-secondary mb-4">Trip Details</h6>
                        <div class="row">
                            <div class="col-md-8">
                                <h5 class="fw-bold text-primary">{{ $booking->trip_title }}</h5>
                                @if($booking->destinasi)
                                    <p class="text-muted mb-3">{{ $booking->destinasi->description }}</p>
                                @endif
                                <div class="mb-3">
                                    <span class="badge bg-primary me-2">
                                        <i class="bi bi-calendar-event me-1"></i>{{ \Carbon\Carbon::parse($booking->trip_date)->format('l, d M Y') }}
                                    </span>
                                    <span class="badge bg-success me-2">
                                        <i class="bi bi-people me-1"></i>{{ $booking->participants }} {{ $booking->participants > 1 ? 'Participants' : 'Participant' }}
                                    </span>
                                </div>
                            </div>
                            @if($booking->destinasi && $booking->destinasi->image)
                                <div class="col-md-4 text-end">
                                    <img src="{{ asset('photos/' . str_replace('photos/', '', $booking->destinasi->image)) }}" 
                                         alt="{{ $booking->trip_title }}" 
                                         class="img-fluid rounded shadow-sm"
                                         style="max-height: 120px; object-fit: cover;">
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Payment Details --}}
                    <div class="card-body p-5 border-bottom">
                        <h6 class="fw-bold text-uppercase text-secondary mb-4">Payment Summary</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>{{ $booking->trip_title }} ({{ $booking->participants }} {{ $booking->participants > 1 ? 'pax' : 'person' }})</td>
                                        <td class="text-end">{{ $booking->participants }} × Rp{{ number_format($booking->price_per_person, 0, ',', '.') }}</td>
                                        <td class="text-end fw-bold">Rp{{ number_format($booking->participants * $booking->price_per_person, 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="table-primary">
                                        <td colspan="2" class="text-end fw-bold fs-5">Total Amount:</td>
                                        <td class="text-end fw-bold fs-5 text-primary">Rp{{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    {{-- Payment Info --}}
                    <div class="card-body p-5 border-bottom">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="fw-bold text-uppercase text-secondary mb-3">Payment Information</h6>
                                <p class="mb-1"><strong>Payment Method:</strong> {{ ucfirst(str_replace('_', ' ', $booking->payment_method)) }}</p>
                                <p class="mb-1"><strong>Payment Status:</strong> 
                                    <span class="badge 
                                        @if($booking->status == 'pending') bg-warning
                                        @elseif($booking->status == 'confirmed') bg-success
                                        @elseif($booking->status == 'cancelled') bg-danger
                                        @else bg-secondary @endif">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </p>
                                @if($booking->payment_proof)
                                    <p class="mb-0">
                                        <a href="{{ asset('storage/' . $booking->payment_proof) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-file-earmark-image me-1"></i>View Payment Proof
                                        </a>
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold text-uppercase text-secondary mb-3">Emergency Contact</h6>
                                <p class="mb-1"><strong>Name:</strong> {{ $booking->emergency_name }}</p>
                                <p class="mb-0"><strong>Phone:</strong> {{ $booking->emergency_phone }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Footer --}}
                    <div class="card-body p-5 text-center">
                        <p class="text-muted mb-3">
                            Thank you for choosing Travio! We hope you have an amazing trip.
                        </p>
                        
                        {{-- Action Buttons --}}
                        <div class="d-flex gap-2 justify-content-center flex-wrap">
                            <button onclick="window.print()" class="btn btn-outline-primary">
                                <i class="bi bi-printer me-1"></i>Print Invoice
                            </button>
                            
                            <a href="{{ route('dashboard') }}" class="btn btn-primary">
                                <i class="bi bi-house me-1"></i>Back to Dashboard
                            </a>
                            
                            @if($booking->status == 'pending')
                                <a href="mailto:info@travio.com?subject=Booking Inquiry - {{ $booking->booking_id }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-envelope me-1"></i>Contact Support
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Print Styles --}}
    <style>
        @media print {
            .navbar, .btn, .no-print {
                display: none !important;
            }
            
            .card {
                box-shadow: none !important;
                border: 1px solid #ddd !important;
            }
        }
    </style>
@endsection
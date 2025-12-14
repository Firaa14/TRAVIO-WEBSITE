@extends('layouts.app')

@section('title', 'Invoice #' . $booking->booking_code .  ' | Travio')

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
                                <p class="text-muted mb-0">Travio Travel Planning Package</p>
                            </div>
                            <div class="col-md-6 text-end">
                                <h5 class="text-primary fw-bold mb-2">{{ $booking->booking_code }}</h5>
                                <p class="mb-1"><strong>Invoice Date:</strong> {{ now()->format('d M Y') }}</p>
                                <p class="mb-0"><strong>Due Date:</strong> {{ now()->addDays(7)->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Billing Info --}}
                    <div class="card-body p-5 border-bottom">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="fw-bold text-uppercase text-secondary mb-3">Bill From</h6>
                                <p class="mb-1"><strong>PT Travio Travel</strong></p>
                                <p class="mb-1">Jl. Sudirman No. 123</p>
                                <p class="mb-1">Jakarta, Indonesia 12190</p>
                                <p class="mb-1"><strong>Phone:</strong> +62 21 1234 5678</p>
                                <p class="mb-0"><strong>Email:</strong> info@travio.com</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold text-uppercase text-secondary mb-3">Bill To</h6>
                                <p class="mb-1"><strong>{{ $booking->full_name }}</strong></p>
                                <p class="mb-1">{{ $booking->address }}</p>
                                <p class="mb-1"><strong>Phone:</strong> {{ $booking->phone }}</p>
                                <p class="mb-0"><strong>Email:</strong> {{ $booking->email }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Booking Details --}}
                    <div class="card-body p-5 border-bottom">
                        <h6 class="fw-bold text-uppercase text-secondary mb-3">Booking Details</h6>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Travel Period:</strong></td>
                                    <td>{{ $booking->formatted_start }} to {{ $booking->formatted_end }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Duration:</strong></td>
                                    <td>{{ $booking->item_data['days'] ??  0 }} days</td>
                                </tr>
                                <tr>
                                    <td><strong>Number of Guests:</strong></td>
                                    <td>{{ $booking->guests }} person(s)</td>
                                </tr>
                                <tr>
                                    <td><strong>Booking Status:</strong></td>
                                    <td><span class="badge bg-warning text-dark">{{ ucfirst($booking->status) }}</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Payment Status:</strong></td>
                                    <td><span class="badge bg-info">{{ ucfirst($booking->payment_status) }}</span></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    {{-- Items Breakdown --}}
                    <div class="card-body p-5 border-bottom">
                        <h6 class="fw-bold text-uppercase text-secondary mb-4">Package Details</h6>
                        
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="table-light">
                                    <tr>
                                        <th>Description</th>
                                        <th class="text-end">Quantity</th>
                                        <th class="text-end">Price/Unit</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    {{-- Destinations --}}
                                    @if(isset($booking->item_data['destinations']) && count($booking->item_data['destinations']) > 0)
                                        @foreach($booking->item_data['destinations'] as $dest)
                                            <tr>
                                                <td>
                                                    <strong>{{ $dest['name'] ?? 'Destination' }}</strong><br>
                                                    <small class="text-muted">Destination Tour Package</small>
                                                </td>
                                                <td class="text-end">1</td>
                                                <td class="text-end">Rp{{ number_format($dest['price'] ?? 0, 0, ',', '.') }}</td>
                                                <td class="text-end"><strong>Rp{{ number_format($dest['price'] ?? 0, 0, ',', '. ') }}</strong></td>
                                            </tr>
                                        @endforeach
                                    @endif

                                    {{-- Hotel --}}
                                    @if(isset($booking->item_data['hotel']))
                                        <tr>
                                            <td>
                                                <strong>{{ $booking->item_data['hotel']['hotel_name'] ?? 'Hotel' }}</strong><br>
                                                <small class="text-muted">{{ $booking->item_data['hotel']['room_name'] ?? 'Room' }} × {{ $booking->item_data['days'] ?? 0 }} nights</small>
                                            </td>
                                            <td class="text-end">{{ $booking->item_data['days'] ?? 0 }}</td>
                                            <td class="text-end">Rp{{ number_format($booking->item_data['hotel']['price'] ?? 0, 0, ',', '.') }}</td>
                                            <td class="text-end">
                                                <strong>Rp{{ number_format(($booking->item_data['hotel']['price'] ?? 0) * ($booking->item_data['days'] ?? 0), 0, ',', '.') }}</strong>
                                            </td>
                                        </tr>
                                    @endif

                                    {{-- Cars --}}
                                    @if(isset($booking->item_data['cars']) && count($booking->item_data['cars']) > 0)
                                        @foreach($booking->item_data['cars'] as $car)
                                            <tr>
                                                <td>
                                                    <strong>{{ $car['name'] ?? 'Car' }}</strong><br>
                                                    <small class="text-muted">Car Rental × {{ $booking->item_data['days'] ??  0 }} days</small>
                                                </td>
                                                <td class="text-end">{{ $booking->item_data['days'] ?? 0 }}</td>
                                                <td class="text-end">Rp{{ number_format($car['price'] ??  0, 0, ',', '.') }}</td>
                                                <td class="text-end">
                                                    <strong>Rp{{ number_format(($car['price'] ?? 0) * ($booking->item_data['days'] ?? 0), 0, ',', '.') }}</strong>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Total --}}
                    <div class="card-body p-5 border-bottom">
                        <div class="row justify-content-end">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td class="text-end"><strong>Subtotal: </strong></td>
                                        <td class="text-end fw-bold">Rp{{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-end"><strong>Tax (0%):</strong></td>
                                        <td class="text-end fw-bold">Rp 0</td>
                                    </tr>
                                    <tr class="border-top">
                                        <td class="text-end"><h5 class="fw-bold mb-0">Total:</h5></td>
                                        <td class="text-end"><h5 class="text-primary fw-bold mb-0">{{ $booking->formatted_price }}</h5></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Payment Info --}}
                    <div class="card-body p-5 border-bottom">
                        <h6 class="fw-bold text-uppercase text-secondary mb-3">Payment Information</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Payment Method:</strong></p>
                                <p class="text-muted mb-3">{{ ucfirst(str_replace('_', ' ', $booking->payment_method)) }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Payment Status:</strong></p>
                                <p><span class="badge bg-info">{{ ucfirst($booking->payment_status) }}</span></p>
                            </div>
                        </div>

                        @if($booking->payment_method == 'bank_transfer')
                            <div class="alert alert-info mt-3 mb-0">
                                <h6 class="fw-bold mb-2">Bank Transfer Details: </h6>
                                <p class="mb-1"><strong>Bank Name:</strong> Bank Central Asia (BCA)</p>
                                <p class="mb-1"><strong>Account Number:</strong> 1234567890</p>
                                <p class="mb-1"><strong>Account Name:</strong> PT Travio Travel</p>
                                <p class="mb-0"><strong>Amount:</strong> {{ $booking->formatted_price }}</p>
                            </div>
                        @endif
                    </div>

                    {{-- Terms --}}
                    <div class="card-body p-5">
                        <h6 class="fw-bold text-uppercase text-secondary mb-3">Terms & Conditions</h6>
                        <p class="text-muted small mb-0">
                            This invoice is issued for the travel planning package as requested. Please ensure payment is made within 7 days from the invoice date.  
                            Any changes or cancellations must be communicated to us immediately.  For any inquiries, please contact our customer service team 
                            at info@travio.com or +62 21 1234 5678.
                        </p>
                    </div>

                </div>

                {{-- Action Buttons --}}
                <div class="d-flex gap-3 justify-content-center mt-5 mb-5">
                    <button onclick="window.print()" class="btn btn-primary btn-lg px-5">
                        <i class="bi bi-printer"></i> Print / Save as PDF
                    </button>
                    <a href="{{ route('booking.success', $booking->id) }}" class="btn btn-outline-primary btn-lg px-5">
                        <i class="bi bi-arrow-left"></i> Back to Booking
                    </a>
                </div>

            </div>
        </div>
    </div>

    <style>
        @media print {
            .btn-lg, . d-flex {
                display: none !important;
            }
            .container {
                max-width: 100% !important;
            }
            .card {
                box-shadow: none !important;
                border: 1px solid #ddd !important;
            }
        }
    </style>
@endsection
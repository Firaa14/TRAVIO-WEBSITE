@extends('layouts. app')

@section('title', 'Booking Success | Travio')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                {{-- Success Message --}}
                <div class="text-center mb-5">
                    <div class="mb-4">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
                    </div>
                    <h2 class="text-success fw-bold">Booking Successful!</h2>
                    <p class="lead text-muted mt-3">
                        Thank you for choosing Travio.  Your travel planning package has been booked successfully.
                    </p>
                </div>

                {{-- Booking Card --}}
                <div class="card shadow-lg border-0 rounded-4 mb-4">
                    <div class="card-header bg-success text-white rounded-top-4">
                        <h5 class="mb-0"><i class="bi bi-receipt"></i> Booking Details</h5>
                    </div>
                    <div class="card-body p-5">
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6 class="fw-bold text-uppercase text-secondary mb-3">Booking Info</h6>
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Booking Code:</strong></td>
                                        <td class="text-end">
                                            <span class="badge bg-primary">{{ $booking->booking_code }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Booking Date:</strong></td>
                                        <td class="text-end">{{ $booking->created_at->format('d M Y, H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Travel Dates:</strong></td>
                                        <td class="text-end">{{ $booking->formatted_start }} - {{ $booking->formatted_end }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Duration:</strong></td>
                                        <td class="text-end">{{ $booking->item_data['days'] }} days</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Guests:</strong></td>
                                        <td class="text-end">{{ $booking->guests }} person(s)</td>
                                    </tr>
                                    <tr class="border-top-2">
                                        <td><strong>Total Amount:</strong></td>
                                        <td class="text-end"><strong class="text-success fs-5">{{ $booking->formatted_price }}</strong></td>
                                    </tr>
                                </table>
                            </div>
                            
                            <div class="col-md-6">
                                <h6 class="fw-bold text-uppercase text-secondary mb-3">Status</h6>
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item px-0 py-2">
                                        <strong>Booking Status:</strong><br>
                                        <span class="badge bg-warning text-dark">{{ ucfirst($booking->status) }}</span>
                                    </div>
                                    <div class="list-group-item px-0 py-2">
                                        <strong>Payment Status: </strong><br>
                                        <span class="badge bg-info">{{ ucfirst($booking->payment_status) }}</span>
                                    </div>
                                    <div class="list-group-item px-0 py-2">
                                        <strong>Payment Method:</strong><br>
                                        <span>{{ ucfirst(str_replace('_', ' ', $booking->payment_method)) }}</span>
                                    </div>
                                </div>

                                <div class="alert alert-info mt-4 mb-0">
                                    <h6 class="fw-bold mb-2"><i class="bi bi-info-circle"></i> Next Steps</h6>
                                    <ol class="mb-0" style="font-size: 14px;">
                                        <li>We'll review your booking within 24 hours</li>
                                        <li>Confirmation email will be sent to {{ $booking->email }}</li>
                                        <li>Our team will contact you for final arrangements</li>
                                        <li>Enjoy your trip! </li>
                                    </ol>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        {{-- Package Includes --}}
                        @if($booking->item_data)
                            <h6 class="fw-bold text-uppercase text-secondary mb-4">Package Includes</h6>
                            <div class="row g-3">
                                {{-- Destinations --}}
                                @if(isset($booking->item_data['destinations']) && count($booking->item_data['destinations']) > 0)
                                    <div class="col-md-4">
                                        <div class="card border-0 bg-light h-100">
                                            <div class="card-body">
                                                <h6 class="card-title fw-bold">
                                                    <i class="bi bi-geo-alt text-primary"></i> Destinations ({{ count($booking->item_data['destinations']) }})
                                                </h6>
                                                <ul class="list-unstyled small">
                                                    @foreach($booking->item_data['destinations'] as $dest)
                                                        <li class="mb-2">
                                                            <strong>{{ $dest['name'] ??  'Destination' }}</strong><br>
                                                            <small class="text-muted">Rp{{ number_format($dest['price'] ?? 0, 0, ',', '.') }}</small>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- Hotel --}}
                                @if(isset($booking->item_data['hotel']))
                                    <div class="col-md-4">
                                        <div class="card border-0 bg-light h-100">
                                            <div class="card-body">
                                                <h6 class="card-title fw-bold">
                                                    <i class="bi bi-building text-primary"></i> Accommodation
                                                </h6>
                                                <p class="mb-1"><strong>{{ $booking->item_data['hotel']['hotel_name'] ??  'Hotel' }}</strong></p>
                                                <p class="mb-2 small text-muted">{{ $booking->item_data['hotel']['room_name'] ?? 'Room' }}</p>
                                                <p class="small">
                                                    Rp{{ number_format($booking->item_data['hotel']['price'] ?? 0, 0, ',', '.') }}/night<br>
                                                    × {{ $booking->item_data['days'] ??  0 }} nights
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- Cars --}}
                                @if(isset($booking->item_data['cars']) && count($booking->item_data['cars']) > 0)
                                    <div class="col-md-4">
                                        <div class="card border-0 bg-light h-100">
                                            <div class="card-body">
                                                <h6 class="card-title fw-bold">
                                                    <i class="bi bi-car-front text-primary"></i> Transportation ({{ count($booking->item_data['cars']) }})
                                                </h6>
                                                <ul class="list-unstyled small">
                                                    @foreach($booking->item_data['cars'] as $car)
                                                        <li class="mb-2">
                                                            <strong>{{ $car['name'] ?? 'Car' }}</strong><br>
                                                            <small class="text-muted">Rp{{ number_format($car['price'] ??  0, 0, ',', '.') }}/day</small>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="d-flex gap-3 justify-content-center mb-5">
                    <a href="{{ route('booking.invoice', $booking->id) }}" class="btn btn-info btn-lg px-5" target="_blank">
                        <i class="bi bi-download"></i> View Invoice
                    </a>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-primary btn-lg px-5">
                        <i class="bi bi-house"></i> Go to Dashboard
                    </a>
                </div>

            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div class="toast show" role="alert">
                <div class="toast-header bg-success text-white">
                    <strong class="me-auto"><i class="bi bi-check-circle"></i> Success</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif
@endsection
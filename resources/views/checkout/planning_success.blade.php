@extends('layouts.app')

@section('title', 'Booking Success | Travio')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-4">
                    <div class="mb-4">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                    </div>
                    <h2 class="text-success mb-2">Booking Successful!</h2>
                    <p class="lead text-muted">Thank you for choosing Travio. Your travel planning package has been booked.
                    </p>
                </div>

                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="bi bi-receipt"></i> Booking Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Booking Information</h6>
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Booking ID:</strong></td>
                                        <td>#{{ $booking->id }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Booking Date:</strong></td>
                                        <td>{{ $booking->created_at->format('d M Y, H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Travel Dates:</strong></td>
                                        <td>{{ $booking->start_date->format('d M Y') }} -
                                            {{ $booking->end_date->format('d M Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Guests:</strong></td>
                                        <td>{{ $booking->guests }} person(s)</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total Amount:</strong></td>
                                        <td><strong class="text-success">{{ $booking->formatted_price }}</strong></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h6>What's Next?</h6>
                                <div class="alert alert-info">
                                    <h6><i class="bi bi-info-circle"></i> Next Steps:</h6>
                                    <ol class="mb-0">
                                        <li>We'll review your booking within 24 hours</li>
                                        <li>You'll receive confirmation via email</li>
                                        <li>Our team will contact you for final arrangements</li>
                                        <li>Enjoy your trip!</li>
                                    </ol>
                                </div>
                            </div>
                        </div>

                        @if(isset($booking->item_data['selectedItems']))
                            <hr>
                            <h6>Package Includes:</h6>
                            <div class="row">
                                @if(isset($booking->item_data['selectedItems']['destinations']))
                                    <div class="col-md-4">
                                        <div class="border rounded p-3 mb-3">
                                            <h6><i class="bi bi-geo-alt text-primary"></i> Destinations</h6>
                                            <ul class="list-unstyled mb-0">
                                                @foreach($booking->item_data['selectedItems']['destinations'] as $destination)
                                                    <li>• {{ $destination['name'] }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                                @if(isset($booking->item_data['selectedItems']['hotel']))
                                    <div class="col-md-4">
                                        <div class="border rounded p-3 mb-3">
                                            <h6><i class="bi bi-building text-primary"></i> Accommodation</h6>
                                            <p class="mb-0">{{ $booking->item_data['selectedItems']['hotel']['hotel_name'] }}</p>
                                            <small
                                                class="text-muted">{{ $booking->item_data['selectedItems']['hotel']['room_name'] }}</small>
                                        </div>
                                    </div>
                                @endif

                                @if(isset($booking->item_data['selectedItems']['cars']))
                                    <div class="col-md-4">
                                        <div class="border rounded p-3 mb-3">
                                            <h6><i class="bi bi-car-front text-primary"></i> Transportation</h6>
                                            <ul class="list-unstyled mb-0">
                                                @foreach($booking->item_data['selectedItems']['cars'] as $car)
                                                    <li>• {{ $car['name'] }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('planning') }}" class="btn btn-primary me-2">
                        <i class="bi bi-plus-circle"></i> Plan Another Trip
                    </a>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">
                        <i class="bi bi-house"></i> Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
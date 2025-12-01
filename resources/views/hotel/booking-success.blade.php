@extends('layouts.app')

@section('title', 'Booking Successful')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Success Message -->
            <div class="bg-white rounded-lg shadow-sm p-8 text-center mb-6">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-4">
                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Booking Successful!</h1>
                <p class="text-gray-600 mb-6">Your hotel booking has been confirmed. You will receive a confirmation email
                    shortly.</p>

                <div class="bg-blue-50 p-4 rounded-lg text-left">
                    <h3 class="font-semibold text-blue-800 mb-2">Booking Reference</h3>
                    <p class="text-blue-600 font-mono text-lg">#{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</p>
                </div>
            </div>

            <!-- Booking Details -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Booking Details</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="font-medium text-gray-800 mb-2">Hotel Information</h4>
                        <div class="space-y-1 text-sm">
                            <p><span class="text-gray-600">Hotel:</span> {{ $booking->hotelDetail->nama }}</p>
                            <p><span class="text-gray-600">Location:</span> {{ $booking->hotelDetail->location }}</p>
                            <p><span class="text-gray-600">Room:</span> {{ $booking->hotelRoom->room_type }}</p>
                        </div>
                    </div>

                    <div>
                        <h4 class="font-medium text-gray-800 mb-2">Stay Details</h4>
                        <div class="space-y-1 text-sm">
                            <p><span class="text-gray-600">Check-in:</span> {{ $booking->check_in->format('d M Y') }}</p>
                            <p><span class="text-gray-600">Check-out:</span> {{ $booking->check_out->format('d M Y') }}</p>
                            <p><span class="text-gray-600">Guests:</span> {{ $booking->guests }}</p>
                            <p><span class="text-gray-600">Nights:</span> {{ $booking->nights }}</p>
                        </div>
                    </div>
                </div>

                <div class="border-t pt-4 mt-4">
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-semibold">Total Amount:</span>
                        <span class="text-2xl font-bold text-green-600">
                            Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Status -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Booking Status</h2>
                <div class="flex items-center">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        {{ $booking->status === 'confirmed' ? 'bg-green-100 text-green-800' :
        ($booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
            'bg-red-100 text-red-800') }}">
                        {{ ucfirst($booking->status) }}
                    </span>
                    <span class="ml-3 text-gray-600">
                        @if($booking->status === 'pending')
                            Your booking is pending confirmation
                        @elseif($booking->status === 'confirmed')
                            Your booking is confirmed
                        @else
                            Your booking has been cancelled
                        @endif
                    </span>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-xl font-semibold mb-4">What's Next?</h2>
                <div class="space-y-3">
                    <p class="text-gray-600">
                        <span class="font-medium">1.</span> You will receive a confirmation email with your booking details
                    </p>
                    <p class="text-gray-600">
                        <span class="font-medium">2.</span> Please arrive at the hotel during check-in hours
                    </p>
                    <p class="text-gray-600">
                        <span class="font-medium">3.</span> Present your booking reference at the front desk
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 mt-6">
                    <a href="{{ route('my.bookings') }}"
                        class="flex-1 bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 text-center transition duration-200">
                        View My Bookings
                    </a>
                    <a href="{{ route('hotels.index') }}"
                        class="flex-1 bg-gray-200 text-gray-800 py-2 px-4 rounded-md hover:bg-gray-300 text-center transition duration-200">
                        Browse More Hotels
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
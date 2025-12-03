@extends('layouts.app')

@section('title', 'Booking Success | Travio')

@section('content')
    @php
        $hideNavbar = true;
    @endphp

    <div class="py-8" style="background: #f8f9fa; min-height: 100vh;">
        <div class="max-w-4xl mx-auto px-8 sm:px-12 lg:px-16">
            <!-- Success Header -->
            <div class="text-center mb-8">
                <div class="bg-green-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Booking Successful!</h1>
                <p class="text-gray-600">Your package booking has been submitted successfully.</p>
            </div>

            <!-- Booking Details Card -->
            <div class="bg-white rounded-xl shadow-lg p-8 border border-blue-100 mb-6">
                <div class="flex items-center justify-between border-b border-blue-100 pb-4 mb-6">
                    <h2 class="text-xl font-semibold text-blue-800">Booking Details</h2>
                    <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                        {{ ucfirst($booking->status) }}
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="space-y-4">
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h3 class="font-semibold text-blue-800 mb-2">Booking Code</h3>
                            <p class="text-xl font-bold text-blue-600">{{ $booking->booking_code }}</p>
                        </div>

                        <div>
                            <h3 class="font-semibold text-gray-800 mb-2">Package Information</h3>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="font-medium text-gray-800">{{ $booking->package->title }}</p>
                                <p class="text-gray-600">{{ $booking->package->description }}</p>
                            </div>
                        </div>

                        <div>
                            <h3 class="font-semibold text-gray-800 mb-2">Travel Details</h3>
                            <div class="bg-gray-50 p-4 rounded-lg space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Travel Date:</span>
                                    <span class="font-medium">{{ $booking->travel_date->format('d M Y') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Number of Travelers:</span>
                                    <span class="font-medium">{{ $booking->number_of_travelers }}
                                        {{ $booking->number_of_travelers == 1 ? 'Person' : 'People' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-4">
                        <div>
                            <h3 class="font-semibold text-gray-800 mb-2">Contact Information</h3>
                            <div class="bg-gray-50 p-4 rounded-lg space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Name:</span>
                                    <span class="font-medium">{{ $booking->customer_name }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Email:</span>
                                    <span class="font-medium">{{ $booking->customer_email }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Phone:</span>
                                    <span class="font-medium">{{ $booking->customer_phone }}</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="font-semibold text-gray-800 mb-2">Price Summary</h3>
                            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-4 rounded-lg border border-blue-200">
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-gray-700">Package Price:</span>
                                        <span>Rp {{ number_format($booking->package->price, 0, ',', '.') }} ×
                                            {{ $booking->number_of_travelers }}</span>
                                    </div>
                                    <hr class="border-blue-200">
                                    <div class="flex justify-between text-lg font-bold text-blue-800">
                                        <span>Total Amount:</span>
                                        <span>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($booking->special_requests)
                            <div>
                                <h3 class="font-semibold text-gray-800 mb-2">Special Requests</h3>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p class="text-gray-700">{{ $booking->special_requests }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Next Steps -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-blue-100 mb-6">
                <h3 class="text-lg font-semibold text-blue-800 mb-4">What's Next?</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="text-center p-4">
                        <div class="bg-blue-100 rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-3">
                            <span class="text-blue-600 font-bold">1</span>
                        </div>
                        <h4 class="font-medium text-gray-800 mb-2">Confirmation</h4>
                        <p class="text-sm text-gray-600">We'll review your booking and send confirmation within 24 hours.
                        </p>
                    </div>
                    <div class="text-center p-4">
                        <div class="bg-blue-100 rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-3">
                            <span class="text-blue-600 font-bold">2</span>
                        </div>
                        <h4 class="font-medium text-gray-800 mb-2">Payment</h4>
                        <p class="text-sm text-gray-600">Payment instructions will be sent to your email.</p>
                    </div>
                    <div class="text-center p-4">
                        <div class="bg-blue-100 rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-3">
                            <span class="text-blue-600 font-bold">3</span>
                        </div>
                        <h4 class="font-medium text-gray-800 mb-2">Enjoy Trip</h4>
                        <p class="text-sm text-gray-600">Get ready for your amazing travel experience!</p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="text-center space-x-4">
                <a href="{{ route('dashboard') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors duration-200">
                    Back to Home
                </a>
                <a href="{{ route('packages.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded-lg transition-colors duration-200">
                    Browse More Packages
                </a>
            </div>
        </div>
    </div>
@endsection
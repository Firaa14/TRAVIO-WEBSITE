@extends('layouts.app')

@section('title', 'Booking Success - ' . $booking->destination->destinasi->name)

@section('content')
    <div class="py-8" style="background: #ffffff; min-height: 100vh;">
        <div class="max-w-4xl mx-auto px-8 sm:px-12 lg:px-16">
            <!-- Success Header -->
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl shadow-lg p-8 mb-8 border border-green-200">
                <div class="text-center">
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-4">
                        <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-green-800 mb-2">Booking Confirmed!</h1>
                    <p class="text-green-700 text-lg">Your destination booking has been successfully submitted.</p>
                    <p class="text-green-600 mt-2">Booking ID: <span
                            class="font-mono font-semibold">{{ $booking->booking_id }}</span></p>
                </div>
            </div>

            <!-- Booking Details -->
            <div class="bg-white rounded-xl shadow-lg border border-blue-100 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6">
                    <h2 class="text-2xl font-bold text-white">Booking Details</h2>
                </div>

                <div class="p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Trip Information -->
                        <div>
                            <h3 class="text-xl font-semibold text-blue-800 mb-4 border-b border-blue-100 pb-2">
                                Trip Information
                            </h3>

                            @if($booking->destination->destinasi->image)
                                <img src="{{ asset('photos/' . $booking->destination->destinasi->image) }}"
                                    alt="{{ $booking->destination->destinasi->name }}"
                                    class="w-full h-48 object-cover rounded-xl mb-4 border-2 border-blue-100">
                            @endif

                            <div class="space-y-3">
                                <div class="flex justify-between items-start">
                                    <span class="text-gray-600 font-medium">Destination:</span>
                                    <span
                                        class="text-blue-800 font-semibold text-right">{{ $booking->destination->destinasi->name }}</span>
                                </div>
                                <div class="flex justify-between items-start">
                                    <span class="text-gray-600 font-medium">Location:</span>
                                    <span class="text-gray-800 text-right">{{ $booking->destination->location }}</span>
                                </div>
                                <div class="flex justify-between items-start">
                                    <span class="text-gray-600 font-medium">Trip Date:</span>
                                    <span
                                        class="text-gray-800 text-right">{{ \Carbon\Carbon::parse($booking->trip_date)->format('d F Y') }}</span>
                                </div>
                                <div class="flex justify-between items-start">
                                    <span class="text-gray-600 font-medium">Participants:</span>
                                    <span class="text-gray-800 text-right">{{ $booking->participants }}
                                        person{{ $booking->participants > 1 ? 's' : '' }}</span>
                                </div>
                                <div class="flex justify-between items-start">
                                    <span class="text-gray-600 font-medium">Price per person:</span>
                                    <span class="text-gray-800 text-right">Rp
                                        {{ number_format($booking->price_per_person, 0, ',', '.') }}</span>
                                </div>
                                <div class="border-t border-blue-100 pt-3">
                                    <div class="flex justify-between items-start">
                                        <span class="text-blue-800 font-bold text-lg">Total Price:</span>
                                        <span class="text-green-600 font-bold text-xl">Rp
                                            {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Personal Information -->
                        <div>
                            <h3 class="text-xl font-semibold text-blue-800 mb-4 border-b border-blue-100 pb-2">
                                Traveler Information
                            </h3>
                            <div class="space-y-3">
                                <div class="flex justify-between items-start">
                                    <span class="text-gray-600 font-medium">Full Name:</span>
                                    <span class="text-gray-800 text-right">{{ $booking->full_name }}</span>
                                </div>
                                <div class="flex justify-between items-start">
                                    <span class="text-gray-600 font-medium">Email:</span>
                                    <span class="text-gray-800 text-right">{{ $booking->email }}</span>
                                </div>
                                <div class="flex justify-between items-start">
                                    <span class="text-gray-600 font-medium">Phone:</span>
                                    <span class="text-gray-800 text-right">{{ $booking->phone }}</span>
                                </div>
                                <div class="flex justify-between items-start">
                                    <span class="text-gray-600 font-medium">Gender:</span>
                                    <span class="text-gray-800 text-right">{{ ucfirst($booking->gender) }}</span>
                                </div>
                                <div class="flex justify-between items-start">
                                    <span class="text-gray-600 font-medium">Date of Birth:</span>
                                    <span
                                        class="text-gray-800 text-right">{{ \Carbon\Carbon::parse($booking->dob)->format('d F Y') }}</span>
                                </div>
                                <div class="flex justify-between items-start">
                                    <span class="text-gray-600 font-medium">Address:</span>
                                    <span class="text-gray-800 text-right max-w-xs">{{ $booking->address }}</span>
                                </div>
                            </div>

                            <!-- Emergency Contact -->
                            <h4 class="text-lg font-semibold text-blue-800 mt-6 mb-3 border-b border-blue-100 pb-1">
                                Emergency Contact
                            </h4>
                            <div class="space-y-3">
                                <div class="flex justify-between items-start">
                                    <span class="text-gray-600 font-medium">Name:</span>
                                    <span class="text-gray-800 text-right">{{ $booking->emergency_name }}</span>
                                </div>
                                <div class="flex justify-between items-start">
                                    <span class="text-gray-600 font-medium">Phone:</span>
                                    <span class="text-gray-800 text-right">{{ $booking->emergency_phone }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Information -->
                    <div class="mt-8 pt-6 border-t border-blue-100">
                        <h3 class="text-xl font-semibold text-blue-800 mb-4">Payment Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-3">
                                <div class="flex justify-between items-start">
                                    <span class="text-gray-600 font-medium">Payment Method:</span>
                                    <span
                                        class="text-gray-800 text-right">{{ ucfirst(str_replace('_', ' ', $booking->payment_method)) }}</span>
                                </div>
                                <div class="flex justify-between items-start">
                                    <span class="text-gray-600 font-medium">Status:</span>
                                    <span class="inline-flex px-3 py-1 rounded-full text-sm font-medium 
                                            {{ $booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
        ($booking->status === 'confirmed' ? 'bg-green-100 text-green-800' :
            'bg-gray-100 text-gray-800') }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </div>
                            </div>
                            @if($booking->payment_proof)
                                <div>
                                    <span class="text-gray-600 font-medium block mb-2">Payment Proof:</span>
                                    <a href="{{ asset('storage/' . $booking->payment_proof) }}" target="_blank"
                                        class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-800 rounded-lg hover:bg-blue-200 transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        View Document
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Next Steps -->
            <div class="mt-8 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl shadow-lg p-8 border border-blue-200">
                <h3 class="text-xl font-semibold text-blue-800 mb-4">What's Next?</h3>
                <div class="space-y-4 text-gray-700">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                            <span class="text-blue-600 font-semibold text-sm">1</span>
                        </div>
                        <div>
                            <p class="font-medium text-blue-800">Payment Verification</p>
                            <p class="text-sm">Our team will verify your payment proof within 1-2 business days.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                            <span class="text-blue-600 font-semibold text-sm">2</span>
                        </div>
                        <div>
                            <p class="font-medium text-blue-800">Confirmation Email</p>
                            <p class="text-sm">You'll receive a confirmation email with detailed trip information.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                            <span class="text-blue-600 font-semibold text-sm">3</span>
                        </div>
                        <div>
                            <p class="font-medium text-blue-800">Trip Preparation</p>
                            <p class="text-sm">We'll send you a detailed packing list and meeting point information.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('checkout.destinasi.invoice', $booking->booking_id) }}"
                    class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V4a2 2 0 00-2-2H6zm1 2a1 1 0 000 2h6a1 1 0 100-2H7zm6 7a1 1 0 01-1 1H8a1 1 0 110-2h4a1 1 0 011 1zm-1 3a1 1 0 100-2H8a1 1 0 100 2h4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Download Invoice
                </a>
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center justify-center px-6 py-3 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Back to Dashboard
                </a>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('title', 'Hotel Checkout - ' . $hotelDetail->nama)

@section('content')
    <div class="py-8" style="background: #ffffff; min-height: 100vh;">
        <div class="max-w-7xl mx-auto px-8 sm:px-12 lg:px-16">
            <!-- Header -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-6 border border-blue-100">
                <div class="flex items-center mb-4">
                    <button onclick="goBack()"
                        class="text-blue-600 hover:text-blue-800 hover:bg-blue-100 mr-4 bg-blue-50 p-2 rounded-lg transition-all duration-200 cursor-pointer transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50"
                        title="Go back to previous page">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                    </button>
                    <h1 class="text-3xl font-bold text-gray-800">
                        <span class="text-blue-600">Hotel</span> Checkout
                    </h1>
                </div>
                <div class="border-t border-blue-100 pt-4">
                    <div class="flex items-center space-x-6">
                        <div class="text-sm text-gray-600 bg-blue-50 px-3 py-2 rounded-lg">
                            <span class="font-medium text-blue-800">Hotel:</span> {{ $hotelDetail->nama }}
                        </div>
                        <div class="text-sm text-gray-600 bg-blue-50 px-3 py-2 rounded-lg">
                            <span class="font-medium text-blue-800">Location:</span> {{ $hotelDetail->location }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
                <!-- Hotel & Room Details -->
                <div class="bg-white rounded-xl shadow-lg p-8 border border-blue-100">
                    <h2 class="text-xl font-semibold mb-4 text-blue-800 border-b border-blue-100 pb-2">Booking Details</h2>
                    <!-- Hotel Info -->
                    <div class="mb-6">
                        @if($hotelDetail->headerImage)
                            <img src="{{ asset('photos/' . $hotelDetail->headerImage) }}" alt="{{ $hotelDetail->nama }}"
                                class="w-full h-56 object-cover rounded-xl mb-6 border-2 border-blue-100 shadow-md">
                        @endif

                        <h3 class="text-lg font-semibold text-blue-800">{{ $hotelDetail->nama }}</h3>
                        <p class="text-gray-600 mb-2 flex items-center">
                            <svg class="w-4 h-4 inline mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            {{ $hotelDetail->location }}
                        </p>

                        @if($hotelDetail->rating)
                            <div class="flex items-center mb-2 bg-blue-50 inline-flex px-3 py-1 rounded-lg">
                                <div class="flex text-yellow-400">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $hotelDetail->rating)
                                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                                <path
                                                    d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4 text-gray-300 fill-current" viewBox="0 0 20 20">
                                                <path
                                                    d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                            </svg>
                                        @endif
                                    @endfor
                                </div>
                                <span
                                    class="ml-2 text-sm text-gray-700 font-medium">({{ number_format($hotelDetail->rating, 1) }})</span>
                            </div>
                        @endif
                    </div>

                    <!-- Room Info -->
                    <div class="border-t border-blue-100 pt-6 mt-6">
                        <h4 class="font-semibold text-lg mb-4 text-blue-800">Room Details</h4>
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-6 rounded-xl border border-blue-100">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h5 class="font-medium text-gray-800">{{ $hotelRoom->room_type }}</h5>
                                    <p class="text-sm text-gray-600 flex items-center mt-1">
                                        <svg class="w-4 h-4 mr-1 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd">
                                            </path>
                                        </svg>
                                        Capacity: {{ $hotelRoom->capacity }} guests
                                    </p>
                                </div>
                                <div class="text-right bg-white p-3 rounded-lg shadow-sm border border-blue-200">
                                    <p class="text-lg font-semibold text-blue-700">
                                        Rp {{ number_format($hotelRoom->price, 0, ',', '.') }}
                                    </p>
                                    <p class="text-sm text-blue-500">per night</p>
                                </div>
                            </div>

                            @if($hotelRoom->facilities)
                                <div class="mt-3 bg-white p-3 rounded-lg">
                                    <p class="text-sm font-medium text-blue-800 mb-1">Facilities:</p>
                                    <p class="text-sm text-gray-600">{{ $hotelRoom->facilities }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Booking Form -->
                <div class="bg-white rounded-xl shadow-lg p-8 border border-blue-100">
                    <h2 class="text-xl font-semibold mb-4 text-blue-800 border-b border-blue-100 pb-2">Complete Your Booking
                    </h2>

                    <form action="{{ route('hotel.booking.store') }}" method="POST" id="bookingForm">
                        @csrf
                        <input type="hidden" name="hotel_id" value="{{ $hotelDetail->id }}">
                        <input type="hidden" name="room_id" value="{{ $hotelRoom->id }}">

                        <!-- Check-in Date -->
                        <div class="mb-4">
                            <label for="check_in" class="block text-sm font-medium text-blue-800 mb-2">
                                <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Check-in Date
                            </label>
                            <input type="date" id="check_in" name="check_in" value="{{ old('check_in') }}"
                                min="{{ date('Y-m-d') }}"
                                class="w-full px-4 py-3 border-2 border-blue-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('check_in') border-red-400 @enderror"
                                required>
                            @error('check_in')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Check-out Date -->
                        <div class="mb-4">
                            <label for="check_out" class="block text-sm font-medium text-blue-800 mb-2">
                                <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Check-out Date
                            </label>
                            <input type="date" id="check_out" name="check_out" value="{{ old('check_out') }}"
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                class="w-full px-4 py-3 border-2 border-blue-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('check_out') border-red-400 @enderror"
                                required>
                            @error('check_out')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Number of Guests -->
                        <div class="mb-6">
                            <label for="guests" class="block text-sm font-medium text-blue-800 mb-2">
                                <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z">
                                    </path>
                                </svg>
                                Number of Guests
                            </label>
                            <select id="guests" name="guests"
                                class="w-full px-4 py-3 border-2 border-blue-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('guests') border-red-400 @enderror"
                                required>
                                @for($i = 1; $i <= $hotelRoom->capacity; $i++)
                                    <option value="{{ $i }}" {{ old('guests') == $i ? 'selected' : '' }}>
                                        {{ $i }} Guest{{ $i > 1 ? 's' : '' }}
                                    </option>
                                @endfor
                            </select>
                            @error('guests')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Price Summary -->
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-5 rounded-xl mb-6 border-2 border-blue-200"
                            id="priceSummary" style="display: none;">
                            <h4 class="font-semibold text-blue-800 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z">
                                    </path>
                                </svg>
                                Price Summary
                            </h4>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between items-center p-2 bg-white rounded-lg">
                                    <span class="text-gray-700">Price per night:</span>
                                    <span class="font-medium text-blue-700">Rp
                                        {{ number_format($hotelRoom->price, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center p-2 bg-white rounded-lg">
                                    <span class="text-gray-700" id="nightsText">Number of nights:</span>
                                    <span class="font-medium text-blue-700" id="nightsCount">-</span>
                                </div>
                                <div class="border-t-2 border-blue-300 pt-3 mt-3">
                                    <div class="flex justify-between items-center bg-blue-600 text-white p-3 rounded-lg">
                                        <span class="font-semibold">Total Price:</span>
                                        <span id="totalPrice" class="text-xl font-bold">Rp 0</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Error Messages -->
                        @if($errors->has('error'))
                            <div class="bg-red-50 border-2 border-red-200 text-red-700 px-4 py-3 rounded-xl mb-4">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $errors->first('error') }}
                                </div>
                            </div>
                        @endif

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white py-4 px-6 rounded-xl font-semibold text-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
                            id="submitBtn" disabled>
                            <span class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Complete Booking
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Function to handle back button
            function goBack() {
                // Check if there's a previous page in browser history
                if (document.referrer && document.referrer !== window.location.href) {
                    // Check if the referrer is from the same domain
                    const referrerDomain = new URL(document.referrer).hostname;
                    const currentDomain = window.location.hostname;

                    if (referrerDomain === currentDomain) {
                        // Go back to previous page if it's from same domain
                        window.history.back();
                    } else {
                        // Otherwise go to dashboard
                        window.location.href = '{{ route("dashboard") }}';
                    }
                } else {
                    // If no referrer, try to go to hotel detail page or dashboard
                    const hotelId = {{ $hotelDetail->hotel_id }};
                    if (hotelId) {
                        window.location.href = '{{ url("hotels") }}/' + hotelId;
                    } else {
                        window.location.href = '{{ route("dashboard") }}';
                    }
                }
            }

            document.addEventListener('DOMContentLoaded', function () {
                const checkInInput = document.getElementById('check_in');
                const checkOutInput = document.getElementById('check_out');
                const guestsInput = document.getElementById('guests');
                const priceSummary = document.getElementById('priceSummary');
                const nightsCount = document.getElementById('nightsCount');
                const totalPrice = document.getElementById('totalPrice');
                const submitBtn = document.getElementById('submitBtn');
                const roomId = {{ $hotelRoom->id }};

                function updateCheckOutMin() {
                    if (checkInInput.value) {
                        const checkInDate = new Date(checkInInput.value);
                        checkInDate.setDate(checkInDate.getDate() + 1);
                        const minCheckOut = checkInDate.toISOString().split('T')[0];
                        checkOutInput.min = minCheckOut;

                        if (checkOutInput.value && checkOutInput.value <= checkInInput.value) {
                            checkOutInput.value = minCheckOut;
                        }
                    }
                }

                function calculatePrice() {
                    const checkIn = checkInInput.value;
                    const checkOut = checkOutInput.value;

                    if (checkIn && checkOut && checkIn < checkOut) {
                        fetch('{{ route("hotel.booking.calculate.price") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                room_id: roomId,
                                check_in: checkIn,
                                check_out: checkOut
                            })
                        })
                            .then(response => response.json())
                            .then(data => {
                                nightsCount.textContent = data.nights + ' night' + (data.nights > 1 ? 's' : '');
                                totalPrice.textContent = data.formatted_total;
                                priceSummary.style.display = 'block';
                                submitBtn.disabled = false;
                            })
                            .catch(error => {
                                console.error('Error calculating price:', error);
                                priceSummary.style.display = 'none';
                                submitBtn.disabled = true;
                            });
                    } else {
                        priceSummary.style.display = 'none';
                        submitBtn.disabled = true;
                    }
                }

                checkInInput.addEventListener('change', function () {
                    updateCheckOutMin();
                    calculatePrice();
                });

                checkOutInput.addEventListener('change', calculatePrice);
                guestsInput.addEventListener('change', calculatePrice);

                // Set initial min date for check-in
                checkInInput.min = new Date().toISOString().split('T')[0];
            });
        </script>
    @endpush
@endsection
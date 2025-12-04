@extends('layouts.app')

@section('title', 'Hotel Booking Checkout | Travio')

@section('content')
    @php
        $hideNavbar = true;
    @endphp

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
                        <span class="text-blue-600">Hotel Booking</span> Checkout
                    </h1>
                </div>
                <div class="border-t border-blue-100 pt-4">
                    <div class="flex items-center space-x-6">
                        <div class="text-sm text-gray-600 bg-blue-50 px-3 py-2 rounded-lg">
                            <span class="font-medium text-blue-800">Hotel:</span> {{ $hotelDetail->hotel_name }}
                        </div>
                        <div class="text-sm text-gray-600 bg-blue-50 px-3 py-2 rounded-lg">
                            <span class="font-medium text-blue-800">Room:</span> {{ $hotelRoom->room_type }}
                        </div>
                        <div class="text-sm text-gray-600 bg-blue-50 px-3 py-2 rounded-lg">
                            <span class="font-medium text-blue-800">Location:</span> {{ $hotelDetail->city ?? 'Indonesia' }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
                <!-- Hotel Details -->
                <div class="bg-white rounded-xl shadow-lg p-8 border border-blue-100">
                    <h2 class="text-xl font-semibold mb-4 text-blue-800 border-b border-blue-100 pb-2">Hotel & Room Details
                    </h2>

                    <!-- Hotel Info -->
                    <div class="mb-6">
                        @if($hotelDetail->hotel && $hotelDetail->hotel->image)
                            <img src="{{ asset('photos/' . $hotelDetail->hotel->image) }}" alt="{{ $hotelDetail->hotel_name }}"
                                class="w-full h-56 object-cover rounded-xl mb-6 border-2 border-blue-100 shadow-md">
                        @endif

                        <div class="space-y-4">
                            <div class="flex justify-between items-center border-b border-gray-100 pb-3">
                                <span class="font-semibold text-gray-700">Hotel Name:</span>
                                <span class="text-gray-900 font-medium">{{ $hotelDetail->hotel_name }}</span>
                            </div>

                            <div class="flex justify-between items-center border-b border-gray-100 pb-3">
                                <span class="font-semibold text-gray-700">Room Type:</span>
                                <span class="text-gray-900 font-medium">{{ $hotelRoom->room_type }}</span>
                            </div>

                            <div class="flex justify-between items-center border-b border-gray-100 pb-3">
                                <span class="font-semibold text-gray-700">Capacity:</span>
                                <span class="text-gray-900 font-medium">{{ $hotelRoom->capacity }}
                                    {{ $hotelRoom->capacity == 1 ? 'Guest' : 'Guests' }}</span>
                            </div>

                            <div class="flex justify-between items-center border-b border-gray-100 pb-3">
                                <span class="font-semibold text-gray-700">Price per Night:</span>
                                <span class="text-blue-600 font-bold text-lg">Rp
                                    {{ number_format($hotelRoom->price, 0, ',', '.') }}</span>
                            </div>

                            @if($hotelDetail->description)
                                <div class="border-b border-gray-100 pb-3">
                                    <span class="font-semibold text-gray-700 block mb-2">Description:</span>
                                    <p class="text-gray-600 text-sm">{{ Str::limit($hotelDetail->description, 150) }}</p>
                                </div>
                            @endif

                            @if($hotelDetail->facilities)
                                <div>
                                    <span class="font-semibold text-gray-700 block mb-2">Facilities:</span>
                                    <div class="flex flex-wrap gap-2">
                                        @php
                                            $facilities = is_string($hotelDetail->facilities) ? json_decode($hotelDetail->facilities, true) : $hotelDetail->facilities;
                                            $facilities = $facilities ?: [];
                                        @endphp
                                        @foreach($facilities as $facility)
                                            <span
                                                class="bg-blue-50 text-blue-700 text-xs px-3 py-1 rounded-full border border-blue-200">{{ $facility }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Booking Form -->
                <div class="bg-white rounded-xl shadow-lg p-8 border border-blue-100">
                    <h2 class="text-xl font-semibold mb-6 text-blue-800 border-b border-blue-100 pb-2">Booking Information
                    </h2>

                    @if ($errors->any())
                        <div class="bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-lg mb-6">
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('hotel.booking.store') }}" method="POST" id="bookingForm">
                        @csrf
                        <input type="hidden" name="hotel_id" value="{{ $hotelDetail->id }}">
                        <input type="hidden" name="room_id" value="{{ $hotelRoom->id }}">

                        <!-- Booking Dates -->
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Booking Dates</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="check_in" class="block text-sm font-medium text-gray-700 mb-2">
                                        Check-in Date
                                    </label>
                                    <input type="date" name="check_in" id="check_in" value="{{ old('check_in') }}"
                                        min="{{ date('Y-m-d') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                        required>
                                </div>

                                <div>
                                    <label for="check_out" class="block text-sm font-medium text-gray-700 mb-2">
                                        Check-out Date
                                    </label>
                                    <input type="date" name="check_out" id="check_out" value="{{ old('check_out') }}"
                                        min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                        required>
                                </div>
                            </div>
                        </div>

                        <!-- Number of Guests -->
                        <div class="mb-6">
                            <label for="guests" class="block text-sm font-medium text-gray-700 mb-2">
                                Number of Guests
                            </label>
                            <select name="guests" id="guests"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                required>
                                <option value="">Select number of guests</option>
                                @for($i = 1; $i <= $hotelRoom->capacity; $i++)
                                    <option value="{{ $i }}" {{ old('guests') == $i ? 'selected' : '' }}>
                                        {{ $i }} {{ $i == 1 ? 'Guest' : 'Guests' }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <!-- Special Requests -->
                        <div class="mb-6">
                            <label for="special_requests" class="block text-sm font-medium text-gray-700 mb-2">
                                Special Requests (Optional)
                            </label>
                            <textarea name="special_requests" id="special_requests" rows="3"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                placeholder="Any special requests or requirements...">{{ old('special_requests') }}</textarea>
                        </div>

                        <!-- Price Summary -->
                        <div class="bg-blue-50 rounded-xl p-6 mb-6 border border-blue-200">
                            <h3 class="text-lg font-semibold text-blue-800 mb-4">Price Summary</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-700">Price per night:</span>
                                    <span class="font-medium">Rp {{ number_format($hotelRoom->price, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-700">Number of nights:</span>
                                    <span class="font-medium" id="nightsCount">-</span>
                                </div>
                                <div class="border-t border-blue-300 pt-3">
                                    <div class="flex justify-between text-lg font-bold text-blue-800">
                                        <span>Total Amount:</span>
                                        <span id="totalPrice">-</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="mb-6">
                            <label class="flex items-start space-x-3">
                                <input type="checkbox" required
                                    class="mt-1 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <span class="text-sm text-gray-700 leading-relaxed">
                                    I agree to the
                                    <a href="#" class="text-blue-600 hover:text-blue-800 underline">Terms and Conditions</a>
                                    and
                                    <a href="#" class="text-blue-600 hover:text-blue-800 underline">Privacy Policy</a>
                                </span>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" id="submitBtn"
                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-4 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                            <span class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                    </path>
                                </svg>
                                Confirm Booking
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }

        // Calculate price when dates change
        function calculatePrice() {
            const checkIn = document.getElementById('check_in').value;
            const checkOut = document.getElementById('check_out').value;

            if (checkIn && checkOut) {
                const checkInDate = new Date(checkIn);
                const checkOutDate = new Date(checkOut);

                if (checkOutDate > checkInDate) {
                    const timeDiff = checkOutDate.getTime() - checkInDate.getTime();
                    const nights = Math.ceil(timeDiff / (1000 * 3600 * 24));
                    const pricePerNight = {{ $hotelRoom->price }};
                    const totalPrice = nights * pricePerNight;

                    document.getElementById('nightsCount').textContent = nights + (nights === 1 ? ' night' : ' nights');
                    document.getElementById('totalPrice').textContent = 'Rp ' + totalPrice.toLocaleString('id-ID');

                    // Enable submit button
                    document.getElementById('submitBtn').disabled = false;
                } else {
                    document.getElementById('nightsCount').textContent = '-';
                    document.getElementById('totalPrice').textContent = '-';
                    document.getElementById('submitBtn').disabled = true;
                }
            } else {
                document.getElementById('nightsCount').textContent = '-';
                document.getElementById('totalPrice').textContent = '-';
                document.getElementById('submitBtn').disabled = true;
            }
        }

        // Set minimum check-out date based on check-in
        document.getElementById('check_in').addEventListener('change', function () {
            const checkInDate = this.value;
            const checkOutInput = document.getElementById('check_out');

            if (checkInDate) {
                const minCheckOut = new Date(checkInDate);
                minCheckOut.setDate(minCheckOut.getDate() + 1);
                checkOutInput.min = minCheckOut.toISOString().split('T')[0];

                // Reset check-out if it's before new minimum
                if (checkOutInput.value && new Date(checkOutInput.value) <= new Date(checkInDate)) {
                    checkOutInput.value = '';
                }
            }

            calculatePrice();
        });

        document.getElementById('check_out').addEventListener('change', calculatePrice);

        // Initialize
        document.addEventListener('DOMContentLoaded', function () {
            calculatePrice();
        });

        // Form validation
        document.getElementById('bookingForm').addEventListener('submit', function (e) {
            const checkIn = document.getElementById('check_in').value;
            const checkOut = document.getElementById('check_out').value;

            if (!checkIn || !checkOut) {
                e.preventDefault();
                alert('Please select both check-in and check-out dates.');
                return;
            }

            if (new Date(checkOut) <= new Date(checkIn)) {
                e.preventDefault();
                alert('Check-out date must be after check-in date.');
                return;
            }
        });
    </script>
@endsection
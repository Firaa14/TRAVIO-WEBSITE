@extends('layouts.app')

@section('title', 'Package Booking Checkout | Travio')

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
                        <span class="text-blue-600">Package</span> Booking Checkout
                    </h1>
                </div>
                <div class="border-t border-blue-100 pt-4">
                    <div class="flex items-center space-x-6">
                        <div class="text-sm text-gray-600 bg-blue-50 px-3 py-2 rounded-lg">
                            <span class="font-medium text-blue-800">Package:</span> {{ $package->title }}
                        </div>
                        <div class="text-sm text-gray-600 bg-blue-50 px-3 py-2 rounded-lg">
                            <span class="font-medium text-blue-800">Location:</span>
                            {{ $package->location ?? 'Multiple Destinations' }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
                <!-- Package Details -->
                <div class="bg-white rounded-xl shadow-lg p-8 border border-blue-100">
                    <h2 class="text-xl font-semibold mb-4 text-blue-800 border-b border-blue-100 pb-2">Package Details</h2>

                    <!-- Package Info -->
                    <div class="mb-6">
                        @if($package->image)
                            <img src="{{ asset('photos/' . $package->image) }}" alt="{{ $package->title }}"
                                class="w-full h-56 object-cover rounded-xl mb-6 border-2 border-blue-100 shadow-md">
                        @endif

                        <h3 class="text-lg font-semibold text-blue-800">{{ $package->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ $package->description ?? '' }}</p>

                        <div class="flex items-center mb-4">
                            <svg class="w-4 h-4 inline mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-600">{{ $package->location ?? 'Multiple Destinations' }}</span>
                        </div>

                        <!-- Package Specifications -->
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            @if($package->duration)
                                <div class="bg-blue-50 p-3 rounded-lg">
                                    <span class="text-sm font-medium text-blue-800">Duration:</span>
                                    <p class="text-gray-700">{{ $package->duration }}</p>
                                </div>
                            @endif
                            @if($package->include)
                                <div class="bg-blue-50 p-3 rounded-lg">
                                    <span class="text-sm font-medium text-blue-800">Includes:</span>
                                    <p class="text-gray-700">{{ $package->include }}</p>
                                </div>
                            @endif
                        </div>

                        <!-- Package Features -->
                        @if($package->facilities && count($package->facilities) > 0)
                            <div class="border-t border-blue-100 pt-4 mt-4">
                                <h4 class="font-medium text-blue-800 mb-2">Package Includes</h4>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($package->facilities as $facility)
                                        <span
                                            class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">{{ $facility }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Pricing -->
                    <div class="border-t border-blue-100 pt-6 mt-6">
                        <h4 class="font-semibold text-lg mb-4 text-blue-800">Pricing Details</h4>
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-6 rounded-xl border border-blue-100">
                            <div class="flex justify-between items-center mb-4">
                                <div>
                                    <h5 class="font-medium text-gray-800">Package Price</h5>
                                    <p class="text-sm text-gray-600">Per person rate</p>
                                </div>
                                <div class="text-right bg-white p-3 rounded-lg shadow-sm border border-blue-200">
                                    <p class="text-lg font-semibold text-blue-700">
                                        Rp {{ number_format($package->price, 0, ',', '.') }}
                                    </p>
                                    <p class="text-sm text-blue-500">per person</p>
                                </div>
                            </div>
                            <div class="text-sm text-gray-600 bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                                <strong>Note:</strong>
                                <ul class="mt-1 space-y-1">
                                    <li>• Final price depends on number of travelers</li>
                                    <li>• Group discounts may apply</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Booking Form -->
                <div class="bg-white rounded-xl shadow-lg p-8 border border-blue-100">
                    <h2 class="text-xl font-semibold mb-6 text-blue-800 border-b border-blue-100 pb-2">Booking Information
                    </h2>

                    <form action="{{ route('package.booking.store') }}" method="POST" id="bookingForm">
                        @csrf
                        <input type="hidden" name="package_id" value="{{ $package->id }}">
                        <input type="hidden" name="total_price" id="total_price_input" value="0">

                        <!-- Travel Date -->
                        <div class="mb-6">
                            <h3 class="font-semibold text-gray-800 mb-4">Travel Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="travel_date" class="block text-sm font-medium text-gray-700 mb-2">Travel
                                        Date</label>
                                    <input type="date"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        id="travel_date" name="travel_date" required
                                        min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                                </div>
                                <div>
                                    <label for="number_of_travelers"
                                        class="block text-sm font-medium text-gray-700 mb-2">Number of Travelers</label>
                                    <select
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        id="number_of_travelers" name="number_of_travelers" required>
                                        <option value="">Select number of travelers</option>
                                        @for($i = 1; $i <= 8; $i++)
                                            <option value="{{ $i }}">{{ $i }} {{ $i == 1 ? 'Person' : 'People' }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Customer Information -->
                        <div class="mb-6">
                            <h3 class="font-semibold text-gray-800 mb-4">Contact Information</h3>
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-2">Full
                                        Name</label>
                                    <input type="text"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        id="customer_name" name="customer_name" required
                                        value="{{ Auth::user()->name ?? '' }}">
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="customer_email"
                                            class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                        <input type="email"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            id="customer_email" name="customer_email" required
                                            value="{{ Auth::user()->email ?? '' }}">
                                    </div>
                                    <div>
                                        <label for="customer_phone"
                                            class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                        <input type="tel"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            id="customer_phone" name="customer_phone" required placeholder="08xxxxxxxxx">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Special Requests -->
                        <div class="mb-6">
                            <label for="special_requests" class="block text-sm font-medium text-gray-700 mb-2">Special
                                Requests (Optional)</label>
                            <textarea
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                id="special_requests" name="special_requests" rows="3"
                                placeholder="Any special requirements or requests..."></textarea>
                        </div>

                        <!-- Price Summary -->
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-6 rounded-xl border border-blue-200 mb-6">
                            <h3 class="font-semibold text-blue-800 mb-4">Price Summary</h3>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-700">Package Price per Person:</span>
                                    <span id="basePrice" class="font-medium">Rp
                                        {{ number_format($package->price, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-700">Number of Travelers:</span>
                                    <span id="numberOfTravelers" class="font-medium">0</span>
                                </div>
                                <hr class="border-blue-200">
                                <div class="flex justify-between text-lg font-bold text-blue-800">
                                    <span>Total Price:</span>
                                    <span id="totalPrice">Rp 0</span>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 px-8 rounded-lg transition-colors duration-200 transform hover:scale-105">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                Complete Booking
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }

        function calculatePrice() {
            const numberOfTravelers = document.getElementById('number_of_travelers').value;
            const basePrice = {{ $package->price }};

            if (numberOfTravelers) {
                const total = basePrice * parseInt(numberOfTravelers);

                document.getElementById('numberOfTravelers').textContent = numberOfTravelers;
                document.getElementById('totalPrice').textContent = 'Rp ' + total.toLocaleString('id-ID');
                document.getElementById('total_price_input').value = total;
            } else {
                document.getElementById('numberOfTravelers').textContent = '0';
                document.getElementById('totalPrice').textContent = 'Rp 0';
                document.getElementById('total_price_input').value = '0';
            }
        }

        // Event listeners
        document.getElementById('number_of_travelers').addEventListener('change', calculatePrice);

        // Form validation
        document.getElementById('bookingForm').addEventListener('submit', function (e) {
            const numberOfTravelers = document.getElementById('number_of_travelers').value;
            const travelDate = document.getElementById('travel_date').value;

            if (!numberOfTravelers || numberOfTravelers < 1) {
                e.preventDefault();
                alert('Please select number of travelers');
                return;
            }

            if (!travelDate) {
                e.preventDefault();
                alert('Please select travel date');
                return;
            }

            const today = new Date();
            const selectedDate = new Date(travelDate);

            if (selectedDate <= today) {
                e.preventDefault();
                alert('Travel date must be in the future');
                return;
            }
        });
    </script>
@endsection
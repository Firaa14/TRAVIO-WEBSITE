@extends('layouts.app')

@section('title', 'Destination Booking Checkout | Travio')

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
                        <span class="text-blue-600">Destination</span> Booking Checkout
                    </h1>
                </div>
                <div class="border-t border-blue-100 pt-4">
                    <div class="flex items-center space-x-6">
                        <div class="text-sm text-gray-600 bg-blue-50 px-3 py-2 rounded-lg">
                            <span class="font-medium text-blue-800">Destination:</span> {{ $destination->name }}
                        </div>
                        <div class="text-sm text-gray-600 bg-blue-50 px-3 py-2 rounded-lg">
                            <span class="font-medium text-blue-800">Location:</span> {{ $destination->location }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
                <!-- Destination Details -->
                <div class="bg-white rounded-xl shadow-lg p-8 border border-blue-100">
                    <h2 class="text-xl font-semibold mb-4 text-blue-800 border-b border-blue-100 pb-2">Destination Details
                    </h2>

                    <!-- Destination Info -->
                    <div class="mb-6">
                        @if($destination->image)
                            <img src="{{ asset('photos/' . $destination->image) }}" alt="{{ $destination->name }}"
                                class="w-full h-56 object-cover rounded-xl mb-6 border-2 border-blue-100 shadow-md">
                        @endif

                        <div class="space-y-4">
                            <div class="bg-white p-4 rounded-lg border border-gray-200">
                                <h3 class="font-semibold text-gray-800 mb-2">{{ $destination->name }}</h3>
                                <p class="text-gray-600 text-sm leading-relaxed">{{ $destination->detail }}</p>
                            </div>

                            @if(is_array($destination->price_details) && count($destination->price_details) > 0)
                                <div class="bg-white p-4 rounded-lg border border-gray-200">
                                    <h4 class="font-semibold text-gray-800 mb-3">Price Information</h4>
                                    <ul class="space-y-2">
                                        @foreach($destination->price_details as $priceDetail)
                                            <li class="text-gray-700 text-sm flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                {{ $priceDetail }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Booking Form -->
                <div class="bg-white rounded-xl shadow-lg p-8 border border-blue-100">
                    <h2 class="text-xl font-semibold mb-6 text-blue-800 border-b border-blue-100 pb-2">Booking Information
                    </h2>

                    <form action="{{ route('destination.booking.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf
                        <input type="hidden" name="destination_id" value="{{ $destination->id }}">

                        <!-- Personal Information -->
                        <div class="bg-white p-6 rounded-lg border border-gray-200">
                            <h3 class="font-semibold text-gray-800 mb-4">Personal Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" name="full_name" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                        value="{{ old('full_name') }}">
                                    @error('full_name')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" name="phone" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                        value="{{ old('phone') }}">
                                    @error('phone')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email <span
                                            class="text-red-500">*</span></label>
                                    <input type="email" name="email" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Gender <span
                                            class="text-red-500">*</span></label>
                                    <select name="gender" required
                                        class="w-full px-4 py-3 border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                        <option value="">Select Gender</option>
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female
                                        </option>
                                    </select>
                                    @error('gender')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth <span
                                            class="text-red-500">*</span></label>
                                    <input type="date" name="dob" required
                                        class="w-full px-4 py-3 border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                        value="{{ old('dob') }}">
                                    @error('dob')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Address <span
                                        class="text-red-500">*</span></label>
                                <textarea name="address" required rows="3"
                                    class="w-full px-4 py-3 border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                    placeholder="Enter your full address">{{ old('address') }}</textarea>
                                @error('address')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Emergency Contact -->
                        <div class="bg-white p-6 rounded-lg border border-gray-200">
                            <h3 class="font-semibold text-gray-800 mb-4">Emergency Contact</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Emergency Contact Name <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" name="emergency_name" required
                                        class="w-full px-4 py-3 border border-yellow-200 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all duration-200"
                                        value="{{ old('emergency_name') }}">
                                    @error('emergency_name')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Emergency Contact Phone
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" name="emergency_phone" required
                                        class="w-full px-4 py-3 border border-yellow-200 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all duration-200"
                                        value="{{ old('emergency_phone') }}">
                                    @error('emergency_phone')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Trip Details -->
                        <div class="bg-white p-6 rounded-lg border border-gray-200">
                            <h3 class="font-semibold text-gray-800 mb-4">Trip Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Trip Date <span
                                            class="text-red-500">*</span></label>
                                    <input type="date" name="trip_date" required min="{{ date('Y-m-d') }}"
                                        class="w-full px-4 py-3 border border-purple-200 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200"
                                        value="{{ old('trip_date') }}">
                                    @error('trip_date')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Number of Participants <span
                                            class="text-red-500">*</span></label>
                                    <select name="participants" required id="participants"
                                        class="w-full px-4 py-3 border border-purple-200 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200"
                                        onchange="calculateTotal()">
                                        <option value="">Select participants</option>
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}" {{ old('participants') == $i ? 'selected' : '' }}>
                                                {{ $i }} {{ $i == 1 ? 'Person' : 'People' }}
                                            </option>
                                        @endfor
                                    </select>
                                    @error('participants')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="bg-white p-6 rounded-lg border border-gray-200">
                            <h3 class="font-semibold text-gray-800 mb-4">Payment Method</h3>
                            <div class="space-y-3">
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="radio" name="payment_method" value="bank_transfer" required
                                        class="w-4 h-4 text-green-600 border-green-300 focus:ring-green-500">
                                    <span class="text-gray-700">Bank Transfer</span>
                                </label>
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="radio" name="payment_method" value="qris" required
                                        class="w-4 h-4 text-green-600 border-green-300 focus:ring-green-500">
                                    <span class="text-gray-700">QRIS</span>
                                </label>
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="radio" name="payment_method" value="e_wallet" required
                                        class="w-4 h-4 text-green-600 border-green-300 focus:ring-green-500">
                                    <span class="text-gray-700">E-Wallet (GoPay, OVO, DANA)</span>
                                </label>
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="radio" name="payment_method" value="cash" required
                                        class="w-4 h-4 text-green-600 border-green-300 focus:ring-green-500">
                                    <span class="text-gray-700">Cash</span>
                                </label>
                            </div>
                            @error('payment_method')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror

                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Payment Proof <span
                                        class="text-red-500">*</span></label>
                                <input type="file" name="payment_proof" required accept=".jpg,.jpeg,.png,.pdf"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                <p class="text-sm text-gray-600 mt-1">Upload payment proof (JPG, PNG, PDF, max 5MB)</p>
                                @error('payment_proof')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Total Price -->
                        <div class="bg-white p-6 rounded-lg border border-gray-200">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-semibold text-gray-800">Total Price:</span>
                                <span class="text-2xl font-bold text-blue-600" id="total-price">Rp 0</span>
                            </div>
                            <input type="hidden" name="total_price" id="total-price-input" value="0">
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-4 px-6 rounded-lg font-semibold text-lg shadow-lg hover:from-blue-700 hover:to-blue-800 transform hover:scale-105 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Complete Booking
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

        function calculateTotal() {
            const participants = document.getElementById('participants').value;
            const basePrice = {{ $destination->price ?? 0 }};

            if (participants && basePrice > 0) {
                const total = participants * basePrice;
                document.getElementById('total-price').textContent = 'Rp ' + total.toLocaleString('id-ID');
                document.getElementById('total-price-input').value = total;
            } else {
                document.getElementById('total-price').textContent = 'Rp 0';
                document.getElementById('total-price-input').value = 0;
            }
        }

        // Calculate total on page load if values are already selected
        document.addEventListener('DOMContentLoaded', function () {
            calculateTotal();
        });
    </script>
@endsection
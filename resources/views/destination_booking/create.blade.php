@extends('layouts.app')

@section('title', 'Destination Booking - ' . $destination->name)

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
                        <span class="text-blue-600">Destination</span> Booking
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

                        <h3 class="text-lg font-semibold text-blue-800">{{ $destination->name }}</h3>
                        <p class="text-gray-600 mb-2 flex items-center">
                            <svg class="w-4 h-4 inline mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            {{ $destination->location }}
                        </p>
                        <p class="text-gray-700 mb-4">{{ $destination->detail }}</p>

                        @if($destination->price_details && count($destination->price_details) > 0)
                            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-4 rounded-xl border border-blue-100 mb-4">
                                <h4 class="font-semibold text-blue-800 mb-2">Price Details:</h4>
                                <ul class="text-sm text-gray-700 space-y-1">
                                    @foreach($destination->price_details as $item)
                                        <li>• {{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    <!-- Itinerary -->
                    @if($destination->itinerary && count($destination->itinerary) > 0)
                        <div class="border-t border-blue-100 pt-6 mt-6">
                            <h4 class="font-semibold text-lg mb-4 text-blue-800">Itinerary</h4>
                            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-6 rounded-xl border border-blue-100">
                                <ul class="space-y-2 text-sm text-gray-700">
                                    @foreach($destination->itinerary as $item)
                                        <li class="flex items-start">
                                            <span class="text-blue-500 mr-2 mt-1">•</span>
                                            <span>{{ $item }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Booking Form -->
                <div class="bg-white rounded-xl shadow-lg p-8 border border-blue-100">
                    <h2 class="text-xl font-semibold mb-4 text-blue-800 border-b border-blue-100 pb-2">Complete Your Booking
                    </h2>

                    <form action="{{ route('destination.booking.store') }}" method="POST" id="bookingForm"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="destination_id" value="{{ $destination->id }}">

                        <!-- Trip Date -->
                        <div class="mb-4">
                            <label for="trip_date" class="block text-sm font-medium text-blue-800 mb-2">
                                <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Trip Date
                            </label>
                            <input type="date" id="trip_date" name="trip_date" value="{{ old('trip_date') }}"
                                min="{{ date('Y-m-d') }}"
                                class="w-full px-4 py-3 border-2 border-blue-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('trip_date') border-red-400 @enderror"
                                required>
                            @error('trip_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Number of Participants -->
                        <div class="mb-6">
                            <label for="participants" class="block text-sm font-medium text-blue-800 mb-2">
                                <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z">
                                    </path>
                                </svg>
                                Number of Participants
                            </label>
                            <select id="participants" name="participants"
                                class="w-full px-4 py-3 border-2 border-blue-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('participants') border-red-400 @enderror"
                                required>
                                <option value="">Select participants</option>
                                @for ($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}" {{ old('participants') == $i ? 'selected' : '' }}>
                                        {{ $i }} Participant{{ $i > 1 ? 's' : '' }}
                                    </option>
                                @endfor
                            </select>
                            @error('participants')
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
                                    <span class="text-gray-700">Price per person:</span>
                                    <span class="font-medium text-blue-700">Rp
                                        {{ number_format($destination->price, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center p-2 bg-white rounded-lg">
                                    <span class="text-gray-700">Participants:</span>
                                    <span class="font-medium text-blue-700" id="participantCount">1 participant</span>
                                </div>
                                <div class="border-t border-blue-200 pt-2">
                                    <div class="flex justify-between items-center p-2 bg-blue-100 rounded-lg">
                                        <span class="text-blue-800 font-semibold">Total Price:</span>
                                        <span class="text-blue-800 font-bold text-lg" id="totalPrice">Rp
                                            {{ number_format($destination->price, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Personal Information -->
                        <div class="space-y-4 mb-6">
                            <h4 class="font-semibold text-blue-800 border-b border-blue-100 pb-2">Personal Information</h4>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="full_name" class="block text-sm font-medium text-blue-800 mb-1">Full
                                        Name</label>
                                    <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}"
                                        class="w-full px-3 py-2 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('full_name') border-red-400 @enderror"
                                        required>
                                    @error('full_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm font-medium text-blue-800 mb-1">Phone
                                        Number</label>
                                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                        class="w-full px-3 py-2 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('phone') border-red-400 @enderror"
                                        required>
                                    @error('phone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-blue-800 mb-1">Email</label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                                        class="w-full px-3 py-2 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-400 @enderror"
                                        required>
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="gender" class="block text-sm font-medium text-blue-800 mb-1">Gender</label>
                                    <select id="gender" name="gender"
                                        class="w-full px-3 py-2 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('gender') border-red-400 @enderror"
                                        required>
                                        <option value="">Select Gender</option>
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female
                                        </option>
                                    </select>
                                    @error('gender')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="dob" class="block text-sm font-medium text-blue-800 mb-1">Date of
                                        Birth</label>
                                    <input type="date" id="dob" name="dob" value="{{ old('dob') }}"
                                        class="w-full px-3 py-2 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('dob') border-red-400 @enderror"
                                        required>
                                    @error('dob')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="address" class="block text-sm font-medium text-blue-800 mb-1">Address</label>
                                <textarea id="address" name="address" rows="3"
                                    class="w-full px-3 py-2 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('address') border-red-400 @enderror"
                                    required>{{ old('address') }}</textarea>
                                @error('address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Emergency Contact -->
                            <h5 class="font-medium text-blue-800 mt-4 border-b border-blue-100 pb-1">Emergency Contact</h5>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="emergency_name"
                                        class="block text-sm font-medium text-blue-800 mb-1">Emergency Contact Name</label>
                                    <input type="text" id="emergency_name" name="emergency_name"
                                        value="{{ old('emergency_name') }}"
                                        class="w-full px-3 py-2 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('emergency_name') border-red-400 @enderror"
                                        required>
                                    @error('emergency_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="emergency_phone"
                                        class="block text-sm font-medium text-blue-800 mb-1">Emergency Contact Phone</label>
                                    <input type="tel" id="emergency_phone" name="emergency_phone"
                                        value="{{ old('emergency_phone') }}"
                                        class="w-full px-3 py-2 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('emergency_phone') border-red-400 @enderror"
                                        required>
                                    @error('emergency_phone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="mb-6">
                            <h4 class="font-semibold text-blue-800 border-b border-blue-100 pb-2 mb-4">Payment Method</h4>
                            <select id="payment_method" name="payment_method"
                                class="w-full px-4 py-3 border-2 border-blue-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('payment_method') border-red-400 @enderror"
                                required>
                                <option value="">Select Payment Method</option>
                                <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                <option value="qris" {{ old('payment_method') == 'qris' ? 'selected' : '' }}>QRIS</option>
                                <option value="e_wallet" {{ old('payment_method') == 'e_wallet' ? 'selected' : '' }}>E-Wallet
                                </option>
                                <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                            </select>
                            @error('payment_method')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Payment Proof Upload -->
                        <div class="mb-6">
                            <label for="payment_proof" class="block text-sm font-medium text-blue-800 mb-2">Upload Payment
                                Proof</label>
                            <input type="file" id="payment_proof" name="payment_proof" accept=".jpg,.jpeg,.png,.pdf"
                                class="w-full px-3 py-2 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('payment_proof') border-red-400 @enderror"
                                required>
                            <p class="mt-1 text-sm text-gray-600">Max 5MB. Format: JPG, PNG, PDF</p>
                            @error('payment_proof')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" id="submitBtn"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 px-6 rounded-xl transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-blue-300 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
                            disabled>
                            <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
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
            const params = new URLSearchParams(window.location.search);
            const from = params.get('from');

            if (from === 'planning') {
                window.location.href = '{{ route("planning") }}';
            } else {
                window.location.href = '{{ route("dashboard") }}';
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const participantsInput = document.getElementById('participants');
            const tripDateInput = document.getElementById('trip_date');
            const priceSummary = document.getElementById('priceSummary');
            const participantCount = document.getElementById('participantCount');
            const totalPrice = document.getElementById('totalPrice');
            const submitBtn = document.getElementById('submitBtn');
            const pricePerPerson = {{ $destination->price }};

            function updatePriceSummary() {
                const participants = parseInt(participantsInput.value) || 0;
                const tripDate = tripDateInput.value;

                if (participants > 0 && tripDate) {
                    const total = pricePerPerson * participants;
                    participantCount.textContent = participants + ' participant' + (participants > 1 ? 's' : '');
                    totalPrice.textContent = 'Rp ' + total.toLocaleString('id-ID');
                    priceSummary.style.display = 'block';
                    submitBtn.disabled = false;
                } else {
                    priceSummary.style.display = 'none';
                    submitBtn.disabled = true;
                }
            }

            participantsInput.addEventListener('change', updatePriceSummary);
            tripDateInput.addEventListener('change', updatePriceSummary);

            // Initial check
            updatePriceSummary();
        });
    </script>
@endsection
@extends('layouts.app')

@section('title', 'Car Rental Checkout | Travio')

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
                        <span class="text-blue-600">Car Rental</span> Checkout
                    </h1>
                </div>
                <div class="border-t border-blue-100 pt-4">
                    <div class="flex items-center space-x-6">
                        <div class="text-sm text-gray-600 bg-blue-50 px-3 py-2 rounded-lg">
                            <span class="font-medium text-blue-800">Car:</span> {{ $car->title }}
                        </div>
                        <div class="text-sm text-gray-600 bg-blue-50 px-3 py-2 rounded-lg">
                            <span class="font-medium text-blue-800">Location:</span>
                            {{ $car->location ?? 'Makassar, Indonesia' }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
                <!-- Car Details -->
                <div class="bg-white rounded-xl shadow-lg p-8 border border-blue-100">
                    <h2 class="text-xl font-semibold mb-4 text-blue-800 border-b border-blue-100 pb-2">Car Details</h2>

                    <!-- Car Info -->
                    <div class="mb-6">
                        @if($car->image)
                            <img src="{{ asset($car->image) }}" alt="{{ $car->title }}"
                                class="w-full h-56 object-cover rounded-xl mb-6 border-2 border-blue-100 shadow-md">
                        @endif

                        <h3 class="text-lg font-semibold text-blue-800">{{ $car->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ $car->description ?? '' }}</p>

                        <div class="flex items-center mb-4">
                            <svg class="w-4 h-4 inline mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-600">{{ $car->location ?? 'Makassar, Indonesia' }}</span>
                        </div>

                        <!-- Car Specifications -->
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            @if($car->brand && $car->model)
                                <div class="bg-blue-50 p-3 rounded-lg">
                                    <span class="text-sm font-medium text-blue-800">Brand & Model:</span>
                                    <p class="text-gray-700">{{ $car->brand }} {{ $car->model }}</p>
                                </div>
                            @endif
                            @if($car->year)
                                <div class="bg-blue-50 p-3 rounded-lg">
                                    <span class="text-sm font-medium text-blue-800">Year:</span>
                                    <p class="text-gray-700">{{ $car->year }}</p>
                                </div>
                            @endif
                            @if($car->transmission)
                                <div class="bg-blue-50 p-3 rounded-lg">
                                    <span class="text-sm font-medium text-blue-800">Transmission:</span>
                                    <p class="text-gray-700">{{ $car->transmission }}</p>
                                </div>
                            @endif
                            @if($car->capacity)
                                <div class="bg-blue-50 p-3 rounded-lg">
                                    <span class="text-sm font-medium text-blue-800">Capacity:</span>
                                    <p class="text-gray-700">{{ $car->capacity }} passengers</p>
                                </div>
                            @endif
                            @if($car->license_plate)
                                <div class="bg-blue-50 p-3 rounded-lg">
                                    <span class="text-sm font-medium text-blue-800">License Plate:</span>
                                    <p class="text-gray-700">{{ $car->license_plate }}</p>
                                </div>
                            @endif
                            @if($car->fuel_type)
                                <div class="bg-blue-50 p-3 rounded-lg">
                                    <span class="text-sm font-medium text-blue-800">Fuel Type:</span>
                                    <p class="text-gray-700">{{ $car->fuel_type }}</p>
                                </div>
                            @endif
                        </div>

                        <!-- Car Features -->
                        @if($car->facilities && count($car->facilities) > 0)
                            <div class="border-t border-blue-100 pt-4 mt-4">
                                <h4 class="font-medium text-blue-800 mb-2">Car Features</h4>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($car->facilities as $facility)
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
                                    <h5 class="font-medium text-gray-800">Daily Rate</h5>
                                    <p class="text-sm text-gray-600">Base rental price per day</p>
                                </div>
                                <div class="text-right bg-white p-3 rounded-lg shadow-sm border border-blue-200">
                                    <p class="text-lg font-semibold text-blue-700">
                                        Rp {{ number_format($car->price, 0, ',', '.') }}
                                    </p>
                                    <p class="text-sm text-blue-500">per day</p>
                                </div>
                            </div>
                            <div class="text-sm text-gray-600 bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                                <strong>Additional Fees:</strong>
                                <ul class="mt-1 space-y-1">
                                    <li>• Driver service: +Rp 100,000/day</li>
                                    <li>• Late return: Rp 50,000/hour</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Booking Form -->
                <div class="bg-white rounded-xl shadow-lg p-8 border border-blue-100">
                    <h2 class="text-xl font-semibold mb-6 text-blue-800 border-b border-blue-100 pb-2">Rental Information
                    </h2>

                    <form action="{{ route('car.booking.store') }}" method="POST" enctype="multipart/form-data"
                        id="bookingForm">
                        @csrf
                        <input type="hidden" name="car_id" value="{{ $car->id }}">

                        <!-- Rental Dates -->
                        <div class="mb-6">
                            <h3 class="font-semibold text-gray-800 mb-4">Rental Period</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Start
                                        Date</label>
                                    <input type="date"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        id="start_date" name="start_date" required min="{{ date('Y-m-d') }}">
                                </div>
                                <div>
                                    <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">End
                                        Date</label>
                                    <input type="date"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        id="end_date" name="end_date" required min="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                        </div>

                        <!-- Rental Details -->
                        <div class="mb-6">
                            <h3 class="font-semibold text-gray-800 mb-4">Rental Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="passengers" class="block text-sm font-medium text-gray-700 mb-2">Number of
                                        Passengers</label>
                                    <input type="number"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        id="passengers" name="passengers" min="1" max="8" required>
                                </div>
                                <div>
                                    <label for="duration_type" class="block text-sm font-medium text-gray-700 mb-2">Duration
                                        Type</label>
                                    <select
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        id="duration_type" name="duration_type" required>
                                        <option value="">Select Duration</option>
                                        <option value="half">Half Day (6 hours)</option>
                                        <option value="full">Full Day (12 hours)</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Driver Option -->
                        <div class="mb-6">
                            <h3 class="font-semibold text-gray-800 mb-4">Driver Option</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div
                                    class="border border-blue-200 rounded-lg p-4 bg-blue-50 hover:bg-blue-100 transition-colors">
                                    <label class="flex items-start cursor-pointer">
                                        <input type="radio" name="with_driver" value="1"
                                            class="mt-1 mr-3 text-blue-600 focus:ring-blue-500"
                                            onchange="toggleDriverFields()" required>
                                        <div>
                                            <div class="font-medium text-gray-800">With Driver</div>
                                            <div class="text-sm text-gray-600">Professional driver included (+Rp
                                                100,000/day)</div>
                                        </div>
                                    </label>
                                </div>
                                <div
                                    class="border border-blue-200 rounded-lg p-4 bg-blue-50 hover:bg-blue-100 transition-colors">
                                    <label class="flex items-start cursor-pointer">
                                        <input type="radio" name="with_driver" value="0"
                                            class="mt-1 mr-3 text-blue-600 focus:ring-blue-500"
                                            onchange="toggleDriverFields()" required>
                                        <div>
                                            <div class="font-medium text-gray-800">Self Drive</div>
                                            <div class="text-sm text-gray-600">Drive the car yourself (SIM A required)</div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Renter Information -->
                        <div class="mb-6">
                            <h3 class="font-semibold text-gray-800 mb-4">Renter Information</h3>
                            <div class="mb-4">
                                <label for="renter_name" class="block text-sm font-medium text-gray-700 mb-2">Renter Full
                                    Name</label>
                                <input type="text"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    id="renter_name" name="renter_name" required>
                            </div>
                        </div>

                        <!-- Driver Information (shown when self-drive is selected) -->
                        <div id="driverFields" class="hidden mb-6">
                            <h3 class="font-semibold text-gray-800 mb-4">Driver Information</h3>
                            <div class="mb-4">
                                <label for="driver_name" class="block text-sm font-medium text-gray-700 mb-2">Driver Full
                                    Name</label>
                                <input type="text"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    id="driver_name" name="driver_name">
                                <small class="text-gray-500">Required for self-drive option</small>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="ktp" class="block text-sm font-medium text-gray-700 mb-2">KTP (ID
                                        Card)</label>
                                    <div
                                        class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-blue-400 transition-colors">
                                        <input type="file" class="w-full" id="ktp" name="ktp" accept=".jpg,.png,.pdf">
                                        <small class="text-gray-500 mt-2 block">Upload your ID card (JPG, PNG, PDF)</small>
                                    </div>
                                </div>
                                <div>
                                    <label for="sim_a" class="block text-sm font-medium text-gray-700 mb-2">SIM A (Driving
                                        License)</label>
                                    <div
                                        class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-blue-400 transition-colors">
                                        <input type="file" class="w-full" id="sim_a" name="sim_a" accept=".jpg,.png,.pdf">
                                        <small class="text-gray-500 mt-2 block">Upload your driving license (JPG, PNG,
                                            PDF)</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Price Summary -->
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-6 rounded-xl border border-blue-200 mb-6">
                            <h3 class="font-semibold text-blue-800 mb-4">Price Summary</h3>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-700">Base Price per Day:</span>
                                    <span id="basePrice" class="font-medium">Rp
                                        {{ number_format($car->price, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-700">Number of Days:</span>
                                    <span id="numberOfDays" class="font-medium">0</span>
                                </div>
                                <div class="flex justify-between" id="driverFeeRow" style="display: none;">
                                    <span class="text-gray-700">Driver Fee:</span>
                                    <span id="driverFee" class="font-medium">Rp 0</span>
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

        function toggleDriverFields() {
            const withDriverRadio = document.querySelector('input[name="with_driver"][value="1"]');
            const driverFields = document.getElementById('driverFields');
            const driverFeeRow = document.getElementById('driverFeeRow');

            if (withDriverRadio.checked) {
                driverFields.classList.add('hidden');
                driverFeeRow.style.display = 'flex';
                // Remove required from driver fields
                document.getElementById('driver_name').required = false;
                document.getElementById('ktp').required = false;
                document.getElementById('sim_a').required = false;
            } else {
                driverFields.classList.remove('hidden');
                driverFeeRow.style.display = 'flex';
                // Add required to driver fields
                document.getElementById('driver_name').required = true;
                document.getElementById('ktp').required = true;
                document.getElementById('sim_a').required = true;
            }

            calculatePrice();
        }

        function calculatePrice() {
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;
            const withDriver = document.querySelector('input[name="with_driver"][value="1"]').checked;
            const basePrice = {{ $car->price }};

            if (startDate && endDate) {
                const start = new Date(startDate);
                const end = new Date(endDate);
                const days = Math.ceil((end - start) / (1000 * 60 * 60 * 24));

                if (days > 0) {
                    const subtotal = basePrice * days;
                    const driverFee = withDriver ? 100000 * days : 0;
                    const total = subtotal + driverFee;

                    document.getElementById('numberOfDays').textContent = days;
                    document.getElementById('driverFee').textContent = 'Rp ' + driverFee.toLocaleString('id-ID');
                    document.getElementById('totalPrice').textContent = 'Rp ' + total.toLocaleString('id-ID');
                }
            }
        }

        // Event listeners
        document.getElementById('start_date').addEventListener('change', function () {
            const startDate = new Date(this.value);
            const endDateInput = document.getElementById('end_date');

            // Set minimum end date to day after start date
            const minEndDate = new Date(startDate);
            minEndDate.setDate(startDate.getDate() + 1);
            endDateInput.min = minEndDate.toISOString().split('T')[0];

            calculatePrice();
        });

        document.getElementById('end_date').addEventListener('change', calculatePrice);

        // Form validation
        document.getElementById('bookingForm').addEventListener('submit', function (e) {
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;

            if (new Date(startDate) >= new Date(endDate)) {
                e.preventDefault();
                alert('End date must be after start date');
            }
        });
    </script>
@endsection
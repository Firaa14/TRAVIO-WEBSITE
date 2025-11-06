@extends('layouts.app')

@section('title', 'Planning | Travio')

@section('content')

    @include('components.heroplanning')

    {{-- PLANNING FORM SECTION --}}
    <section class="planning pt-4 pb-5 min-vh-100 d-flex align-items-start" style="background:#f8f9fa;">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <p class="text-center text-muted mb-5">
                        Design your adventure — choose destinations, stays, and transportation.
                        Create a personalized travel package that fits your time and schedule.
                    </p>

                    <form id="planningForm" action="{{ route('planning.calculate') }}" method="POST"
                        class="bg-white shadow-lg rounded-4 p-4">
                        @csrf
                        <div id="formErrorAlert" class="alert alert-danger d-none" role="alert"></div>

                        <div class="row g-4 mb-4">
                            <!-- Leaving -->
                            <div class="col-md-4 col-12">
                                <label class="form-label fw-bold">Leaving</label>
                                <input type="datetime-local" name="leaving_date" class="form-control" required>
                                <label class="form-label fw-bold mt-3">Returning</label>
                                <input type="datetime-local" name="return_date" class="form-control" required>
                            </div>

                            <!-- Sailing To -->
                            <div class="col-md-4 col-12">
                                <label class="form-label fw-bold">Sailing to</label>
                                <div class="dropdown position-relative">
                                    <button class="form-select text-start d-flex align-items-center justify-content-between"
                                        type="button" id="destinationDropdown" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <span id="selectedDestinationText">Select Destination</span>
                                        <i class="bi bi-chevron-down"></i>
                                    </button>

                                    <ul class="dropdown-menu w-100 shadow-lg p-2" aria-labelledby="destinationDropdown"
                                        style="max-height: 250px; overflow-y: auto;">
                                        @foreach($destinations as $d)
                                            <li class="dropdown-item p-2 destination-item d-flex align-items-center"
                                                data-name="{{ $d['name'] }}" data-price="{{ $d['price'] ?? '' }}">
                                                <img src="{{ $d['image'] ?? asset('assets/photos/destination1.jpg') }}"
                                                    alt="{{ $d['name'] }}" class="me-3 rounded"
                                                    style="width: 50px; height: 50px; object-fit: cover;">
                                                <div>
                                                    <div class="fw-semibold">{{ $d['name'] }}</div>
                                                    <small class="text-muted">
                                                        {{ $d['discount'] ?? '' }} off — Rp
                                                        {{ number_format($d['price'] ?? 0, 0, ',', '.') }}
                                                    </small>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <select name="destination_price" id="destinationSelect" class="d-none">
                                        <option value="">Select Destination</option>
                                        @foreach($destinations as $d)
                                            <option value="{{ $d['price'] ?? '' }}">{{ $d['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Where to Stay -->
                            <div class="col-md-4 col-12">
                                <label class="form-label fw-bold">Where to Stay</label>
                                <div class="dropdown position-relative">
                                    <button class="form-select text-start d-flex align-items-center justify-content-between"
                                        type="button" id="hotelDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span id="selectedHotelText">Select Hotel</span>
                                        <i class="bi bi-chevron-down"></i>
                                    </button>

                                    <ul class="dropdown-menu w-100 shadow-lg p-2" aria-labelledby="hotelDropdown"
                                        style="max-height: 250px; overflow-y: auto;">
                                        @foreach($hotels as $h)
                                            <li class="dropdown-item p-2 hotel-item d-flex align-items-center"
                                                data-name="{{ $h['name'] ?? '' }}" data-price="{{ $h['price'] ?? '' }}">
                                                <img src="{{ $h['image'] ?? asset('assets/images/default-hotel.jpg') }}"
                                                    alt="{{ $h['name'] }}" class="me-3 rounded"
                                                    style="width: 50px; height: 50px; object-fit: cover;">
                                                <div>
                                                    <div class="fw-semibold">{{ $h['name'] ?? '' }}</div>
                                                    <small class="text-muted">
                                                        Rp {{ number_format($h['price'] ?? 0, 0, ',', '.') }}/night
                                                    </small>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <select name="hotel_price" id="hotelSelect" class="d-none">
                                        <option value="">Select Hotel</option>
                                        @foreach($hotels as $h)
                                            <option value="{{ $h['price'] ?? '' }}">{{ $h['name'] ?? '' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row g-4 mb-4">
                            <!-- Guests -->
                            <div class="col-md-6 col-12">
                                <label class="form-label fw-bold">Guests</label>
                                <div class="row">
                                    <div class="col-4">
                                        <input type="number" name="adults" id="adults" class="form-control"
                                            placeholder="Adults" min="0">
                                    </div>
                                    <div class="col-4">
                                        <input type="number" name="children" id="children" class="form-control"
                                            placeholder="Children" min="0">
                                    </div>
                                    <div class="col-4">
                                        <input type="number" name="special_needs" id="special_needs" class="form-control"
                                            placeholder="Special Needs" min="0">
                                    </div>
                                </div>
                            </div>

                            <!-- Car Rent -->
                            <div class="col-md-6 col-12">
                                <label class="form-label fw-bold">Car Rent</label>
                                <div class="dropdown position-relative">
                                    <button class="form-select text-start d-flex align-items-center justify-content-between"
                                        type="button" id="carDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span id="selectedCarText">No, thanks</span>
                                        <i class="bi bi-chevron-down"></i>
                                    </button>

                                    <ul class="dropdown-menu w-100 shadow-lg p-2" aria-labelledby="carDropdown"
                                        style="max-height: 250px; overflow-y: auto;">
                                        <li class="dropdown-item p-2 car-item d-flex align-items-center"
                                            data-name="No, thanks" data-price="">

                                            <div>
                                                <div class="fw-semibold">No, thanks</div>
                                            </div>
                                        </li>
                                        @foreach($cars as $c)
                                            <li class="dropdown-item p-2 car-item d-flex align-items-center"
                                                data-name="{{ $c['name'] ?? '' }}" data-price="{{ $c['price'] ?? '' }}">
                                                <img src="{{ $c['image'] ?? asset('assets/images/default-car.jpg') }}"
                                                    alt="{{ $c['name'] }}" class="me-3 rounded"
                                                    style="width: 50px; height: 50px; object-fit: cover;">
                                                <div>
                                                    <div class="fw-semibold">{{ $c['name'] ?? '' }}</div>
                                                    <small class="text-muted">
                                                        Rp {{ number_format($c['price'] ?? 0, 0, ',', '.') }}
                                                    </small>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <select name="car_price" id="carSelect" class="d-none">
                                        <option value="">No, thanks</option>
                                        @foreach($cars as $c)
                                            <option value="{{ $c['price'] ?? '' }}">{{ $c['name'] ?? '' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary px-5 py-2 rounded-pill"
                                style="background-color:#12395D;">Calculate Price</button>
                        </div>

                        <div class="text-center mt-4 mb-2">
                            <button type="button" class="btn btn-success px-5 py-2 rounded-pill" id="continueBtn">
                                Continue
                            </button>
                        </div>
                    </form>

                    @if(session('totalPrice'))
                        <div class="alert alert-success mt-4 text-center fw-bold fs-5">
                            Estimated Total Price: Rp {{ number_format(session('totalPrice'), 0, ',', '.') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- ===== SCRIPT ===== --}}
    <script>
        // Validasi form
        document.getElementById('planningForm').addEventListener('submit', function (e) {
            var leaving = document.querySelector('input[name="leaving_date"]').value;
            var returning = document.querySelector('input[name="return_date"]').value;
            var adults = document.getElementById('adults').value;
            var children = document.getElementById('children').value;
            var specialNeeds = document.getElementById('special_needs').value;
            var guests = (parseInt(adults) || 0) + (parseInt(children) || 0) + (parseInt(specialNeeds) || 0);
            var errorMsg = '';

            if (!leaving || !returning) {
                errorMsg += 'Departure and return dates are required.<br>';
            }
            if (guests < 1) {
                errorMsg += 'At least 1 guest (adult/child/special needs) is required.';
            }
            if (errorMsg) {
                var alertDiv = document.getElementById('formErrorAlert');
                alertDiv.innerHTML = errorMsg;
                alertDiv.classList.remove('d-none');
                e.preventDefault();
            }
        });

        // Setup dropdown interaktif (destination, hotel, car)
        function setupDropdown(itemClass, selectedTextId, selectId) {
            const items = document.querySelectorAll('.' + itemClass);
            const selectedText = document.getElementById(selectedTextId);
            const hiddenSelect = document.getElementById(selectId);

            items.forEach(item => {
                item.addEventListener('click', function () {
                    const name = this.getAttribute('data-name');
                    const price = this.getAttribute('data-price');
                    selectedText.textContent = name;
                    hiddenSelect.value = price;
                });
            });
        }

        setupDropdown('destination-item', 'selectedDestinationText', 'destinationSelect');
        setupDropdown('hotel-item', 'selectedHotelText', 'hotelSelect');
        setupDropdown('car-item', 'selectedCarText', 'carSelect');
    </script>

    {{-- ===== STYLE ===== --}}
    <style>
        html,
        body {
            overflow-x: hidden !important;
            width: 100vw;
            box-sizing: border-box;
        } 

        .dropdown-item:hover {
            background-color: #f0f8ff;
            cursor: pointer;
            border-radius: 8px;
        }

        .dropdown-item img {
            transition: transform 0.2s ease;
        }

        .dropdown-item:hover img {
            transform: scale(1.05);
        }

        .dropdown-menu::-webkit-scrollbar {
            width: 6px;
        }

        .dropdown-menu::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 10px;
        }
    </style>

@endsection
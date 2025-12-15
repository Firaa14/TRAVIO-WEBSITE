@extends('layouts.app')

@section('title', 'Planning | Travio')

@section('content')
    @if(!Auth::check())
        <div class="container mt-5">
            <div class="text-center">
                <h3>Please Login to Access Planning</h3>
                <p>You need to be logged in to create travel plans.</p>
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                <a href="{{ route('register') }}" class="btn btn-outline-primary">Register</a>
            </div>
        </div>
    @else
        @include('components.heroplanning')

        <link rel="stylesheet" href="{{ asset('css/planning.css') }}">

        <section class="planning pt-4 pb-5 min-vh-100" style="background:#f8f9fa;">
            <div class="container-fluid px-3">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10 col-xl-8">
                        <p class="text-center text-muted mb-4">
                            Design your adventure — choose destinations, stays, and transportation.
                            Create a personalized travel package that fits your time and schedule.
                        </p>

                        <form id="planningForm" action="{{ route('planning.calculate') }}" method="POST"
                            class="bg-white shadow-lg rounded-4 p-4 p-md-5" autocomplete="off">
                            @csrf

                            <!-- TABS -->
                            <div class="planning-tabs-wrapper mb-3">
                                <div class="planning-pill active" data-target="tab-dates">
                                    <div>
                                        <div style="font-size: 13px; font-weight:700;">Leaving & Returning</div>
                                    </div>
                                </div>
                                <div class="planning-pill disabled" data-target="tab-destination">
                                    <div>
                                        <div style="font-size:13px; font-weight:700;">Destination</div>
                                    </div>
                                </div>
                                <div class="planning-pill disabled" data-target="tab-hotel">
                                    <div>
                                        <div style="font-size:13px; font-weight:700;">Hotel</div>
                                    </div>
                                </div>
                                <div class="planning-pill disabled" data-target="tab-guests">
                                    <div>
                                        <div style="font-size:13px; font-weight:700;">Guests</div>
                                    </div>
                                </div>
                                <div class="planning-pill disabled" data-target="tab-car">
                                    <div>
                                        <div style="font-size:13px; font-weight:700;">Car Rental</div>
                                    </div>
                                </div>
                            </div>

                            <!-- TAB PANE:  Dates -->
                            <div class="tab-pane active" id="tab-dates">
                                <h6 class="text-uppercase text-secondary" style="font-size:12px;">DATES</h6>
                                <h4 class="fw-semibold mb-4">When would you like to travel?</h4>
                                <div class="row g-3 dates-row">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Leaving Date <span
                                                class="text-danger">*</span></label>
                                        <input type="date" name="leaving_date" id="leaving_date" class="form-control" required
                                            min="{{ date('Y-m-d') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Return Date <span class="text-danger">*</span></label>
                                        <input type="date" name="return_date" id="return_date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="text-center mt-4">
                                    <button type="button" class="btn btn-primary btn-lg" id="confirm-dates">Confirm
                                        Dates</button>
                                </div>
                            </div>

                            <!-- TAB PANE: Destination -->
                            <div class="tab-pane" id="tab-destination">
                                <h6 class="text-uppercase text-secondary" style="font-size:12px;">DESTINATION</h6>
                                <h4 class="fw-semibold mb-2">Where would you like to go? </h4>
                                <p class="text-muted mb-3">Select at least 2 destinations <span class="text-danger">*</span></p>

                                <div id="destination-error" class="alert alert-danger" style="display: none;">
                                    <i class="bi bi-exclamation-triangle"></i> Please select at least 2 destinations.
                                </div>

                                <div class="item-list-wrapper">
                                    @foreach($destinations as $d)
                                        <div class="item-card destination-card" data-id="{{ $d['id'] ?? '' }}"
                                            data-name="{{ isset($d['name']) ? $d['name'] : '' }}" data-price="{{ isset($d['price']) ? $d['price'] : '' }}">
                                            <img src="{{ isset($d['image']) ? $d['image'] : asset('photos/destination1.jpg') }}"
                                                alt="{{ isset($d['name']) ? $d['name'] : '' }}" class="item-cover">
                                            <div>
                                                <div class="item-title">{{ isset($d['name']) ? $d['name'] : '' }}</div>
                                                <div class="item-sub mt-1">{{ isset($d['location']) ? $d['location'] : '' }}</div>
                                                <div class="item-benefit">
                                                    <i class="bi bi-ticket-perforated"></i>
                                                    Popular destination
                                                </div>
                                            </div>
                                            <div class="item-right">
                                                <div class="item-price">Rp{{ number_format(isset($d['price']) ? (int)$d['price'] : 0, 0, ',', '.') }}</div>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('destination.show', $d['id'] ?? 1) }}? from=planning"
                                                        class="btn btn-action btn-view-more">View More</a>
                                                    <button type="button" class="btn btn-action btn-select"
                                                        data-type="destination">Select</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- TAB PANE: Hotel -->
                            <div class="tab-pane" id="tab-hotel">
                                <h6 class="text-uppercase text-secondary" style="font-size:12px;">HOTEL</h6>
                                <h4 class="fw-semibold mb-2">Where would you like to stay?</h4>
                                <p class="text-muted mb-3">Select at least 1 hotel room <span class="text-danger">*</span></p>

                                <div id="hotel-error" class="alert alert-danger" style="display:none;">
                                    <i class="bi bi-exclamation-triangle"></i> Please select at least 1 hotel room.
                                </div>

                                <div class="item-list-wrapper">
                                    @foreach($hotels as $h)
                                        <div class="hotel-item-wrapper">
                                            <div class="item-card hotel-card" data-id="{{ $h['id'] ?? '' }}"
                                                data-name="{{ isset($h['name']) ? $h['name'] : '' }}" data-price="{{ isset($h['price']) ? $h['price'] : '' }}">
                                                <img src="{{ isset($h['image']) ? $h['image'] : asset('photos/hotel1.jpg') }}"
                                                    alt="{{ isset($h['name']) ? $h['name'] : '' }}" class="item-cover">
                                                <div>
                                                    <div class="item-title">{{ isset($h['name']) ? $h['name'] : '' }}</div>
                                                    <div class="item-sub mt-1"><i class="bi bi-geo-alt"></i>
                                                        {{ isset($h['location']) ? $h['location'] : '' }}
                                                    </div>
                                                    <div class="item-benefit">
                                                        <i class="bi bi-gift"></i>
                                                        New User Coupon 8% Off
                                                    </div>
                                                </div>
                                                <div class="item-right">
                                                    <div class="item-price">
                                                        Rp{{ number_format(isset($h['price']) ? (int)$h['price'] : 0, 0, ',', '.') }}/night
                                                    </div>
                                                    <div class="d-flex gap-2">
                                                        <a href="{{ route('hotels.show', $h['id'] ?? 1) }}"
                                                            class="btn btn-action btn-view-more">View More</a>
                                                        <button type="button" class="btn btn-action btn-select-room"
                                                            data-hotel-id="{{ $h['id'] ?? '' }}" data-type="hotel">
                                                            Select Room <i class="bi bi-chevron-down ms-1"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Room list area (hidden by default) -->
                                            <div class="rooms-list" id="rooms-{{ $h['id'] ?? '' }}" style="display: none;">
                                                <div class="text-center py-3">
                                                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                    <p class="mt-2 mb-0 text-muted">Loading rooms... </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- TAB PANE:  Guests -->
                            <div class="tab-pane" id="tab-guests">
                                <h6 class="text-uppercase text-secondary" style="font-size:12px;">GUESTS</h6>
                                <h4 class="fw-semibold mb-2">Who's coming with you?</h4>
                                <p class="text-muted mb-3">At least 1 person required <span class="text-danger">*</span></p>

                                <div id="guests-error" class="alert alert-danger" style="display:none;">
                                    <i class="bi bi-exclamation-triangle"></i> Please add at least 1 guest.
                                </div>

                                <div class="row guests-grid">
                                    <div class="col-4">
                                        <label class="form-label">Adults</label>
                                        <input type="number" name="adults" id="adults" class="form-control" min="1" value="1">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">Children</label>
                                        <input type="number" name="children" id="children" class="form-control" min="0"
                                            value="0">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">Special Needs</label>
                                        <input type="number" name="special_needs" id="special_needs" class="form-control"
                                            min="0" value="0">
                                    </div>
                                </div>
                            </div>

                            <!-- TAB PANE: Car Rental -->
                            <div class="tab-pane" id="tab-car">
                                <h6 class="text-uppercase text-secondary" style="font-size:12px;">CAR RENTAL</h6>
                                <h4 class="fw-semibold mb-2">Do you need a car? (Optional)</h4>
                                <p class="text-muted mb-3">This selection is optional</p>

                                <div class="item-list-wrapper">
                                    @foreach($cars as $c)
                                        <div class="item-card car-card" data-id="{{ $c['id'] ?? '' }}"
                                            data-name="{{ isset($c['name']) ? $c['name'] : '' }}" data-price="{{ isset($c['price']) ? $c['price'] : '' }}">
                                            <img src="{{ isset($c['image']) ? $c['image'] : asset('photos/mobil1.jpg') }}"
                                                alt="{{ isset($c['name']) ? $c['name'] : '' }}" class="item-cover">
                                            <div>
                                                <div class="item-title">{{ isset($c['name']) ? $c['name'] : '' }}</div>
                                                <div class="item-sub mt-1">{{ isset($c['brand']) ? $c['brand'] : '' }} • {{ isset($c['capacity']) ? $c['capacity'] : '' }}
                                                </div>
                                                <div class="item-benefit">
                                                    <i class="bi bi-car-front"></i>
                                                    Includes driver (if applicable)
                                                </div>
                                            </div>
                                            <div class="item-right">
                                                <div class="item-price">Rp{{ number_format(isset($c['price']) ? (int)$c['price'] : 0, 0, ',', '.') }}/day
                                                </div>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('cars.show', $c['id'] ?? 1) }}"
                                                        class="btn btn-action btn-view-more">View More</a>
                                                    <button type="button" class="btn btn-action btn-select"
                                                        data-type="car">Select</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- HIDDEN INPUTS -->
                            <input type="hidden" name="selected_destinations" value="">
                            <input type="hidden" name="selected_hotel_room" value="">
                            <input type="hidden" name="selected_cars" value="">

                            <!-- SUBMIT BUTTONS -->
                            <div class="text-center mt-5">
                                <button type="button" class="btn btn-primary btn-lg px-5" id="calculate-btn"
                                    style="display:none;">
                                    <i class="bi bi-calculator"></i> Calculate Now
                                </button>
                                <div id="calculate-error" class="mt-3"
                                    style="display:none; color:#d32f2f; font-weight:500; font-size:16px;">
                                </div>
                            </div>

                            <!-- CALCULATION SUMMARY -->
                            <div id="calculation-summary" class="mt-5 p-4 bg-light rounded-3 shadow-sm" style="display:none;">
                                <h5 class="mb-4"><i class="bi bi-receipt"></i> Your Selection Summary</h5>

                                <div class="row mb-4">
                                    <div class="col-md-6 mb-3">
                                        <div class="summary-section">
                                            <strong>📅 Travel Dates:</strong><br>
                                            <span id="summary-dates"></span><br>
                                            <small class="text-muted" id="summary-duration"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="summary-section">
                                            <strong>👥 Guests:</strong><br>
                                            <span id="summary-guests"></span>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="summary-items mb-4">
                                    <div class="summary-item">
                                        <strong>🏖️ Destinations:</strong>
                                        <div id="summary-destinations" class="ms-3">-</div>
                                    </div>
                                    <div class="summary-item mt-3">
                                        <strong>🏨 Hotel:</strong>
                                        <div id="summary-hotel" class="ms-3">-</div>
                                    </div>
                                    <div class="summary-item mt-3">
                                        <strong>🚗 Car Rental:</strong>
                                        <div id="summary-cars" class="ms-3">-</div>
                                    </div>
                                </div>

                                <hr>

                                <div class="pricing-breakdown mb-4">
                                    <h6 class="fw-bold text-secondary mb-3">Price Breakdown: </h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Destinations:</span>
                                                <span id="price-destinations">Rp 0</span>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Hotel: </span>
                                                <span id="price-hotel">Rp 0</span>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Car Rental:</span>
                                                <span id="price-cars">Rp 0</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr class="border-2">

                                <div class="fw-bold fs-5 text-center mb-4">
                                    Estimated Total: <span id="summary-total" class="text-primary" style="font-size:28px;">Rp
                                        0</span>
                                </div>

                                <div class="text-center">
                                    <button type="button" class="btn btn-success btn-lg" id="checkout-btn">
                                        <i class="bi bi-credit-card"></i> Proceed to Checkout
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <script src="{{ asset('js/planning.js') }}"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const leavingDateInput = document.getElementById('leaving_date');
                const returnDateInput = document.getElementById('return_date');
                const confirmDatesBtn = document.getElementById('confirm-dates');
                const calculateBtn = document.getElementById('calculate-btn');
                const checkoutBtn = document.getElementById('checkout-btn');
                const summaryDiv = document.getElementById('calculation-summary');

                let datesConfirmed = false;
                let selectedDestinations = [];
                let selectedCars = [];
                let selectedHotelRoom = null;

                // Date validation
                leavingDateInput.addEventListener('change', function () {
                    const leavingDate = new Date(this.value);
                    const today = new Date();
                    today.setHours(0, 0, 0, 0);

                    if (leavingDate < today) {
                        alert('Leaving date cannot be in the past.');
                        this.value = '';
                        return;
                    }

                    returnDateInput.min = this.value;
                    if (returnDateInput.value && returnDateInput.value < this.value) {
                        returnDateInput.value = this.value;
                    }
                });

                returnDateInput.addEventListener('change', function () {
                    const returnDate = new Date(this.value);
                    const leavingDate = new Date(leavingDateInput.value);

                    if (returnDate < leavingDate) {
                        alert('Return date cannot be earlier than leaving date.');
                        this.value = leavingDateInput.value;
                    }
                });

                // Confirm dates
                confirmDatesBtn.addEventListener('click', function () {
                    if (!leavingDateInput.value || !returnDateInput.value) {
                        alert('Please select both leaving and return dates.');
                        return;
                    }

                    datesConfirmed = true;
                    calculateBtn.style.display = 'block';

                    // Show success message
                    if (!document.getElementById('dates-confirmed-msg')) {
                        const confirmMsg = document.createElement('div');
                        confirmMsg.id = 'dates-confirmed-msg';
                        confirmMsg.className = 'alert alert-success mt-3';
                        confirmMsg.innerHTML = '<i class="bi bi-check-circle"></i> Dates confirmed!  You can now proceed to other sections.';
                        this.parentElement.appendChild(confirmMsg);
                        this.style.display = 'none';
                    }

                    // Enable other tabs
                    document.querySelectorAll('.planning-pill').forEach(pill => {
                        pill.classList.remove('disabled');
                    });
                });

                // Check dates before accessing other tabs
                function checkDatesBeforeAccess(tabTarget) {
                    if (tabTarget !== 'tab-dates' && !datesConfirmed) {
                        alert('Please confirm your dates first! ');
                        return false;
                    }
                    return true;
                }

                // Tab switching
                document.querySelectorAll('.planning-pill').forEach(pill => {
                    pill.addEventListener('click', function () {
                        if (this.classList.contains('disabled')) {
                            alert('Please confirm your dates first!');
                            return;
                        }

                        const target = this.dataset.target;

                        if (!checkDatesBeforeAccess(target)) {
                            return;
                        }

                        document.querySelectorAll('.planning-pill').forEach(p => p.classList.remove('active'));
                        document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));
                        this.classList.add('active');
                        document.getElementById(target).classList.add('active');
                    });
                });

                // Selection functionality
                function handleSelection(button, type) {
                    const card = button.closest('.item-card');
                    const id = card.dataset.id;

                    if (type === 'destination') {
                        if (selectedDestinations.includes(id)) {
                            selectedDestinations = selectedDestinations.filter(item => item !== id);
                            button.classList.remove('selected');
                            button.textContent = 'Select';
                        } else {
                            selectedDestinations.push(id);
                            button.classList.add('selected');
                            button.textContent = 'Selected ✓';
                        }
                        document.querySelector('input[name="selected_destinations"]').value = selectedDestinations.join(',');

                    } else if (type === 'car') {
                        if (selectedCars.includes(id)) {
                            selectedCars = selectedCars.filter(item => item !== id);
                            button.classList.remove('selected');
                            button.textContent = 'Select';
                        } else {
                            selectedCars.push(id);
                            button.classList.add('selected');
                            button.textContent = 'Selected ✓';
                        }
                        document.querySelector('input[name="selected_cars"]').value = selectedCars.join(',');
                    }
                }

                // Bind selection events
                document.querySelectorAll('.btn-select').forEach(button => {
                    button.addEventListener('click', function (e) {
                        e.preventDefault();
                        const type = this.dataset.type;
                        handleSelection(this, type);
                    });
                });

                // Hotel room selection
                document.querySelectorAll('.btn-select-room').forEach(button => {
                    button.addEventListener('click', function (e) {
                        e.preventDefault();
                        const hotelId = this.dataset.hotelId;
                        const roomsListDiv = document.getElementById('rooms-' + hotelId);

                        const isVisible = roomsListDiv.style.display !== 'none';

                        document.querySelectorAll('.rooms-list').forEach(list => {
                            list.style.display = 'none';
                        });

                        document.querySelectorAll('.btn-select-room').forEach(btn => {
                            btn.classList.remove('expanded');
                        });

                        if (isVisible) {
                            roomsListDiv.style.display = 'none';
                        } else {
                            roomsListDiv.style.display = 'block';
                            this.classList.add('expanded');

                            if (!roomsListDiv.dataset.loaded) {
                                loadHotelRooms(hotelId, roomsListDiv, this.closest('.hotel-card'));
                            }
                        }
                    });
                });

                // Function to load hotel rooms via AJAX
                function loadHotelRooms(hotelId, container, hotelCard) {
                    fetch(`/planning/hotel-rooms/${hotelId}`)
                        .then(response => response.json())
                        .then(rooms => {
                            container.dataset.loaded = 'true';

                            if (rooms.length === 0) {
                                container.innerHTML = '<div class="text-center py-3 text-muted">No rooms available</div>';
                                return;
                            }

                            let roomsHtml = '';
                            rooms.forEach(room => {
                                roomsHtml += `
                                                                                                            <div class="room-item">
                                                                                                                <div class="room-info">
                                                                                                                    <div class="room-name">${room.title || 'Room'}</div>
                                                                                                                    <div class="room-details">
                                                                                                                        <i class="bi bi-people"></i> ${room.max_guests || 2} guests
                                                                                                                        ${room.description ? ' • ' + room.description : ''}
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="d-flex align-items-center">
                                                                                                                    <div class="room-price">Rp${formatNumber(room.price || 0)}/night</div>
                                                                                                                    <button type="button" class="btn btn-select-this-room" 
                                                                                                                        data-room-id="${room.id}"
                                                                                                                        data-room-name="${room.title || 'Room'}"
                                                                                                                        data-room-price="${room.price || 0}"
                                                                                                                        data-hotel-id="${hotelId}"
                                                                                                                        data-hotel-name="${hotelCard.dataset.name}">
                                                                                                                        Select
                                                                                                                    </button>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        `;
                            });

                            container.innerHTML = roomsHtml;

                            container.querySelectorAll('.btn-select-this-room').forEach(btn => {
                                btn.addEventListener('click', function (e) {
                                    e.preventDefault();
                                    const roomData = {
                                        hotel_id: this.dataset.hotelId,
                                        hotel_name: this.dataset.hotelName,
                                        room_id: this.dataset.roomId,
                                        room_name: this.dataset.roomName,
                                        price: this.dataset.roomPrice
                                    };

                                    document.querySelectorAll('.btn-select-this-room').forEach(b => {
                                        b.textContent = 'Select';
                                        b.classList.remove('selected');
                                    });

                                    this.textContent = 'Selected ✓';
                                    this.classList.add('selected');

                                    selectedHotelRoom = roomData;
                                    document.querySelector('input[name="selected_hotel_room"]').value = JSON.stringify(roomData);
                                });
                            });
                        })
                        .catch(error => {
                            console.error('Error loading rooms:', error);
                            container.innerHTML = '<div class="text-center py-3 text-danger">Failed to load rooms.  Please try again.</div>';
                        });
                }

                // Helper function to format numbers
                function formatNumber(num) {
                    return new Intl.NumberFormat('id-ID').format(num);
                }

                // Calculate function
                calculateBtn.addEventListener('click', function (e) {
                    e.preventDefault();

                    const errorDiv = document.getElementById('calculate-error');
                    errorDiv.style.display = 'none';
                    errorDiv.textContent = '';

                    // Validation
                    if (selectedDestinations.length < 2) {
                        errorDiv.textContent = '❌ Please select at least 2 destinations.';
                        errorDiv.style.display = 'block';
                        return;
                    }

                    if (!selectedHotelRoom) {
                        errorDiv.textContent = '❌ Please select at least 1 hotel room.';
                        errorDiv.style.display = 'block';
                        return;
                    }

                    const adults = parseInt(document.getElementById('adults').value) || 0;
                    const children = parseInt(document.getElementById('children').value) || 0;
                    const specialNeeds = parseInt(document.getElementById('special_needs').value) || 0;
                    const totalGuests = adults + children + specialNeeds;

                    if (totalGuests < 1) {
                        errorDiv.textContent = '❌ Please add at least 1 guest.';
                        errorDiv.style.display = 'block';
                        return;
                    }

                    // Calculate prices
                    const leavingDate = new Date(leavingDateInput.value);
                    const returnDate = new Date(returnDateInput.value);
                    const days = Math.ceil((returnDate - leavingDate) / (1000 * 60 * 60 * 24));

                    let totalPrice = 0;
                    let destinationPrice = 0;
                    let hotelPrice = 0;
                    let carPrice = 0;

                    // Get destination prices
                    selectedDestinations.forEach(destId => {
                        const card = document.querySelector(`.destination-card[data-id="${destId}"]`);
                        if (card) {
                            const price = parseInt(card.dataset.price) || 0;
                            destinationPrice += price;
                        }
                    });

                    // Get hotel price
                    if (selectedHotelRoom) {
                        hotelPrice = parseInt(selectedHotelRoom.price) * days;
                    }

                    // Get car prices
                    selectedCars.forEach(carId => {
                        const card = document.querySelector(`.car-card[data-id="${carId}"]`);
                        if (card) {
                            const price = parseInt(card.dataset.price) || 0;
                            carPrice += price * days;
                        }
                    });

                    totalPrice = destinationPrice + hotelPrice + carPrice;

                    // Show summary
                    document.getElementById('summary-dates').textContent =
                        `${leavingDate.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' })} - ${returnDate.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' })}`;

                    document.getElementById('summary-duration').textContent = `${days} days`;

                    document.getElementById('summary-guests').textContent =
                        `${adults} Adult${adults !== 1 ? 's' : ''}${children > 0 ? `, ${children} Child${children !== 1 ? 'ren' : ''}` : ''}${specialNeeds > 0 ? `, ${specialNeeds} Special Need${specialNeeds !== 1 ? 's' : ''}` : ''}`;

                    // Destinations summary
                    let destSummary = '';
                    selectedDestinations.forEach(destId => {
                        const card = document.querySelector(`.destination-card[data-id="${destId}"]`);
                        if (card) {
                            const name = card.dataset.name;
                            destSummary += `<div class="mb-2">• ${name} - <strong>Rp${formatNumber(card.dataset.price)}</strong></div>`;
                        }
                    });
                    document.getElementById('summary-destinations').innerHTML = destSummary;

                    // Hotel summary
                    document.getElementById('summary-hotel').innerHTML =
                        `<div class="mb-2">${selectedHotelRoom.hotel_name} - ${selectedHotelRoom.room_name}</div><div class="text-muted">Rp${formatNumber(selectedHotelRoom.price)}/night × ${days} nights</div>`;

                    // Cars summary
                    if (selectedCars.length > 0) {
                        let carSummary = '';
                        selectedCars.forEach(carId => {
                            const card = document.querySelector(`.car-card[data-id="${carId}"]`);
                            if (card) {
                                const name = card.dataset.name;
                                carSummary += `<div class="mb-2">• ${name} - <strong>Rp${formatNumber(card.dataset.price)}/day</strong></div>`;
                            }
                        });
                        document.getElementById('summary-cars').innerHTML = carSummary;
                    } else {
                        document.getElementById('summary-cars').innerHTML = '<div class="text-muted">Not selected</div>';
                    }

                    // Price breakdown
                    document.getElementById('price-destinations').textContent = `Rp${formatNumber(destinationPrice)}`;
                    document.getElementById('price-hotel').textContent = `Rp${formatNumber(hotelPrice)}`;
                    document.getElementById('price-cars').textContent = `Rp${formatNumber(carPrice)}`;
                    document.getElementById('summary-total').textContent = `Rp${formatNumber(totalPrice)}`;

                    // Show summary
                    summaryDiv.style.display = 'block';
                    summaryDiv.scrollIntoView({ behavior: 'smooth' });
                });

                // Checkout function
                checkoutBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    // Store data in form before submitting
                    document.querySelector('input[name="leaving_date"]').value = leavingDateInput.value;
                    document.querySelector('input[name="return_date"]').value = returnDateInput.value;

                    // Submit to checkout (GET for demo, POST for real checkout)
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '/planning/checkout';

                    const csrfToken = document.querySelector('input[name="_token"]').value;

                    form.innerHTML = `
                        <input type="hidden" name="_token" value="${csrfToken}">
                        <input type="hidden" name="leaving_date" value="${leavingDateInput.value}">
                        <input type="hidden" name="return_date" value="${returnDateInput.value}">
                        <input type="hidden" name="selected_destinations" value="${selectedDestinations.join(',')}">
                        <input type="hidden" name="selected_hotel_room" value='${JSON.stringify(selectedHotelRoom)}'>
                        <input type="hidden" name="selected_cars" value="${selectedCars.join(',')}">
                        <input type="hidden" name="adults" value="${document.getElementById('adults').value}">
                        <input type="hidden" name="children" value="${document.getElementById('children').value}">
                        <input type="hidden" name="special_needs" value="${document.getElementById('special_needs').value}">
                    `;

                    document.body.appendChild(form);
                    form.submit();
                });

            });
        </script>
    @endif
@endsection
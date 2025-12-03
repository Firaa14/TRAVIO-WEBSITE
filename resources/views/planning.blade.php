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

    {{-- load css --}}
    <link rel="stylesheet" href="{{ asset('css/planning.css') }}">

    <section class="planning pt-4 pb-5 min-vh-100" style="background:#f8f9fa;">
        <div class="container">
            <p class="text-center text-muted mb-4">
                Design your adventure — choose destinations, stays, and transportation.
                Create a personalized travel package that fits your time and schedule.
            </p>

            <form id="planningForm" action="{{ route('planning.calculate') }}" method="POST"
                class="bg-white shadow-lg rounded-4 p-4" autocomplete="off">
                @csrf

                {{-- TABS --}}
                <div class="planning-tabs-wrapper mb-3">
                    <div class="planning-pill active" data-target="tab-dates">
                        <div>
                            <div style="font-size:13px; font-weight:700;">Leaving & Returning</div>
                        </div>
                    </div>

                    <div class="planning-pill" data-target="tab-destination">
                        <div>
                            <div style="font-size:13px; font-weight:700;">Destination</div>
                        </div>
                    </div>

                    <div class="planning-pill" data-target="tab-hotel">
                        <div>
                            <div style="font-size:13px; font-weight:700;">Hotel</div>
                        </div>
                    </div>

                    <div class="planning-pill" data-target="tab-guests">
                        <div>
                            <div style="font-size:13px; font-weight:700;">Guests</div>
                        </div>
                    </div>

                    <div class="planning-pill" data-target="tab-car">
                        <div>
                            <div style="font-size:13px; font-weight:700;">Car Rental</div>
                        </div>
                    </div>
                </div>

                {{-- TAB PANE: Dates --}}
                <div class="tab-pane active" id="tab-dates">
                    <div class="row g-3 dates-row">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Leaving Date</label>
                            <input type="date" name="leaving_date" id="leaving_date" class="form-control" required min="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Return Date</label>
                            <input type="date" name="return_date" id="return_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <button type="button" class="btn btn-primary" id="confirm-dates">Confirm Dates</button>
                    </div>
                </div>

                {{-- TAB PANE: Destination (cards list) --}}
                <div class="tab-pane" id="tab-destination">
                    <h6 class="text-uppercase text-secondary" style="font-size:12px;">DESTINATION</h6>
                    <h4 class="fw-semibold mb-3">Where would you like to go?</h4>
                    <div class="alert alert-warning" id="dates-required-alert" style="display:none;">
                        <i class="bi bi-exclamation-triangle"></i> Please select dates first before choosing destinations.
                    </div>

                    <div class="item-list-wrapper">
                        @foreach($destinations as $d)
                            <div class="item-card destination-card" data-id="{{ $d['id'] ?? '' }}"
                                data-name="{{ $d['name'] ?? '' }}" data-price="{{ $d['price'] ?? '' }}">
                                <img src="{{ $d['image'] ?? asset('photos/destination1.jpg') }}"
                                    alt="{{ $d['name'] }}" class="item-cover">

                                <div>
                                    <div class="item-title">{{ $d['name'] }}</div>
                                    <div class="item-sub mt-1">{{ $d['location'] ?? '' }}</div>
                                    <div class="item-benefit">
                                        <i class="bi bi-ticket-perforated"></i>
                                        Popular destination
                                    </div>
                                </div>

                                <div class="item-right">
                                    <div class="item-price">
                                        Rp{{ number_format($d['price'] ?? 0, 0, ',', '.') }}
                                    </div>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('destination.show', $d['id'] ?? 1) }}?from=planning"
                                            class="btn btn-action btn-view-more">View More</a>
                                        <button type="button" class="btn btn-action btn-select" data-type="destination">Select</button>
                                    </div>
                                    <div class="selected-notification" style="display:none;">
                                        <i class="bi bi-check-circle-fill text-success"></i> Selected
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- TAB PANE: Hotel (cards list) --}}
                <div class="tab-pane" id="tab-hotel">
                    <h6 class="text-uppercase text-secondary" style="font-size:12px;">HOTEL</h6>
                    <h4 class="fw-semibold mb-3">Where would you like to stay? (Optional)</h4>
                    <div class="alert alert-warning" id="dates-required-alert-hotel" style="display:none;">
                        <i class="bi bi-exclamation-triangle"></i> Please select dates first before choosing hotels.
                    </div>

                    <div class="item-list-wrapper">
                        @foreach($hotels as $h)
                            <div class="item-card hotel-card" data-id="{{ $h['id'] ?? '' }}" data-name="{{ $h['name'] ?? '' }}"
                                data-price="{{ $h['price'] ?? '' }}">
                                <img src="{{ $h['image'] ?? asset('photos/hotel1.jpg') }}"
                                    alt="{{ $h['name'] }}" class="item-cover">

                                <div>
                                    <div class="item-title">{{ $h['name'] }}</div>
                                    <div class="item-sub mt-1"><i class="bi bi-geo-alt"></i> {{ $h['location'] ?? '' }}</div>

                                    <div class="item-benefit">
                                        <i class="bi bi-gift"></i>
                                        New User Coupon 8% Off
                                    </div>
                                </div>

                                <div class="item-right">
                                    <div class="item-price">Rp{{ number_format($h['price'] ?? 0, 0, ',', '.') }}/night</div>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('hotels.show', $h['id'] ?? 1) }}"
                                            class="btn btn-action btn-view-more">View More</a>
                                        <button type="button" class="btn btn-action btn-select-room" data-hotel-id="{{ $h['id'] ?? '' }}" data-type="hotel">Select Room</button>
                                    </div>
                                    <div class="selected-notification" style="display:none;">
                                        <i class="bi bi-check-circle-fill text-success"></i> Selected
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- TAB PANE: Guests --}}
                <div class="tab-pane" id="tab-guests">
                    <h6 class="text-uppercase text-secondary" style="font-size:12px;">GUESTS</h6>
                    <h4 class="fw-semibold mb-3">Who's coming with you?</h4>

                    <div class="row guests-grid">
                        <div class="col-4">
                            <label class="form-label">Adults</label>
                            <input type="number" name="adults" class="form-control" min="0" value="1">
                        </div>
                        <div class="col-4">
                            <label class="form-label">Children</label>
                            <input type="number" name="children" class="form-control" min="0" value="0">
                        </div>
                        <div class="col-4">
                            <label class="form-label">Special Needs</label>
                            <input type="number" name="special_needs" class="form-control" min="0" value="0">
                        </div>
                    </div>
                </div>

                {{-- TAB PANE: Car Rental --}}
                <div class="tab-pane" id="tab-car">
                    <h6 class="text-uppercase text-secondary" style="font-size:12px;">CAR RENTAL</h6>
                    <h4 class="fw-semibold mb-3">Do you need a car? (Optional)</h4>
                    <div class="alert alert-warning" id="dates-required-alert-car" style="display:none;">
                        <i class="bi bi-exclamation-triangle"></i> Please select dates first before choosing cars.
                    </div>

                    <div class="item-list-wrapper">
                        @foreach($cars as $c)
                            <div class="item-card car-card" data-id="{{ $c['id'] ?? '' }}" data-name="{{ $c['name'] ?? '' }}"
                                data-price="{{ $c['price'] ?? '' }}">
                                <img src="{{ $c['image'] ?? asset('photos/mobil1.jpg') }}"
                                    alt="{{ $c['name'] }}" class="item-cover">

                                <div>
                                    <div class="item-title">{{ $c['name'] }}</div>
                                    <div class="item-sub mt-1">{{ $c['brand'] ?? '' }} • {{ $c['capacity'] ?? '' }}</div>
                                    <div class="item-benefit">
                                        <i class="bi bi-car-front"></i>
                                        Includes driver (if applicable)
                                    </div>
                                </div>

                                <div class="item-right">
                                    <div class="item-price">Rp{{ number_format($c['price'] ?? 0, 0, ',', '.') }}/day</div>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('cars.show', $c['id'] ?? 1) }}"
                                            class="btn btn-action btn-view-more">View More</a>
                                        <button type="button" class="btn btn-action btn-select" data-type="car">Select</button>
                                    </div>
                                    <div class="selected-notification" style="display:none;">
                                        <i class="bi bi-check-circle-fill text-success"></i> Selected
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- HIDDEN INPUTS TO STORE CHOICES --}}
                <input type="hidden" name="selected_destinations" value="">
                <input type="hidden" name="selected_hotel_room" value="">
                <input type="hidden" name="selected_cars" value="">

                {{-- SUBMIT --}}
                <div class="text-center mt-4">
                    <button type="submit" class="btn px-5 py-2 rounded-pill text-white" style="background:#12395D;"
                        id="calculate-btn">
                        Calculate Price
                    </button>
                    <div id="calculate-error" class="mt-2" style="display:none; color:#d32f2f; font-weight:500;"></div>
                </div>

                {{-- CALCULATION SUMMARY --}}
                @if(session('calculationResult'))
                    @php $result = session('calculationResult'); @endphp
                    <div id="calculation-summary" class="mt-4 p-3 bg-light rounded-3 shadow-sm"
                        style="max-width:500px; margin:auto;">
                        <h5 class="mb-3">Your Selection Summary</h5>
                        <div class="row">
                            <div class="col-6">
                                <strong>Dates:</strong><br>
                                {{ date('d M Y', strtotime($result['leaving_date'])) }} - {{ date('d M Y', strtotime($result['return_date'])) }}
                                <br>({{ $result['days'] }} days)
                            </div>
                            <div class="col-6">
                                <strong>Guests:</strong><br>
                                {{ $result['guests'] }} person(s)
                            </div>
                        </div>
                        <hr>
                        <ul class="list-unstyled mb-2">
                            @if(isset($result['selectedItems']['destinations']))
                                <li><strong>Destinations:</strong> {{ count($result['selectedItems']['destinations']) }} selected</li>
                            @endif
                            @if(isset($result['selectedItems']['hotel']))
                                <li><strong>Hotel:</strong> {{ $result['selectedItems']['hotel']['hotel_name'] }} - {{ $result['selectedItems']['hotel']['room_name'] }}</li>
                            @endif
                            @if(isset($result['selectedItems']['cars']))
                                <li><strong>Cars:</strong> {{ count($result['selectedItems']['cars']) }} selected</li>
                            @endif
                        </ul>
                        <div class="fw-bold fs-5 text-center mb-3">Estimated Total: <span class="text-primary">Rp{{ number_format($result['total'], 0, ',', '.') }}</span></div>
                        <div class="d-flex justify-content-center gap-3">
                            <form action="{{ route('planning.addToCart') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary">Add to Cart</button>
                            </form>
                            <form action="{{ route('planning.checkout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-primary">Checkout Now</button>
                            </form>
                        </div>
                    </div>
                @endif
            </form>
        </div>
    </section>

    {{-- Hotel Room Selection Modal --}}
    <div class="modal fade" id="hotelRoomModal" tabindex="-1" aria-labelledby="hotelRoomModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hotelRoomModalLabel">Select Room</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="roomsContainer">
                    <!-- Room options will be loaded here -->
                </div>
            </div>
        </div>
    </div>

@endif

    {{-- load js (make sure file is published in public/js/planning.js) --}}
    <script src="{{ asset('js/planning.js') }}"></script>

    {{-- Enhanced inline script for planning functionality --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const leavingDateInput = document.getElementById('leaving_date');
            const returnDateInput = document.getElementById('return_date');
            const confirmDatesBtn = document.getElementById('confirm-dates');
            
            let datesConfirmed = false;
            let selectedDestinations = [];
            let selectedCars = [];
            let selectedHotelRoom = null;

            // Date validation
            leavingDateInput.addEventListener('change', function() {
                const leavingDate = new Date(this.value);
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                
                if (leavingDate < today) {
                    alert('Leaving date cannot be in the past.');
                    this.value = '';
                    return;
                }
                
                // Set minimum return date
                returnDateInput.min = this.value;
                if (returnDateInput.value && returnDateInput.value < this.value) {
                    returnDateInput.value = this.value;
                }
            });

            returnDateInput.addEventListener('change', function() {
                const returnDate = new Date(this.value);
                const leavingDate = new Date(leavingDateInput.value);
                
                if (returnDate < leavingDate) {
                    alert('Return date cannot be earlier than leaving date.');
                    this.value = leavingDateInput.value;
                }
            });

            // Confirm dates
            confirmDatesBtn.addEventListener('click', function() {
                if (!leavingDateInput.value || !returnDateInput.value) {
                    alert('Please select both leaving and return dates.');
                    return;
                }
                
                datesConfirmed = true;
                this.style.display = 'none';
                
                // Add confirmation message
                const confirmMsg = document.createElement('div');
                confirmMsg.className = 'alert alert-success';
                confirmMsg.innerHTML = '<i class="bi bi-check-circle"></i> Dates confirmed! You can now select destinations and other options.';
                this.parentElement.appendChild(confirmMsg);
                
                // Enable other tabs
                document.querySelectorAll('.planning-pill').forEach(pill => {
                    pill.classList.remove('disabled');
                });
            });

            // Check if dates are confirmed before accessing other tabs
            function checkDatesBeforeAccess(tabTarget) {
                if (tabTarget !== 'tab-dates' && !datesConfirmed) {
                    document.querySelectorAll('.alert[id$="-required-alert"]').forEach(alert => {
                        alert.style.display = 'block';
                    });
                    return false;
                }
                document.querySelectorAll('.alert[id$="-required-alert"]').forEach(alert => {
                    alert.style.display = 'none';
                });
                return true;
            }

            // Enhanced tab switching
            document.querySelectorAll('.planning-pill').forEach(pill => {
                pill.addEventListener('click', function() {
                    const target = this.dataset.target;
                    
                    if (!checkDatesBeforeAccess(target)) {
                        // Switch back to dates tab
                        document.querySelectorAll('.planning-pill').forEach(p => p.classList.remove('active'));
                        document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));
                        document.querySelector('.planning-pill[data-target="tab-dates"]').classList.add('active');
                        document.getElementById('tab-dates').classList.add('active');
                        return;
                    }
                    
                    // Normal tab switching
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
                const name = card.dataset.name;
                const price = card.dataset.price;
                
                if (type === 'destination') {
                    if (selectedDestinations.includes(id)) {
                        selectedDestinations = selectedDestinations.filter(item => item !== id);
                        button.textContent = 'Select';
                        card.querySelector('.selected-notification').style.display = 'none';
                    } else {
                        selectedDestinations.push(id);
                        button.textContent = 'Selected';
                        card.querySelector('.selected-notification').style.display = 'block';
                    }
                    document.querySelector('input[name="selected_destinations"]').value = selectedDestinations.join(',');
                    
                } else if (type === 'car') {
                    if (selectedCars.includes(id)) {
                        selectedCars = selectedCars.filter(item => item !== id);
                        button.textContent = 'Select';
                        card.querySelector('.selected-notification').style.display = 'none';
                    } else {
                        selectedCars.push(id);
                        button.textContent = 'Selected';
                        card.querySelector('.selected-notification').style.display = 'block';
                    }
                    document.querySelector('input[name="selected_cars"]').value = selectedCars.join(',');
                }
            }

            // Bind selection events
            document.querySelectorAll('.btn-select').forEach(button => {
                button.addEventListener('click', function() {
                    const type = this.dataset.type;
                    handleSelection(this, type);
                });
            });

            // Hotel room selection
            document.querySelectorAll('.btn-select-room').forEach(button => {
                button.addEventListener('click', function() {
                    const hotelId = this.dataset.hotelId;
                    // For now, simulate room selection - in real implementation, you'd fetch rooms from API
                    const roomData = {
                        hotel_id: hotelId,
                        hotel_name: this.closest('.hotel-card').dataset.name,
                        room_id: 1,
                        room_name: 'Standard Room',
                        price: this.closest('.hotel-card').dataset.price
                    };
                    
                    selectedHotelRoom = roomData;
                    this.textContent = 'Selected';
                    this.closest('.item-card').querySelector('.selected-notification').style.display = 'block';
                    document.querySelector('input[name="selected_hotel_room"]').value = JSON.stringify(roomData);
                });
            });

            // Form validation
            document.getElementById('planningForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                if (!datesConfirmed) {
                    alert('Please confirm your dates first.');
                    return;
                }
                
                if (selectedDestinations.length === 0 && !selectedHotelRoom && selectedCars.length === 0) {
                    alert('Please select at least one destination, hotel, or car.');
                    return;
                }
                
                // Submit the form
                this.submit();
            });
        });
    </script>

@endsection
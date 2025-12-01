@extends('layouts.app')

@section('title', 'Planning | Travio')

@section('content')

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
                            <label class="form-label fw-bold">Leaving</label>
                            <input type="datetime-local" name="leaving_date" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Returning</label>
                            <input type="datetime-local" name="return_date" class="form-control" required>
                        </div>
                    </div>
                </div>

                {{-- TAB PANE: Destination (cards list) --}}
                <div class="tab-pane" id="tab-destination">
                    <h6 class="text-uppercase text-secondary" style="font-size:12px;">DESTINATION</h6>
                    <h4 class="fw-semibold mb-3">Where would you like to go?</h4>

                    <div class="item-list-wrapper">
                        @foreach($destinations as $d)
                            <div class="item-card destination-card" data-id="{{ $d['id'] ?? '' }}"
                                data-name="{{ $d['name'] ?? '' }}" data-price="{{ $d['price'] ?? '' }}">
                                <img src="{{ $d['image'] ?? asset('/mnt/data/1a8ca261-98e0-4985-81d2-ef10b95e14ed.png') }}"
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
                                        <button type="button" class="btn btn-action btn-select">Select</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- TAB PANE: Hotel (cards list) --}}
                <div class="tab-pane" id="tab-hotel">
                    <h6 class="text-uppercase text-secondary" style="font-size:12px;">HOTEL</h6>
                    <h4 class="fw-semibold mb-3">Where would you like to stay?</h4>

                    <div class="item-list-wrapper">
                        @foreach($hotels as $h)
                            <div class="item-card hotel-card" data-id="{{ $h['id'] ?? '' }}" data-name="{{ $h['name'] ?? '' }}"
                                data-price="{{ $h['price'] ?? '' }}">
                                <img src="{{ $h['image'] ?? asset('/mnt/data/1a8ca261-98e0-4985-81d2-ef10b95e14ed.png') }}"
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
                                    <div class="item-price">Rp{{ number_format($h['price'] ?? 0, 0, ',', '.') }}</div>
                                    <a href="{{ route('hotels.show', $h['id'] ?? 1) }}"
                                        class="btn btn-action btn-view-more">View More</a>
                                    <button type="button" class="btn btn-action btn-select-room">Select Room</button>
                                    <!-- Selected alert for hotel will be injected here by JS -->
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
                    <h4 class="fw-semibold mb-3">Do you need a car?</h4>

                    <div class="item-list-wrapper">
                        @foreach($cars as $c)
                            <div class="item-card car-card" data-id="{{ $c['id'] ?? '' }}" data-name="{{ $c['name'] ?? '' }}"
                                data-price="{{ $c['price'] ?? '' }}">
                                <img src="{{ $c['image'] ?? asset('/mnt/data/1a8ca261-98e0-4985-81d2-ef10b95e14ed.png') }}"
                                    alt="{{ $c['name'] }}" class="item-cover">

                                <div>
                                    <div class="item-title">{{ $c['name'] }}</div>
                                    <div class="item-sub mt-1">{{ $c['type'] ?? '' }} • {{ $c['capacity'] ?? '' }}</div>
                                    <div class="item-benefit">
                                        <i class="bi bi-car-front"></i>
                                        Includes driver (if applicable)
                                    </div>
                                </div>

                                <div class="item-right">
                                    <div class="item-price">Rp{{ number_format($c['price'] ?? 0, 0, ',', '.') }}</div>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('cars.show', $c['id'] ?? 1) }}"
                                            class="btn btn-action btn-view-more">View More</a>
                                        <button type="button" class="btn btn-action btn-select">Select</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- HIDDEN INPUTS TO STORE CHOICES --}}
                <input type="hidden" name="destination_price" value="">
                <input type="hidden" name="hotel_price" value="">
                <input type="hidden" name="car_price" value="">

                {{-- SUBMIT --}}
                <div class="text-center mt-4">
                    <button type="submit" class="btn px-5 py-2 rounded-pill text-white" style="background:#12395D;"
                        id="calculate-btn">
                        Calculate Price
                    </button>
                    <div id="calculate-error" class="mt-2" style="display:none; color:#d32f2f; font-weight:500;"></div>
                </div>

                {{-- CALCULATION SUMMARY --}}
                <div id="calculation-summary" class="mt-4 p-3 bg-light rounded-3 shadow-sm"
                    style="max-width:400px; margin:auto; display:none;">
                    <h5 class="mb-3">Your Selection Summary</h5>
                    <ul class="list-unstyled mb-2">
                        <li id="summary-destination">Destination: <span>-</span></li>
                        <li id="summary-hotel">Hotel: <span>-</span></li>
                        <li id="summary-car">Car Rental: <span>-</span></li>
                        <li id="summary-guests">Guests: <span>-</span></li>
                    </ul>
                    <div class="fw-bold">Estimated Total: <span id="summary-total">Rp0</span></div>
                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <button type="button" class="btn btn-action" id="add-to-cart-btn">Add to Cart</button>
                        <button type="button" class="btn btn-action" id="checkout-btn">Checkout</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    {{-- load js (make sure file is published in public/js/planning.js) --}}
    <script src="{{ asset('js/planning.js') }}"></script>

    {{-- small inline script to update the little summaries on pills and calculation summary --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // ...existing code...

            // Validation and calculation logic
            document.getElementById('planningForm').addEventListener('submit', function (e) {
                e.preventDefault();
                document.getElementById('calculate-error').style.display = 'none';
                document.getElementById('calculate-error').innerText = '';
                const leavingDate = document.querySelector('input[name="leaving_date"]').value;
                const returnDate = document.querySelector('input[name="return_date"]').value;
                const dest = document.querySelector('input[name="destination_price"]').value || '';
                const h = document.querySelector('input[name="hotel_price"]').value || '';
                const c = document.querySelector('input[name="car_price"]').value || '';
                const adults = document.querySelector('input[name="adults"]')?.value || 0;
                const children = document.querySelector('input[name="children"]')?.value || 0;
                const special = document.querySelector('input[name="special_needs"]')?.value || 0;
                const guestsTotal = (parseInt(adults) || 0) + (parseInt(children) || 0) + (parseInt(special) || 0);

                // Validation: require dates before other options
                if (!leavingDate || !returnDate) {
                    document.getElementById('calculate-error').innerText = 'Please select the dates first.';
                    document.getElementById('calculate-error').style.display = 'block';
                    return;
                }
                // Validation: require at least one of destination/hotel/car
                if (!dest && !h && !c) {
                    alert('Please select at least one option: Destination, Hotel, or Car Rental.');
                    return;
                }

                // If valid, show summary and buttons
                const summaryBox = document.getElementById('calculation-summary');
                summaryBox.style.display = 'block';
                document.getElementById('summary-destination').querySelector('span').innerText = dest ? 'Selected' : '-';
                document.getElementById('summary-hotel').querySelector('span').innerText = h ? 'Selected' : '-';
                document.getElementById('summary-car').querySelector('span').innerText = c ? 'Selected' : '-';
                document.getElementById('summary-guests').querySelector('span').innerText = guestsTotal + ' guest';
                let total = 0;
                total += parseInt(dest) || 0;
                total += parseInt(h) || 0;
                total += parseInt(c) || 0;
                total *= Math.max(guestsTotal, 1);
                document.getElementById('summary-total').innerText = 'Rp' + total.toLocaleString('id-ID');
            });

            // Show 'Selected' alert below button when Select is clicked
            function showSelectedAlert(btn) {
                let alertDiv = btn.parentNode.querySelector('.selected-inline');
                if (!alertDiv) {
                    alertDiv = document.createElement('span');
                    alertDiv.className = 'selected-inline';
                    btn.parentNode.appendChild(alertDiv);
                }
                alertDiv.innerText = 'Selected';
                alertDiv.style.opacity = '1';
                setTimeout(function () { alertDiv.style.opacity = '0'; }, 1500);
            }

            document.querySelectorAll('.btn-select').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    showSelectedAlert(this);
                    // Set hidden input value
                    const price = this.closest('.item-card').getAttribute('data-price');
                    const type = this.closest('.item-card').classList.contains('destination-card') ? 'destination_price' : 'car_price';
                    document.querySelector('input[name="' + type + '"]').value = price;
                });
            });

            document.querySelectorAll('.btn-select-room').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    // Remove any previous selected-inline message in this item-right
                    var itemRight = this.parentNode;
                    var oldAlert = itemRight.querySelector('.selected-inline');
                    if (oldAlert) oldAlert.remove();
                    // Show new selected message
                    var alertDiv = document.createElement('span');
                    alertDiv.className = 'selected-inline';
                    alertDiv.innerText = 'Selected';
                    this.parentNode.appendChild(alertDiv);
                    setTimeout(function () { alertDiv.style.opacity = '0'; }, 1500);
                    // Set hidden input value
                    const price = this.closest('.hotel-card').getAttribute('data-price');
                    document.querySelector('input[name="hotel_price"]').value = price;
                });
            });

            document.querySelectorAll('#calculate-btn').forEach(function (btn) {
                btn.addEventListener('click', function (e) {
                    var form = document.getElementById('planningForm');
                    var leavingDate = form.querySelector('input[name="leaving_date"]').value;
                    var returnDate = form.querySelector('input[name="return_date"]').value;
                    var errorDiv = document.getElementById('calculate-error');
                    errorDiv.style.display = 'none';
                    errorDiv.innerText = '';
                    if (!leavingDate || !returnDate) {
                        e.preventDefault();
                        errorDiv.innerText = 'Please select the dates first.';
                        errorDiv.style.display = 'block';
                    }
                });
            });
        });
    </script>

@endsection
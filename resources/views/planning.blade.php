<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body,
    html {
        overflow-x: hidden;
        width: 100vw;
    }

    .planning {
        max-width: 100vw;
        overflow-x: hidden;
    }

    .container,
    .container-fluid {
        max-width: 100vw;
        padding-left: 0;
        padding-right: 0;
    }
</style>

@include('components.navbar')
@include('components.heroplanning')



<section class="planning pt-4 pb-5 min-vh-100 d-flex align-items-start" style="background:#f8f9fa;">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <p class="text-center text-muted mb-5">Design your adventure — choose destinations, stays, and
                    transportation.
                    Create a personalized travel package that fits your time and schedule.</p>

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
                            <select name="destination_price" class="form-select">
                                <option value="">Select Destination</option>
                                @foreach($destinations as $d)
                                    <option value="{{ $d['price'] }}">{{ $d['name'] }} ({{ $d['discount'] }} off)</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Where to Stay -->
                        <div class="col-md-4 col-12">
                            <label class="form-label fw-bold">Where to Stay</label>
                            <select name="hotel_price" class="form-select">
                                <option value="">Select Hotel</option>
                                @foreach($hotels as $h)
                                    <option value="{{ $h['price'] }}">{{ $h['name'] }} - Rp
                                        {{ number_format($h['price'], 0, ',', '.') }}/night
                                    </option>
                                @endforeach
                            </select>
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
                            <select name="car_price" class="form-select" id="carSelect">
                                <option value="">No, thanks</option>
                                @foreach($cars as $c)
                                    <option value="{{ $c['price'] }}">{{ $c['name'] }} - Rp
                                        {{ number_format($c['price'], 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
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


<script>
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
</script>

@include('components.footer')
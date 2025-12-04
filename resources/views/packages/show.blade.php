@extends('layouts.app')

@section('title', 'Package Detail')

@section('content')
    @php
        $hideNavbar = true;
        $activeTab = $activeTab ?? 'details';
    @endphp

    @include('components.paketdetail', ['destination' => $package])

    <div class="container py-4">
        <!-- Tab Navigation -->
        <div class="d-flex justify-content-center border-bottom mb-5">
            <button
                class="btn btn-link text-decoration-none px-4 py-3 border-0 {{ $activeTab == 'details' ? 'text-primary border-bottom border-primary border-3' : 'text-muted' }}"
                onclick="switchTab('details')" id="details-tab" style="font-size: 20px;">
                Details
            </button>
            <button
                class="btn btn-link text-decoration-none px-4 py-3 border-0 {{ $activeTab == 'itinerary' ? 'text-primary border-bottom border-primary border-3' : 'text-muted' }}"
                onclick="switchTab('itinerary')" id="itinerary-tab" style="font-size: 20px;">
                Itinerary
            </button>
            <button
                class="btn btn-link text-decoration-none px-4 py-3 border-0 {{ $activeTab == 'facilities' ? 'text-primary border-bottom border-primary border-3' : 'text-muted' }}"
                onclick="switchTab('facilities')" id="facilities-tab" style="font-size: 20px;">
                Package Details
            </button>
        </div>

        <!-- Tab Content -->
        <div class="tab-content">
            <!-- Details Tab -->
            <div class="tab-pane {{ $activeTab == 'details' ? 'show active' : '' }}" id="details-content">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10">
                        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                            <img src="{{ asset('photos/' . $package->image) }}" alt="{{ $package->name }}"
                                class="card-img-top" style="height: 400px; object-fit: cover;">
                            <div class="card-body p-4">
                                <h5 class="card-title fw-bold text-primary mb-3">{{ $package->title }}</h5>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <small class="text-muted">Location:</small>
                                        <p class="fw-semibold">{{ $package->location ?? 'Various Destinations' }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <small class="text-muted">Duration:</small>
                                        <p class="fw-semibold">{{ $package->duration ?? '3 Days 2 Nights' }}</p>
                                    </div>
                                </div>
                                <p class="card-text text-muted fs-6 lh-lg mb-0">{{ $package->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Itinerary Tab -->
            <div class="tab-pane {{ $activeTab == 'itinerary' ? 'show active' : '' }}" id="itinerary-content">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10">
                        <div class="card shadow-lg border-0 rounded-4">
                            <div class="card-body p-4">
                                @if(is_array($package->itinerary))
                                    @foreach($package->itinerary as $index => $item)
                                        <div class="d-flex mb-4">
                                            <div class="me-4">
                                                <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center"
                                                    style="width: 45px; height: 45px; min-width: 45px;">
                                                    <span class="text-white fw-bold">{{ $index + 1 }}</span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="fw-semibold mb-2">Day {{ $index + 1 }}</h6>
                                                <p class="text-muted mb-0 lh-lg">{{ $item }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Package Details Tab -->
            <div class="tab-pane {{ $activeTab == 'facilities' ? 'show active' : '' }}" id="facilities-content">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10">
                        <div class="card shadow-lg border-0 rounded-4">
                            <div class="card-body p-4">
                                <div class="mb-4">
                                    <h6 class="fw-semibold text-primary mb-3">Package Price:</h6>
                                    @if(is_array($package->price))
                                        @foreach($package->price as $priceItem)
                                            <div class="mb-2">
                                                <span class="text-muted">• {{ $priceItem }}</span>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="d-flex align-items-center mb-3">
                                            <span class="fs-3 fw-bold text-primary me-3">Rp {{ number_format($package->base_price, 0, ',', '.') }}</span>
                                            <span class="badge bg-success">Best Value</span>
                                        </div>
                                        <p class="text-muted mb-0">per person</p>
                                    @endif
                                </div>

                                @if($package->include)
                                    <div class="mb-4">
                                        <h6 class="fw-semibold text-primary">Package Includes:</h6>
                                        <p class="text-muted mb-0">{{ $package->include }}</p>
                                    </div>
                                @endif

                                @if(is_array($package->facilities) && count($package->facilities) > 0)
                                    <div class="mb-4">
                                        <h6 class="fw-semibold text-primary mb-3">Facilities & Services:</h6>
                                        <ul class="list-unstyled">
                                            @foreach($package->facilities as $facility)
                                                <li class="mb-2">
                                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                                    {{ $facility }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="mt-4 text-center">
                                    <small class="text-muted fst-italic">
                                        Note: Package details and prices may vary depending on season and availability.
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Continue Button -->
        <div class="text-center mt-5">
            <a href="{{ route('package.booking.create', $package->id) }}" class="btn btn-primary px-5 py-2"
                style="background-color: #2E86AB; border: none;">
                Book This Package
            </a>
        </div>
    </div>

    <script>
        function switchTab(tab) {
            // Remove active class from all tabs
            document.querySelectorAll('.tab-pane').forEach(pane => {
                pane.classList.remove('show', 'active');
            });

            // Remove active styling from all tab buttons
            document.querySelectorAll('[id$="-tab"]').forEach(button => {
                button.classList.remove('text-primary', 'border-bottom', 'border-primary', 'border-3');
                button.classList.add('text-muted');
            });

            // Add active class to selected tab
            document.getElementById(tab + '-content').classList.add('show', 'active');
            document.getElementById(tab + '-tab').classList.remove('text-muted');
            document.getElementById(tab + '-tab').classList.add('text-primary', 'border-bottom', 'border-primary', 'border-3');

            // Update URL without page reload
            const url = new URL(window.location);
            url.searchParams.set('tab', tab);
            window.history.pushState({}, '', url);
        }
    </script>
@endsection
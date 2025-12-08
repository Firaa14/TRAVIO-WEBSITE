@extends('layouts.app')

@section('title', 'Destination Detail')

@section('content')
    @php
        $hideNavbar = true;
        $activeTab = $activeTab ?? 'details';
    @endphp

    @include('components.paketdetail', ['destination' => $destination])

    <div class="container py-4">
        <!-- Tab Navigation -->
        <div class="d-flex justify-content-center border-bottom mb-5">
            <button
                class="btn btn-link text-decoration-none px-4 py-3 border-0 {{ $activeTab == 'details' ? 'text-primary border-bottom border-primary border-3' : 'text-muted' }}"
                onclick="switchTab('details')" id="details-tab" style="font-size: 20px;">
                Details
            </button>
            <button
                class="btn btn-link text-decoration-none px-4 py-3 border-0 {{ $activeTab == 'price' ? 'text-primary border-bottom border-primary border-3' : 'text-muted' }}"
                onclick="switchTab('price')" id="price-tab" style="font-size: 20px;">
                Price Details
            </button>
        </div>

        <!-- Tab Content -->
        <div class="tab-content">
            <!-- Details Tab -->
            <div class="tab-pane {{ $activeTab == 'details' ? 'show active' : '' }}" id="details-content">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10">
                        <div class="card shadow-lg border-0 rounded-4">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-center mb-4">
                                    <img src="{{ asset('photos/' . $destination->image) }}" alt="{{ $destination->name }}"
                                        class="rounded" style="max-height: 300px; max-width: 100%; object-fit: contain;">
                                </div>
                                <p class="card-text text-muted fs-6 lh-lg mb-0">{{ $destination->detail }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Price Details Tab -->
            <div class="tab-pane {{ $activeTab == 'price' ? 'show active' : '' }}" id="price-content">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10">
                        <div class="card shadow-lg border-0 rounded-4">
                            <div class="card-body p-4">
                                @if(is_array($destination->price) && count($destination->price) > 0)
                                    @foreach($destination->price as $priceItem)
                                        @php
                                            $parts = explode(':', $priceItem, 2);
                                            $category = trim($parts[0] ?? '');
                                            $details = trim($parts[1] ?? '');
                                        @endphp
                                        <div class="mb-4">
                                            <h6 class="fw-semibold text-primary">{{ $category }} :</h6>
                                            <ul class="list-unstyled ms-3">
                                                @foreach(explode(',', $details) as $detail)
                                                    <li class="mb-2">• {{ trim($detail) }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach

                                    <div class="mt-4 text-center">
                                        <small class="text-muted fst-italic">
                                            Catatan : Harga dapat berubah sewaktu-waktu dan kebijakan perusahaan.
                                        </small>
                                    </div>
                                @else
                                    <div class="text-center py-5">
                                        <i class="bi bi-info-circle text-muted" style="font-size: 3rem;"></i>
                                        <p class="text-muted mt-3">Price details not available yet.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Continue Button -->
        <div class="text-center mt-5">
            <a href="{{ route('destination.booking.create', $destination->id) }}" class="btn btn-primary px-5 py-2"
                style="background-color: #2E86AB; border: none;">
                <i class="bi bi-calendar-check me-2"></i>
                Book This Destination
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
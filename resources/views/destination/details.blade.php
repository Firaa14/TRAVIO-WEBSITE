<div class="card shadow-sm p-4 mb-4 rounded-3">
    <h2 class="fw-bold mb-3">{{ $destination['name'] }}</h2>
    <img src="{{ $destination['image'] }}" alt="{{ $destination['name'] }}" class="img-fluid rounded-3 mb-3"
        style="max-width:480px; height:auto; display:block; margin:0 auto;">
    <p class="mb-2">{{ $destination['description'] }}</p>
    <p class="text-muted">Lokasi: {{ $destination['location'] }}</p>
</div>
<a href="{{ route('destination.show', ['id' => $destination['id'], 'tab' => 'itinerary']) }}" class="btn btn-primary continue-btn rounded-3 mt-3 w-100">Continue</a>
</div>
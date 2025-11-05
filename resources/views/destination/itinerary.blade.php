<div class="card shadow-sm p-4 mb-4 rounded-3">
    <h3 class="fw-bold mb-3">Itinerary</h3>
    <ul class="mb-0">
        @foreach($destination['itinerary'] as $item)
            <li>{{ $item }}</li>
        @endforeach
    </ul>
</div>
<a href="#" class="btn btn-primary continue-btn rounded-3 mt-3 w-100">Continue</a>
</div>
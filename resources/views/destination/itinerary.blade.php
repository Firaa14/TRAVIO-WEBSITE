<div class="card shadow-sm p-4 mb-4 rounded-3">
    <h3 class="fw-bold mb-3">Itinerary</h3>
    @if(isset($destination->itinerary) && $destination->itinerary)
        @if(is_array($destination->itinerary))
            <ul class="mb-0">
                @foreach($destination->itinerary as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        @else
            <div class="mb-0">
                {!! nl2br(e($destination->itinerary)) !!}
            </div>
        @endif
    @else
        <p class="text-muted">Itinerary belum tersedia.</p>
    @endif
</div>
<a href="{{ route('destination.show', ['id' => $destination->id, 'tab' => 'price']) }}"
    class="btn btn-primary continue-btn rounded-3 mt-3 w-100">Continue</a>
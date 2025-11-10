@extends('layouts.app')

@section('title', 'Destination Detail')

@section('content')
    <div class="container py-5">
        <h2 class="fw-bold mb-3">Destination Detail #{{ $id }}</h2>
        <p>This is where you can show full details about the selected destination (image, itinerary, price, etc).</p>
    </div>
@endsection
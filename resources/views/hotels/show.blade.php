@extends('layouts.app')

@section('title', 'Hotel Detail')

@section('content')
    <div class="container py-5">
        <h2 class="fw-bold mb-3">Hotel Detail #{{ $id }}</h2>
        <p>Full information about this hotel could be shown here (image, facilities, rating, price, booking button, etc).
        </p>
    </div>
@endsection
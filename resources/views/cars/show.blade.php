@extends('layouts.app')

@section('title', 'Car Detail')

@section('content')
    <div class="container py-5">
        <h2 class="fw-bold mb-3">Car Detail #{{ $id }}</h2>
        <p>This is where you can show full details about the selected car (image, specifications, price, etc).</p>

        <a href="{{ route('cars.index') }}" class="btn btn-primary mt-3">Back to Cars</a>
    </div>
@endsection
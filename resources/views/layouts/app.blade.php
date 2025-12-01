<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Travio')</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('...;/css/style.css') }}">

    @stack('styles')
</head>

<body>
    {{-- Navbar hanya tampil jika tidak disembunyikan --}}
    @if (!isset($hideNavbar) || !$hideNavbar)
        @include('components.navbar')
    @endif

    {{-- Hero Section jika ada --}}
    @yield('herogallery')

    {{-- Konten halaman --}}
    @yield('content')

    {{-- Footer selalu tampil --}}
    @include('components.footer')

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>

</html>
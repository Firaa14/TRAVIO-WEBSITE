<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Travio')</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('...;/css/style.css') }}">
</head>

<body>
    {{-- Navbar hanya tampil jika tidak disembunyikan --}}
    @if (!isset($hideNavbar) || !$hideNavbar)
        @include('components.navbar')
    @endif

    {{-- Konten halaman --}}
    @yield('content')

    {{-- Footer selalu tampil --}}
    @include('components.footer')

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
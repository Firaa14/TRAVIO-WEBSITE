<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Travio')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    {{-- Navbar hanya tampil jika tidak disembunyikan --}}
    @if (!isset($hideNavbar) || !$hideNavbar)
        @include('components.navbar')
    @endif

    @yield('content')

    {{-- Footer tetap tampil --}}
    @include('components.footer')
</body>

</html>
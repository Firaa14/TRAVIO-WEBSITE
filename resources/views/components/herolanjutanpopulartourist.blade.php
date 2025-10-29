<section class="position-relative text-white"
    style="height: 400px; background: url('{{ asset('photos/hero3.jpg') }}') center/cover no-repeat;">
    {{-- Lapisan gelap transparan --}}
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.6);"></div>

    <div class="position-relative h-100 d-flex flex-column justify-content-between pb-3">

        {{-- Tombol Back --}}
        <a href="{{ route('dashboard') }}"
            class="position-absolute top-0 start-0 m-4 text-white fw-semibold d-flex align-items-center"
            style="text-decoration:none; font-size:1rem;">
            <i class="bi bi-arrow-left-circle-fill me-1" style="font-size:1.5rem;"></i>
            Back </a>

        {{-- Judul Hero --}}
        <div class="text-center mt-auto">
            <h1 class="fw-bold mb-2" style="font-size:2.3rem;">Almost There!</h1>
            <p class="lead mb-3" style="font-size:1.1rem;">One last step to secure your adventure with Travio
            </p>
        </div>

        {{-- Submenu --}}
        @include('components.submenu')
    </div>
</section>
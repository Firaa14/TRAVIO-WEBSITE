@extends('layouts.app')
@section('title', 'Form Penyewaan Mobil')

@section('content')
    @php
        $hideNavbar = true;
        $activeTab = $activeTab ?? 'details';
    @endphp

    <div class="container py-4">

        <h3 class="fw-bold mb-3">Form Penyewaan Mobil</h3>
        <p class="text-muted">Lengkapi data berikut untuk melanjutkan pemesanan.</p>

        <form action="{{ route('cars.submit', $carId) }}" method="POST" enctype="multipart/form-data" class="row g-3">
            @csrf

            <!-- Tanggal Berangkat -->
            <div class="col-md-6">
                <label class="form-label fw-bold">Tanggal Berangkat</label>
                <input type="date" class="form-control" name="start_date" required>
            </div>

            <!-- Tanggal Selesai -->
            <div class="col-md-6">
                <label class="form-label fw-bold">Tanggal Selesai</label>
                <input type="date" class="form-control" name="end_date" required>
            </div>

            <!-- Jumlah Penumpang -->
            <div class="col-md-6">
                <label class="form-label fw-bold">Jumlah Penumpang</label>
                <input type="number" class="form-control" name="jumlah_penumpang" min="1" required>
            </div>

            <!-- Pilihan Driver -->
            <div class="col-md-6">
                <label class="form-label fw-bold">Membutuhkan Driver?</label>
                <select class="form-control" id="driverOption" name="driver" required>
                    <option value="">-- Pilih --</option>
                    <option value="dengan">Dengan Driver</option>
                    <option value="tanpa">Tanpa Driver</option>
                </select>
            </div>

            <!-- Durasi -->
            <div class="col-md-6">
                <label class="form-label fw-bold">Durasi Sewa</label>
                <select class="form-control" name="durasi" required>
                    <option value="">-- Pilih Durasi --</option>
                    <option value="half">Half Day (6 Jam)</option>
                    <option value="full">Full Day (12 Jam)</option>
                </select>
            </div>

            <!-- Nama Penyewa -->
            <div class="col-md-6">
                <label class="form-label fw-bold">Nama Penyewa</label>
                <input type="text" class="form-control" name="nama_penyewa" required>
            </div>

            <!-- Form khusus TANPA sopir -->
            <div id="tanpaDriverForm" style="display:none;">

                <div class="col-md-6 mt-3">
                    <label class="form-label fw-bold">Nama Sopir (yang membawa mobil)</label>
                    <input type="text" class="form-control" name="nama_sopir">
                </div>

                <div class="col-md-6 mt-3">
                    <label class="form-label fw-bold">Upload KTP Penyewa</label>
                    <input type="file" class="form-control" name="ktp">
                </div>

                <div class="col-md-6 mt-3">
                    <label class="form-label fw-bold">Upload SIM A Sopir</label>
                    <input type="file" class="form-control" name="sim_a">
                </div>

                <div class="col-md-6 mt-3">
                    <label class="form-label fw-bold">Upload Kartu Keluarga</label>
                    <input type="file" class="form-control" name="kk">
                </div>

            </div>

            <div class="col-12 mt-4">
                <button class="btn btn-primary w-100 py-2 fw-bold">Submit Pemesanan</button>
            </div>

        </form>
    </div>

    <script>
        const driverSelect = document.getElementById('driverOption');
        const tanpaDriverForm = document.getElementById('tanpaDriverForm');

        driverSelect.addEventListener('change', () => {
            if (driverSelect.value === 'tanpa') {
                tanpaDriverForm.style.display = 'block';
            } else {
                tanpaDriverForm.style.display = 'none';
            }
        });
    </script>

@endsection
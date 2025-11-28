@extends('layouts.app')
@section('title', 'Checkout Mobil')

@section('content')

    <div class="container py-5">
        <!-- Step Indicator -->
        <div class="mb-4">
            <ul class="step-indicator">

            </ul>
        </div>
        <h3 class="fw-bold mb-4 text-gradient">Checkout Mobil</h3>
        <form id="checkoutForm" method="POST" action="{{ route('cars.mobil.submit') }}" enctype="multipart/form-data"
            autocomplete="off">
            @csrf
            <div class="card mb-4 shadow-sm animated-card">
                <div class="card-body">
                    <h5 class="fw-bold mb-3"><i class="bi bi-person-circle me-2"></i>Data Penyewa</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-person-fill me-1"></i>Nama Penyewa</label>
                            <input type="text" name="nama_penyewa" class="form-control input-animated" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-whatsapp me-1"></i>No. Telp (WhatsApp)</label>
                            <input type="text" name="phone" class="form-control input-animated" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-envelope-fill me-1"></i>Email</label>
                            <input type="email" name="email" class="form-control input-animated" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-geo-alt-fill me-1"></i>Alamat Lengkap</label>
                            <input type="text" name="address" class="form-control input-animated" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4 shadow-sm animated-card">
                <div class="card-body">
                    <h5 class="fw-bold mb-3"><i class="bi bi-car-front me-2"></i>Detail Mobil & Sewa</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Mobil</label>
                            <input type="text" name="mobil_name" class="form-control"
                                value="{{ $mobil['name'] ?? 'Toyota Avanza' }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Berangkat</label>
                            <input type="date" name="start_date" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Selesai</label>
                            <input type="date" name="end_date" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Durasi Sewa</label>
                            <select name="durasi" class="form-select" required>
                                <option value="">Pilih Durasi</option>
                                <option value="half">Half Day (6 Jam)</option>
                                <option value="full">Full Day (12 Jam)</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Jumlah Penumpang</label>
                            <input type="number" name="jumlah_penumpang" class="form-control" min="1" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Driver</label>
                            <select name="driver" class="form-select" id="driverOption" required>
                                <option value="">Pilih</option>
                                <option value="dengan">Dengan Driver</option>
                                <option value="tanpa">Tanpa Driver</option>
                            </select>
                        </div>
                        <div id="tanpaDriverFields" style="display:none;">
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Nama Sopir (yang membawa mobil)</label>
                                <input type="text" class="form-control" name="nama_sopir" id="namaSopirField">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Upload Foto SIM Sopir</label>
                                <input type="file" class="form-control" name="sim_sopir" id="simSopirField"
                                    accept=".jpg,.jpeg,.png,.pdf">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Upload Foto KTP Sopir</label>
                                <input type="file" class="form-control" name="ktp_sopir" id="ktpSopirField"
                                    accept=".jpg,.jpeg,.png,.pdf">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Upload Foto KTP Penyewa</label>
                                <input type="file" class="form-control" name="ktp_penyewa" id="ktpPenyewaField"
                                    accept=".jpg,.jpeg,.png,.pdf">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Upload Foto Wajah Sopir</label>
                                <input type="file" class="form-control" name="face_sopir" id="faceSopirField"
                                    accept=".jpg,.jpeg,.png">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Upload Foto Wajah Penyewa</label>
                                <input type="file" class="form-control" name="face_penyewa" id="facePenyewaField"
                                    accept=".jpg,.jpeg,.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4 shadow-sm animated-card">
                <div class="card-body">
                    <h5 class="fw-bold mb-3"><i class="bi bi-credit-card-2-front me-2"></i>Pembayaran</h5>
                    <div class="mb-3">
                        <label class="form-label">Metode Pembayaran</label>
                        <select name="payment_method" class="form-select" id="paymentMethod" required>
                            <option value="" disabled selected>Pilih Metode</option>
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="qris">QRIS</option>
                            <option value="e_wallet">E-wallet</option>
                            <option value="cash">Cash</option>
                        </select>
                    </div>
                    <div id="adminWaInfo" class="alert alert-info d-none">
                        Silakan kirim bukti pembayaran ke admin WhatsApp: <b>+62 812-3456-7890</b>
                    </div>
                    <div class="mb-3" id="paymentProofSection" style="display:none;">
                        <label class="form-label">Upload Bukti Pembayaran</label>
                        <input type="file" name="payment_proof" class="form-control" accept=".jpg,.jpeg,.png,.pdf" required>
                        <small class="text-muted">Max 5MB. Allowed: JPG, PNG, PDF.</small>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success w-100 py-3 fw-bold btn-animated">Submit Pembayaran</button>
        </form>
        <!-- Toast Notification -->
        <div id="toast" class="toast align-items-center text-white bg-success border-0 position-fixed bottom-0 end-0 m-4"
            role="alert" aria-live="assertive" aria-atomic="true" style="display:none;z-index:9999;">
            <div class="d-flex">
                <div class="toast-body">
                    Pembayaran berhasil! Anda akan diarahkan ke halaman invoice...
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const paymentMethod = document.getElementById('paymentMethod');
            const adminWaInfo = document.getElementById('adminWaInfo');
            const paymentProofSection = document.getElementById('paymentProofSection');
            const checkoutForm = document.getElementById('checkoutForm');
            const toast = document.getElementById('toast');
            const driverOption = document.getElementById('driverOption');
            const tanpaDriverFields = document.getElementById('tanpaDriverFields');

            driverOption.addEventListener('change', function () {
                if (this.value === 'tanpa') {
                    tanpaDriverFields.style.display = 'block';
                    // Set required attributes
                    document.getElementById('namaSopirField').setAttribute('required', 'required');
                    document.getElementById('simSopirField').setAttribute('required', 'required');
                    document.getElementById('ktpSopirField').setAttribute('required', 'required');
                    document.getElementById('ktpPenyewaField').setAttribute('required', 'required');
                    document.getElementById('faceSopirField').setAttribute('required', 'required');
                    document.getElementById('facePenyewaField').setAttribute('required', 'required');
                } else {
                    tanpaDriverFields.style.display = 'none';
                    // Remove required attributes
                    document.getElementById('namaSopirField').removeAttribute('required');
                    document.getElementById('simSopirField').removeAttribute('required');
                    document.getElementById('ktpSopirField').removeAttribute('required');
                    document.getElementById('ktpPenyewaField').removeAttribute('required');
                    document.getElementById('faceSopirField').removeAttribute('required');
                    document.getElementById('facePenyewaField').removeAttribute('required');
                }
            });

            paymentMethod.addEventListener('change', function () {
                if (this.value) {
                    adminWaInfo.classList.remove('d-none');
                    paymentProofSection.style.display = 'block';
                } else {
                    adminWaInfo.classList.add('d-none');
                    paymentProofSection.style.display = 'none';
                }
            });

            checkoutForm.addEventListener('submit', function (e) {
                // Extra validation for tanpa driver
                if (driverOption.value === 'tanpa') {
                    let valid = true;
                    ['namaSopirField', 'simSopirField', 'ktpSopirField', 'ktpPenyewaField', 'faceSopirField', 'facePenyewaField'].forEach(function (id) {
                        const el = document.getElementById(id);
                        if (!el.value) valid = false;
                    });
                    if (!valid) {
                        alert('Semua data sopir dan penyewa wajib diisi untuk opsi tanpa driver!');
                        e.preventDefault();
                        return;
                    }
                }
                e.preventDefault();
                toast.style.display = 'block';
                setTimeout(function () {
                    checkoutForm.submit();
                }, 2000);
            });
        });
    </script>
    <style>
        .step-indicator {
            display: flex;
            list-style: none;
            padding: 0;
            margin-bottom: 0;
            justify-content: center;
        }

        .step-indicator li {
            position: relative;
            padding: 0 30px 0 0;
            color: #aaa;
            font-weight: 500;
            font-size: 1rem;
            transition: color 0.3s;
        }

        .step-indicator li.active {
            color: #28a745;
        }

        .step-indicator li span {
            background: #28a745;
            color: #fff;
            border-radius: 50%;
            padding: 6px 12px;
            margin-right: 8px;
            font-weight: bold;
            box-shadow: 0 2px 8px rgba(40, 167, 69, 0.15);
        }

        .step-indicator li:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 50%;
            right: 10px;
            width: 30px;
            height: 3px;
            background: #e0e0e0;
            transform: translateY(-50%);
        }

        .text-gradient {
            background: linear-gradient(90deg, #28a745, #20c997);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .animated-card {
            transition: box-shadow 0.3s, transform 0.3s;
        }

        .animated-card:hover {
            box-shadow: 0 8px 32px rgba(40, 167, 69, 0.15);
            transform: translateY(-4px) scale(1.01);
        }

        .input-animated:focus {
            border-color: #28a745;
            box-shadow: 0 0 0 2px rgba(40, 167, 69, 0.15);
            transition: box-shadow 0.2s;
        }

        .btn-animated {
            transition: background 0.3s, transform 0.2s;
        }

        .btn-animated:hover {
            background: linear-gradient(90deg, #28a745, #20c997);
            transform: scale(1.03);
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection
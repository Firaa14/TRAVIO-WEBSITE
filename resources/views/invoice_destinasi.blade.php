@extends('layouts.app')
@section('title', 'Invoice Destinasi')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-primary text-white text-center py-4 rounded-top-4">
                        <h3 class="fw-bold mb-0">
                            <i class="bi bi-receipt me-2"></i>Invoice Destinasi
                        </h3>
                        <p class="mb-0">Booking ID: {{ $booking['id'] }}</p>
                    </div>
                    <div class="card-body p-4">

                        {{-- Status --}}
                        <div class="alert alert-info text-center mb-4 rounded-3">
                            <i class="bi bi-clock-history me-2"></i>
                            <strong>Status: {{ $booking['status'] }}</strong>
                            <br><small>Pembayaran Anda sedang dalam proses verifikasi</small>
                        </div>

                        {{-- Informasi Pemesan --}}
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5 class="fw-bold text-primary mb-3">
                                    <i class="bi bi-person-circle me-2"></i>Data Pemesan
                                </h5>
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Nama:</strong></td>
                                        <td>{{ $booking['traveler']['full_name'] }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Telepon:</strong></td>
                                        <td>{{ $booking['traveler']['phone'] }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email:</strong></td>
                                        <td>{{ $booking['traveler']['email'] }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Jenis Kelamin:</strong></td>
                                        <td>{{ ucfirst($booking['traveler']['gender']) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tanggal Lahir:</strong></td>
                                        <td>{{ $booking['traveler']['dob'] }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h5 class="fw-bold text-primary mb-3">
                                    <i class="bi bi-telephone-fill me-2"></i>Kontak Darurat
                                </h5>
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Nama:</strong></td>
                                        <td>{{ $booking['traveler']['emergency_name'] }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Telepon:</strong></td>
                                        <td>{{ $booking['traveler']['emergency_phone'] }}</td>
                                    </tr>
                                </table>

                                <h5 class="fw-bold text-success mb-3 mt-4">
                                    <i class="bi bi-credit-card me-2"></i>Pembayaran
                                </h5>
                                <p><strong>Metode:</strong> {{ ucfirst(str_replace('_', ' ', $booking['payment_method'])) }}
                                </p>
                            </div>
                        </div>

                        <hr>

                        {{-- Detail Destinasi --}}
                        <div class="mb-4">
                            <h5 class="fw-bold text-primary mb-3">
                                <i class="bi bi-geo-alt-fill me-2"></i>Detail Destinasi
                            </h5>
                            <div class="row">
                                <div class="col-md-8">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Destinasi:</strong></td>
                                            <td>{{ $booking['destination']['title'] }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tanggal Trip:</strong></td>
                                            <td>{{ $booking['destination']['date'] }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Harga per Orang:</strong></td>
                                            <td>Rp {{ number_format($booking['destination']['price'], 0, ',', '.') }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Jumlah Peserta:</strong></td>
                                            <td>{{ $booking['destination']['participants'] }} orang</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-4 text-end">
                                    <div class="bg-light p-3 rounded-3">
                                        <h6 class="text-muted mb-1">Total Pembayaran</h6>
                                        <h4 class="fw-bold text-success mb-0">{{ $booking['destination']['total_price'] }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        {{-- Alamat --}}
                        <div class="mb-4">
                            <h5 class="fw-bold text-primary mb-3">
                                <i class="bi bi-house-door me-2"></i>Alamat Lengkap
                            </h5>
                            <p class="mb-0">{{ $booking['traveler']['address'] }}</p>
                        </div>

                        <hr>

                        {{-- Footer --}}
                        <div class="text-center">
                            <p class="text-muted mb-2">Terima kasih telah mempercayai <strong>Travio</strong> untuk
                                perjalanan Anda!</p>
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">Kembali ke Dashboard</a>
                                <button onclick="window.print()" class="btn btn-primary">
                                    <i class="bi bi-printer me-2"></i>Cetak Invoice
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {

            .btn,
            .alert {
                display: none !important;
            }

            .card {
                box-shadow: none !important;
                border: 1px solid #ddd !important;
            }
        }
    </style>
@endsection
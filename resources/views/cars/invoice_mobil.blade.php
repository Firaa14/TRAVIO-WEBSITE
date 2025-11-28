@extends('layouts.app')
@section('title', 'Invoice Penyewaan Mobil')

@section('content')
    <div class="container py-5">
        <div class="card shadow-lg border-0 rounded-4 p-4 mx-auto animated-card invoice-bg"
            style="max-width:700px;position:relative;">
            <div class="card-body position-relative">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="d-flex align-items-center">
                        <img src="/photos/logo.png" alt="TRAVIO" style="height:48px;width:auto;margin-right:16px;">
                        <div>
                            <h4 class="mb-0 fw-bold">TRAVIO TOUR & TRAVEL</h4>
                            <small class="text-muted">Jl. Wisata No. 123, Jakarta | Telp: (021) 12345678</small>
                        </div>
                    </div>
                    <div class="text-end">
                        <h5 class="fw-bold mb-0">INVOICE MOBIL</h5>
                        <span class="text-muted">{{ date('d F Y') }}</span>
                    </div>
                </div>
                <hr>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-2"><strong>Booking ID:</strong> {{ $booking['id'] ?? 'INV-MOBIL-001' }}</div>
                        <div><strong>Nama Penyewa:</strong> {{ $booking['nama_penyewa'] ?? 'Dummy User' }}</div>
                        <div><strong>No. Telp:</strong> {{ $booking['phone'] ?? '08123456789' }}</div>
                        <div><strong>Email:</strong> {{ $booking['email'] ?? 'dummy@email.com' }}</div>
                        <div><strong>Alamat:</strong> {{ $booking['address'] ?? 'Jl. Dummy No. 1' }}</div>
                    </div>
                    <div class="col-md-6">
                        <div><strong>Driver:</strong> {{ $booking['driver'] ?? 'dengan' }}</div>
                        <div><strong>Durasi:</strong> {{ $booking['durasi'] ?? 'full' }}</div>
                        <div><strong>Jumlah Penumpang:</strong> {{ $booking['jumlah_penumpang'] ?? '4' }}</div>
                    </div>
                </div>
                <table class="table table-bordered mb-4 invoice-table">
                    <thead class="table-light">
                        <tr>
                            <th>Mobil</th>
                            <th>Tgl. Berangkat</th>
                            <th>Tgl. Selesai</th>
                            <th>Durasi</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $booking['mobil_name'] ?? 'Toyota Avanza' }}</td>
                            <td>{{ $booking['start_date'] ?? '2025-12-10' }}</td>
                            <td>{{ $booking['end_date'] ?? '2025-12-12' }}</td>
                            <td>{{ $booking['durasi'] ?? 'full' }}</td>
                            <td><strong>Rp{{ number_format((float) ($booking['total_price'] ?? 500000), 0, ',', '.') }}</strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div><strong>Metode Pembayaran:</strong>
                            {{ ucfirst(str_replace('_', ' ', $booking['payment_method'] ?? 'bank_transfer')) }}</div>
                        <div><strong>Bukti Transfer:</strong> <a href="#" target="_blank">Lihat File</a></div>
                    </div>
                    <div class="col-md-6">
                        <div><strong>Status:</strong> <span class="badge bg-warning text-dark">Pending Verification</span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row mt-5">
                    <div class="col-md-6">
                        <div class="mt-4">
                            <small class="text-muted">Terima kasih atas kepercayaan Anda menggunakan layanan TRAVIO. Invoice
                                ini sah tanpa tanda tangan basah.</small>
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <div class="mb-5">Jakarta, {{ date('d F Y') }}</div>
                        <div style="height:60px;"></div>
                        <div class="fw-bold">TRAVIO ADMIN</div>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button class="btn btn-gradient btn-lg btn-animated" onclick="window.print()">
                        <i class="bi bi-file-earmark-pdf"></i> Download PDF Invoice
                    </button>
                </div>
            </div>
        </div>
    </div>
    <style>
        .invoice-bg {
            background: #fff;
            position: relative;
            overflow: hidden;
            border: 1px solid #e0e0e0;
        }

        .animated-card {
            transition: box-shadow 0.3s, transform 0.3s;
        }

        .animated-card:hover {
            box-shadow: 0 8px 32px rgba(40, 167, 69, 0.15);
            transform: translateY(-4px) scale(1.01);
        }

        .invoice-table th,
        .invoice-table td {
            vertical-align: middle;
            text-align: center;
        }

        .btn-gradient {
            background: linear-gradient(90deg, #28a745, #20c997);
            color: #fff;
            border: none;
        }

        .btn-gradient:hover {
            background: linear-gradient(90deg, #20c997, #28a745);
            color: #fff;
            transform: scale(1.04);
        }

        .btn-animated {
            transition: background 0.3s, transform 0.2s;
        }

        @media print {

            .btn-gradient,
            .btn-animated,
            .toast,
            .position-fixed {
                display: none !important;
            }

            .invoice-bg {
                box-shadow: none !important;
                border: none !important;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection
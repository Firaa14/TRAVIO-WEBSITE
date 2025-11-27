@extends('layouts.app')
@section('title', 'Invoice')

@section('content')
    <!-- Toast Notification -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
        <div id="invoiceToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <strong>Pembayaran berhasil!</strong> Invoice Anda sudah dibuat dan bisa diunduh.
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="card shadow-lg border-0 rounded-4 p-4 mx-auto animated-card invoice-bg"
            style="max-width:700px;position:relative;">
            <div class="card-body position-relative">
                <!-- Header Invoice -->
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="d-flex align-items-center">
                        <img src="/photos/logo.png" alt="TRAVIO" style="height:48px;width:auto;margin-right:16px;">
                        <div>
                            <h4 class="mb-0 fw-bold">TRAVIO TOUR & TRAVEL</h4>
                            <small class="text-muted">Jl. Wisata No. 123, Jakarta | Telp: (021) 12345678</small>
                        </div>
                    </div>
                    <div class="text-end">
                        <h5 class="fw-bold mb-0">INVOICE</h5>
                        <span class="text-muted">{{ date('d F Y') }}</span>
                    </div>
                </div>
                <hr>
                <!-- Info & Booking -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-2"><strong>Booking ID:</strong> {{ $booking['id'] }}</div>
                        <div><strong>Nama Pemesan:</strong> {{ $booking['traveler']['full_name'] }}</div>
                        <div><strong>No. Telp:</strong> {{ $booking['traveler']['phone'] }}</div>
                        <div><strong>Email:</strong> {{ $booking['traveler']['email'] }}</div>
                        <div><strong>Alamat:</strong> {{ $booking['traveler']['address'] }}</div>
                    </div>
                    <div class="col-md-6">
                        <div><strong>Emergency Contact:</strong> {{ $booking['traveler']['emergency_name'] }}
                            ({{ $booking['traveler']['emergency_phone'] }})</div>
                        <div><strong>Gender:</strong> {{ ucfirst($booking['traveler']['gender']) }}</div>
                        <div><strong>Date of Birth:</strong> {{ $booking['traveler']['dob'] }}</div>
                    </div>
                </div>
                <!-- Trip Table -->
                <table class="table table-bordered mb-4 invoice-table">
                    <thead class="table-light">
                        <tr>
                            <th>Trip Title</th>
                            <th>Date</th>
                            <th>Price/Person</th>
                            <th>Participants</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $booking['trip']['title'] }}</td>
                            <td>{{ $booking['trip']['date'] }}</td>
                            <td>Rp{{ number_format((float) $booking['trip']['price'], 0, ',', '.') }}</td>
                            <td>{{ $booking['trip']['participants'] }}</td>
                            <td><strong>Rp{{ number_format((float) $booking['trip']['total_price'], 0, ',', '.') }}</strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- Payment Info -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div><strong>Metode Pembayaran:</strong>
                            {{ ucfirst(str_replace('_', ' ', $booking['payment_method'])) }}</div>
                        <div><strong>Bukti Transfer:</strong> <a href="{{ asset('storage/' . $booking['payment_proof']) }}"
                                target="_blank">Lihat File</a></div>
                    </div>
                    <div class="col-md-6">
                        <div><strong>Status:</strong> <span
                                class="badge bg-warning text-dark">{{ $booking['status'] }}</span></div>
                    </div>
                </div>
                <hr>
                <!-- Footer & Signature -->
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var toastEl = document.getElementById('invoiceToast');
            var toast = new bootstrap.Toast(toastEl);
            toast.show();
        });
    </script>
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

        .invoice-watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            font-size: 120px;
            color: rgba(40, 167, 69, 0.07);
            transform: translate(-50%, -50%);
            pointer-events: none;
            z-index: 0;
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
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection
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
        <div class="card shadow-lg border-0 rounded-4 p-4 mx-auto" style="max-width:700px;">
            <div class="card-body">
                <h3 class="fw-bold mb-3 text-success">Booking Invoice</h3>
                <hr>
                <div class="mb-3">
                    <strong>Booking ID:</strong> {{ $booking['id'] }}
                </div>
                <h5 class="fw-bold mt-4">Traveler Information</h5>
                <ul class="list-unstyled mb-3">
                    <li><strong>Name:</strong> {{ $booking['traveler']['full_name'] }}</li>
                    <li><strong>Phone:</strong> {{ $booking['traveler']['phone'] }}</li>
                    <li><strong>Email:</strong> {{ $booking['traveler']['email'] }}</li>
                    <li><strong>Gender:</strong> {{ ucfirst($booking['traveler']['gender']) }}</li>
                    <li><strong>Date of Birth:</strong> {{ $booking['traveler']['dob'] }}</li>
                    <li><strong>Address:</strong> {{ $booking['traveler']['address'] }}</li>
                    <li><strong>Emergency Contact:</strong> {{ $booking['traveler']['emergency_name'] }}
                        ({{ $booking['traveler']['emergency_phone'] }})</li>
                </ul>
                <h5 class="fw-bold mt-4">Trip Information</h5>
                <ul class="list-unstyled mb-3">
                    <li><strong>Trip Title:</strong> {{ $booking['trip']['title'] }}</li>
                    <li><strong>Trip Date:</strong> {{ $booking['trip']['date'] }}</li>
                    <li><strong>Price per Person:</strong> Rp{{ number_format($booking['trip']['price'], 0, ',', '.') }}
                    </li>
                    <li><strong>Participants:</strong> {{ $booking['trip']['participants'] }}</li>
                    <li><strong>Total Price:</strong> {{ $booking['trip']['total_price'] }}</li>
                </ul>
                <h5 class="fw-bold mt-4">Payment</h5>
                <ul class="list-unstyled mb-3">
                    <li><strong>Method:</strong> {{ ucfirst(str_replace('_', ' ', $booking['payment_method'])) }}</li>
                    <li><strong>Proof Uploaded:</strong> <a href="{{ asset('storage/' . $booking['payment_proof']) }}"
                            target="_blank">View File</a></li>
                    <li><strong>Status:</strong> <span class="badge bg-warning text-dark">{{ $booking['status'] }}</span>
                    </li>
                </ul>
                <hr>
                <div class="alert alert-info mt-4">
                    Thank you for your booking! Your payment will be verified by our admin. You will be notified via
                    WhatsApp once your booking is confirmed.
                </div>
                <div class="text-center mt-4">
                    <button class="btn btn-outline-primary" onclick="window.print()">
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
@endsection
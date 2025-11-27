<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    // Tampilkan halaman checkout
    public function show($tripId)
    {
        // Simulasi data trip, ganti dengan query database jika ada
        $trip = [
            'id' => $tripId,
            'title' => 'Open Trip Bromo',
            'schedule' => '2025-12-10',
            'price' => 350000,
        ];
        return view('checkout', compact('trip'));
    }

    // Proses submit checkout
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email',
            'gender' => 'required|in:male,female',
            'dob' => 'required|date',
            'address' => 'required|string',
            'emergency_name' => 'required|string|max:255',
            'emergency_phone' => 'required|string|max:20',
            'trip_title' => 'required|string',
            'trip_date' => 'required|string',
            'price' => 'required',
            'participants' => 'required|integer|min:1',
            'total_price' => 'required',
            'payment_method' => 'required|in:bank_transfer,qris,e_wallet,cash',
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        // Simpan bukti pembayaran
        $proofPath = $request->file('payment_proof')->store('payment_proofs');

        // Simulasi penyimpanan booking (bisa diganti dengan model/database)
        $bookingId = strtoupper(Str::random(8));
        $booking = [
            'id' => $bookingId,
            'traveler' => [
                'full_name' => $validated['full_name'],
                'phone' => $validated['phone'],
                'email' => $validated['email'],
                'gender' => $validated['gender'],
                'dob' => $validated['dob'],
                'address' => $validated['address'],
                'emergency_name' => $validated['emergency_name'],
                'emergency_phone' => $validated['emergency_phone'],
            ],
            'trip' => [
                'title' => $validated['trip_title'],
                'date' => $validated['trip_date'],
                'price' => $validated['price'],
                'participants' => $validated['participants'],
                'total_price' => $validated['total_price'],
            ],
            'payment_method' => $validated['payment_method'],
            'payment_proof' => $proofPath,
            'status' => 'Pending Verification',
        ];
        // Simpan ke session (simulasi, ganti dengan database jika perlu)
        session(['booking_' . $bookingId => $booking]);

        return redirect()->route('checkout.invoice', $bookingId);
    }

    // Tampilkan halaman invoice
    public function invoice($bookingId)
    {
        $booking = session('booking_' . $bookingId);
        if (!$booking) {
            // Dummy data jika booking tidak ditemukan di session
            $booking = [
                'id' => $bookingId,
                'traveler' => [
                    'full_name' => 'Dummy User',
                    'phone' => '08123456789',
                    'email' => 'dummy@email.com',
                    'gender' => 'male',
                    'dob' => '2000-01-01',
                    'address' => 'Jl. Dummy No. 1',
                    'emergency_name' => 'Emergency Dummy',
                    'emergency_phone' => '08987654321',
                ],
                'trip' => [
                    'title' => 'Dummy Trip',
                    'date' => '2025-12-10',
                    'price' => 350000,
                    'participants' => 1,
                    'total_price' => 'Rp350.000',
                ],
                'payment_method' => 'bank_transfer',
                'payment_proof' => '',
                'status' => 'Pending Verification',
            ];
        }
        return view('invoice', compact('booking'));
    }
}

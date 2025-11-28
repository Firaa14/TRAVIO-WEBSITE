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

    // Tampilkan halaman checkout destinasi (2 step)
    public function checkoutDestinasi(Request $request)
    {
        // Step 1: Pilihan tambah mobil, hotel, destinasi lain (opsional)
        // Step 2: Form data diri (gunakan view checkout_destinasi.blade.php)
        // Data dummy, bisa diganti dengan query database
        $hotels = [
            ['id' => 1, 'name' => 'Hotel Mawar'],
            ['id' => 2, 'name' => 'Hotel Melati'],
        ];
        $cars = [
            ['id' => 1, 'name' => 'Avanza'],
            ['id' => 2, 'name' => 'Innova'],
        ];
        $destinations = [
            ['id' => 1, 'name' => 'Bromo'],
            ['id' => 2, 'name' => 'Semeru'],
        ];
        return view('checkout_destinasi', compact('hotels', 'cars', 'destinations'));
    }

    // Tampilkan halaman checkout hotel (GET)
    public function checkoutHotel(Request $request)
    {
        // Ambil parameter hotel_id dan room_type dari request
        $hotelId = $request->query('hotel_id');
        $roomType = $request->query('room_type');

        // Data dummy hotel dan tipe kamar, bisa diganti query database
        $hotels = [
            ['id' => 1, 'name' => 'Hotel Mawar'],
            ['id' => 2, 'name' => 'Hotel Melati'],
        ];
        $roomTypes = ['Standard', 'Deluxe', 'Suite'];

        // Data hotel yang dipilih
        $selectedHotel = collect($hotels)->firstWhere('id', (int) $hotelId);

        return view('checkout_hotel', [
            'hotels' => $hotels,
            'roomTypes' => $roomTypes,
            'selectedHotel' => $selectedHotel,
            'selectedRoomType' => $roomType,
        ]);
    }

    // Proses submit checkout hotel (POST)
    public function submitHotel(Request $request)
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
            'hotel_name' => 'required|string',
            'room_type' => 'required|string',
            'check_in' => 'required|string',
            'check_out' => 'required|string',
            'price_per_night' => 'required',
            'nights' => 'required|integer|min:1',
            'total_price' => 'required',
            'payment_method' => 'required|in:bank_transfer,qris,e_wallet,cash',
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        // Simpan bukti pembayaran
        $proofPath = $request->file('payment_proof')->store('payment_proofs');

        // Simulasi penyimpanan booking hotel
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
            'hotel' => [
                'name' => $validated['hotel_name'],
                'room_type' => $validated['room_type'],
                'check_in' => $validated['check_in'],
                'check_out' => $validated['check_out'],
                'price_per_night' => $validated['price_per_night'],
                'nights' => $validated['nights'],
                'total_price' => $validated['total_price'],
            ],
            'payment_method' => $validated['payment_method'],
            'payment_proof' => $proofPath,
            'status' => 'Pending Verification',
        ];
        session(['booking_hotel_' . $bookingId => $booking]);

        return redirect()->route('checkout.hotel.invoice', $bookingId);
    }

    // Tampilkan halaman invoice hotel
    public function invoiceHotel($bookingId)
    {
        $booking = session('booking_hotel_' . $bookingId);
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
                'hotel' => [
                    'name' => 'Dummy Hotel',
                    'room_type' => 'Deluxe',
                    'check_in' => '2025-12-10',
                    'check_out' => '2025-12-12',
                    'price_per_night' => 500000,
                    'nights' => 2,
                    'total_price' => 'Rp1.000.000',
                ],
                'payment_method' => 'bank_transfer',
                'payment_proof' => '',
                'status' => 'Pending Verification',
            ];
        }
        return view('invoice_hotel', compact('booking'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Destination;
use App\Models\DestinationBooking;
use App\Models\PlanningBooking;

class CheckoutController extends Controller
{
    use UserDataTrait;
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
        // Ambil data destinasi dari parameter atau session
        $destinationId = $request->query('destination_id');

        // Ambil data destinasi dari database
        $destination = null;
        if ($destinationId) {
            $destination = \App\Models\Destination::with('destinasi')->find($destinationId);
            if ($destination) {
                $destinationData = [
                    'id' => $destination->id,
                    'name' => $destination->destinasi->name ?? '',
                    'image' => $destination->destinasi->image ?? '',
                    'location' => $destination->location,
                    'detail' => $destination->detail,
                    'itinerary' => json_decode($destination->itinerary, true),
                    'price' => json_decode($destination->price_details, true),
                    'price_amount' => $destination->destinasi->price ?? 0,
                ];
                $destination = (object) $destinationData;
            }
        }

        // Data tambahan untuk opsi (dummy data)
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

        return view('checkout_destinasi', compact('hotels', 'cars', 'destinations', 'destination'));
    }

    // Proses submit checkout destinasi
    public function submitDestinasi(Request $request)
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
            'price' => 'required|numeric',
            'participants' => 'required|integer|min:1',
            'total_price' => 'required|string',
            'payment_method' => 'required|in:bank_transfer,qris,e_wallet,cash',
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        // Simpan bukti pembayaran
        $proofPath = $request->file('payment_proof')->store('payment_proofs', 'public');

        // Clean total price (remove Rp and formatting)
        $totalPrice = preg_replace('/[^0-9]/', '', $validated['total_price']);

        // Cari destination ID dari session atau request
        $destinationId = $request->input('destination_id') ?? session('destination_id');

        // Simpan booking ke database
        $booking = \App\Models\DestinationBooking::create([
            'destination_id' => $destinationId,
            'user_id' => auth()->id(),
            'full_name' => $validated['full_name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'gender' => $validated['gender'],
            'dob' => $validated['dob'],
            'address' => $validated['address'],
            'emergency_name' => $validated['emergency_name'],
            'emergency_phone' => $validated['emergency_phone'],
            'trip_title' => $validated['trip_title'],
            'trip_date' => $validated['trip_date'],
            'price_per_person' => $validated['price'],
            'participants' => $validated['participants'],
            'total_price' => $totalPrice,
            'payment_method' => $validated['payment_method'],
            'payment_proof' => $proofPath,
            'status' => 'pending'
        ]);

        return redirect()->route('checkout.destinasi.invoice', $booking->booking_id);
    }

    // Tampilkan halaman invoice destinasi
    public function invoiceDestinasi($bookingId)
    {
        // Ambil dari database berdasarkan booking_id
        $booking = \App\Models\DestinationBooking::with(['destination', 'destination.destinasi'])
            ->where('booking_id', $bookingId)
            ->first();

        if (!$booking) {
            // Jika tidak ditemukan, redirect dengan error
            return redirect()->route('dashboard')->with('error', 'Booking tidak ditemukan');
        }

        // Format data untuk view
        $bookingData = [
            'id' => $booking->booking_id,
            'traveler' => [
                'full_name' => $booking->full_name,
                'phone' => $booking->phone,
                'email' => $booking->email,
                'gender' => $booking->gender,
                'dob' => $booking->dob->format('Y-m-d'),
                'address' => $booking->address,
                'emergency_name' => $booking->emergency_name,
                'emergency_phone' => $booking->emergency_phone,
            ],
            'destination' => [
                'title' => $booking->trip_title,
                'date' => $booking->trip_date,
                'price' => $booking->price_per_person,
                'participants' => $booking->participants,
                'total_price' => 'Rp ' . number_format($booking->total_price, 0, ',', '.'),
            ],
            'payment_method' => $booking->payment_method,
            'payment_proof' => $booking->payment_proof,
            'status' => ucfirst($booking->status),
        ];

        return view('invoice_destinasi', ['booking' => $bookingData]);
    }    // Tampilkan halaman checkout hotel (GET)
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

    // Tampilkan halaman checkout hotel (folder cars)
    public function carsCheckoutHotel(Request $request)
    {
        // Dummy data hotel, bisa diganti query database
        $hotel = [
            'name' => 'Hotel Mawar',
            'room_type' => 'Deluxe',
            'check_in' => date('Y-m-d'),
            'check_out' => date('Y-m-d', strtotime('+2 days')),
            'price_per_night' => 500000,
            'nights' => 2,
            'total_price' => 1000000,
        ];
        return view('cars.checkout_hotel', compact('hotel'));
    }

    // Proses submit checkout hotel (folder cars)
    public function carsSubmitHotel(Request $request)
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
        session(['cars_booking_hotel_' . $bookingId => $booking]);

        return redirect()->route('cars.hotel.invoice', $bookingId);
    }

    // Tampilkan invoice hotel (folder cars)
    public function carsInvoiceHotel($bookingId)
    {
        $booking = session('cars_booking_hotel_' . $bookingId);
        if (!$booking) {
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
                    'total_price' => 1000000,
                ],
                'payment_method' => 'bank_transfer',
                'payment_proof' => '',
                'status' => 'Pending Verification',
            ];
        }
        return view('cars.invoice_hotel', compact('booking'));
    }

    // Tampilkan halaman checkout mobil (folder cars)
    public function carsCheckoutMobil(Request $request)
    {
        // Dummy data mobil
        $mobil = [
            'name' => 'Toyota Avanza',
        ];
        return view('cars.checkout_mobil', compact('mobil'));
    }

    // Proses submit checkout mobil (folder cars)
    public function carsSubmitMobil(Request $request)
    {
        $validated = $request->validate([
            'nama_penyewa' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email',
            'address' => 'required|string',
            'mobil_name' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'durasi' => 'required|in:half,full',
            'jumlah_penumpang' => 'required|integer|min:1',
            'driver' => 'required|in:dengan,tanpa',
            'payment_method' => 'required|in:bank_transfer,qris,e_wallet,cash',
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);
        $proofPath = $request->file('payment_proof')->store('payment_proofs');
        $bookingId = strtoupper(Str::random(8));
        $booking = [
            'id' => $bookingId,
            'nama_penyewa' => $validated['nama_penyewa'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'mobil_name' => $validated['mobil_name'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'durasi' => $validated['durasi'],
            'jumlah_penumpang' => $validated['jumlah_penumpang'],
            'driver' => $validated['driver'],
            'payment_method' => $validated['payment_method'],
            'payment_proof' => $proofPath,
            'total_price' => 500000, // Dummy harga
            'status' => 'Pending Verification',
        ];
        session(['cars_booking_mobil_' . $bookingId => $booking]);
        return redirect()->route('cars.mobil.invoice', $bookingId);
    }

    // Tampilkan invoice mobil (folder cars)
    public function carsInvoiceMobil($bookingId)
    {
        $booking = session('cars_booking_mobil_' . $bookingId);
        if (!$booking) {
            $booking = [
                'id' => $bookingId,
                'nama_penyewa' => 'Dummy User',
                'phone' => '08123456789',
                'email' => 'dummy@email.com',
                'address' => 'Jl. Dummy No. 1',
                'mobil_name' => 'Toyota Avanza',
                'start_date' => '2025-12-10',
                'end_date' => '2025-12-12',
                'durasi' => 'full',
                'jumlah_penumpang' => 4,
                'driver' => 'dengan',
                'payment_method' => 'bank_transfer',
                'payment_proof' => '',
                'total_price' => 500000,
                'status' => 'Pending Verification',
            ];
        }
        return view('cars.invoice_mobil', compact('booking'));
    }

    // === DESTINATION BOOKING METHODS (Following Hotel Booking Pattern) ===

    // Tampilkan halaman booking destination (seperti hotel booking)
    public function createDestinationBooking($destinationId)
    {
        $destination = Destination::with('destinasi')->findOrFail($destinationId);

        // Format data destination
        $destinationData = [
            'id' => $destination->id,
            'name' => $destination->destinasi->name ?? '',
            'image' => $destination->destinasi->image ?? '',
            'location' => $destination->location,
            'detail' => $destination->detail,
            'itinerary' => json_decode($destination->itinerary, true),
            'price_details' => json_decode($destination->price_details, true),
            'price' => $destination->destinasi->price ?? 0,
        ];

        return view('destination_booking.create', [
            'destination' => (object) $destinationData
        ]);
    }

    // Proses store booking destination
    public function storeDestinationBooking(Request $request)
    {
        $validated = $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email',
            'gender' => 'required|in:male,female',
            'dob' => 'required|date',
            'address' => 'required|string',
            'emergency_name' => 'required|string|max:255',
            'emergency_phone' => 'required|string|max:20',
            'trip_date' => 'required|date',
            'participants' => 'required|integer|min:1|max:10',
            'payment_method' => 'required|in:bank_transfer,qris,e_wallet,cash',
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        // Ambil data destination
        $destination = Destination::with('destinasi')->findOrFail($validated['destination_id']);
        $pricePerPerson = $destination->destinasi->price ?? 0;
        $totalPrice = $pricePerPerson * $validated['participants'];

        // Simpan bukti pembayaran
        $proofPath = $request->file('payment_proof')->store('payment_proofs', 'public');

        // Buat booking
        $booking = DestinationBooking::create([
            'destination_id' => $destination->id,
            'user_id' => auth()->id(),
            'full_name' => $validated['full_name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'gender' => $validated['gender'],
            'dob' => $validated['dob'],
            'address' => $validated['address'],
            'emergency_name' => $validated['emergency_name'],
            'emergency_phone' => $validated['emergency_phone'],
            'trip_title' => $destination->destinasi->name ?? 'Destination Trip',
            'trip_date' => $validated['trip_date'],
            'price_per_person' => $pricePerPerson,
            'participants' => $validated['participants'],
            'total_price' => $totalPrice,
            'payment_method' => $validated['payment_method'],
            'payment_proof' => $proofPath,
            'status' => 'pending'
        ]);

        return redirect()->route('destination.booking.success', $booking->booking_id);
    }

    // Tampilkan halaman success booking destination
    public function destinationBookingSuccess($bookingId)
    {
        $booking = DestinationBooking::with(['destination', 'destination.destinasi'])
            ->where('booking_id', $bookingId)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('destination_booking.success', compact('booking'));
    }

    // Planning checkout
    public function planningCheckout()
    {
        $planningData = session('planningData');

        if (!$planningData) {
            return redirect()->route('planning')->with('error', 'No planning data found.');
        }

        // Format data for checkout view
        $checkoutData = [
            'type' => 'planning',
            'title' => 'Custom Travel Planning Package',
            'items' => $planningData['selectedItems'],
            'total_price' => $planningData['total'],
            'trip_date' => $planningData['leaving_date'],
            'return_date' => $planningData['return_date'],
            'days' => $planningData['days'],
            'guests' => $planningData['guests'],
        ];

        $userData = $this->getUserData();

        return view('checkout.planning', compact('checkoutData', 'userData'));
    }

    // Process planning checkout
    public function submitPlanningCheckout(Request $request)
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
            'guests' => 'required|integer|min:1',
            'payment_method' => 'required|in:bank_transfer,qris,e_wallet,cash',
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $planningData = session('planningData');
        if (!$planningData) {
            return back()->with('error', 'Planning data not found.');
        }

        // Save payment proof
        $proofPath = $request->file('payment_proof')->store('payment_proofs', 'public');

        // Create planning booking
        $booking = PlanningBooking::create([
            'user_id' => Auth::id(),
            'item_data' => array_merge($planningData, $validated),
            'total_price' => $planningData['total'],
            'start_date' => $planningData['leaving_date'],
            'end_date' => $planningData['return_date'],
            'guests' => $validated['guests'],
            'payment_proof' => $proofPath,
            'status' => 'pending'
        ]);

        // Clear planning data from session
        session()->forget('planningData');

        return redirect()->route('planning.booking.success', $booking->id);
    }

    // Planning booking success page
    public function planningBookingSuccess($id)
    {
        $booking = PlanningBooking::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('checkout.planning_success', compact('booking'));
    }
}

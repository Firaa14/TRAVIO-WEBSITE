<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\OpenTripBooking;

class TripController extends Controller
{
    // Show trip detail page (view more)
    public function show($id)
    {
        // Dummy trip data; nanti bisa diganti database
        $trips = $this->getTripData();
        $trip = collect($trips)->firstWhere('id', $id);

        if (!$trip) {
            abort(404);
        }

        return view('opentrip.show', compact('trip'));
    }

    // Show checkout page
    public function checkout($id)
    {
        $trips = $this->getTripData();
        $trip = collect($trips)->firstWhere('id', $id);

        if (!$trip) {
            abort(404);
        }

        return view('opentrip.checkout', compact('trip'));
    }

    // Handle checkout form submission
    public function checkoutSubmit(Request $request, $id)
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
            'participants' => 'required|integer|min:1',
            'payment_method' => 'required|in:bank_transfer,qris,e_wallet,cash',
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'notes' => 'nullable|string',
        ]);

        $trips = $this->getTripData();
        $trip = collect($trips)->firstWhere('id', $id);

        if (!$trip) {
            return back()->with('error', 'Trip not found.');
        }

        // Save payment proof
        $proofPath = $request->file('payment_proof')->store('payment_proofs', 'public');

        // Calculate total price
        $totalPrice = $trip['harga'] * $validated['participants'];

        // Create booking
        $booking = OpenTripBooking::create([
            'user_id' => Auth::id(),
            'trip_title' => $trip['judul'],
            'trip_location' => $trip['lokasi'],
            'trip_schedule' => $trip['tanggal'],
            'trip_price' => $trip['harga'],
            'full_name' => $validated['full_name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'gender' => $validated['gender'],
            'dob' => $validated['dob'],
            'address' => $validated['address'],
            'emergency_name' => $validated['emergency_name'],
            'emergency_phone' => $validated['emergency_phone'],
            'participants' => $validated['participants'],
            'total_price' => $totalPrice,
            'payment_method' => $validated['payment_method'],
            'payment_proof' => $proofPath,
            'status' => 'pending',
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->route('opentrip.success', $booking->id);
    }

    // Show success page
    public function success($bookingId)
    {
        $booking = OpenTripBooking::where('id', $bookingId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('opentrip.success', compact('booking'));
    }

    // Get trip data (will be replaced with database query later)
    private function getTripData()
    {
        return [
            [
                'id' => 1,
                'judul' => 'Open Trip Bromo Sunrise',
                'lokasi' => 'Gunung Bromo, Malang',
                'tanggal' => 'Setiap Sabtu & Minggu',
                'harga' => 350000,
                'gambar' => 'photos/destination5.jpg',
                'deskripsi' => 'Nikmati keindahan matahari terbit di Bromo bersama rombongan traveler lainnya!',
                'included' => [
                    'Transportation (Jeep)',
                    'Entrance Tickets',
                    'Local Tour Guide',
                    'Photo Spots',
                    'Mineral Water',
                ],
                'prepare' => [
                    'Warm Jacket',
                    'Comfortable Shoes',
                    'Camera or Phone',
                    'Personal Medication',
                    'Extra Cash',
                ],
            ],
            [
                'id' => 2,
                'judul' => 'Open Trip Pulau Sempu',
                'lokasi' => 'Sendang Biru, Malang Selatan',
                'tanggal' => 'Setiap Jumat - Minggu',
                'harga' => 450000,
                'gambar' => 'photos/destination12.jpg',
                'deskripsi' => 'Jelajahi pulau tersembunyi dengan pasir putih dan danau biru yang menakjubkan.',
                'included' => [
                    'Boat Transportation',
                    'Entrance Tickets',
                    'Local Tour Guide',
                    'Snorkeling Equipment',
                    'Lunch Box',
                ],
                'prepare' => [
                    'Swimwear',
                    'Sunscreen',
                    'Waterproof Bag',
                    'Change of Clothes',
                    'Camera',
                ],
            ],
            [
                'id' => 3,
                'judul' => 'Open Trip Coban Rondo',
                'lokasi' => 'Batu, Malang',
                'tanggal' => 'Setiap Akhir Pekan',
                'harga' => 250000,
                'gambar' => 'photos/destination2.jpg',
                'deskripsi' => 'Nikmati keindahan air terjun legendaris Coban Rondo dalam suasana alam yang sejuk.',
                'included' => [
                    'Transportation',
                    'Entrance Tickets',
                    'Local Tour Guide',
                    'Mineral Water',
                    'Photo Documentation',
                ],
                'prepare' => [
                    'Comfortable Shoes',
                    'Light Jacket',
                    'Camera',
                    'Personal Medication',
                    'Raincoat',
                ],
            ],
        ];
    }

    // Legacy methods (kept for backward compatibility)
    public function register($id)
    {
        return redirect()->route('opentrip.checkout', $id);
    }

    public function registerSubmit(Request $request, $id)
    {
        return $this->checkoutSubmit($request, $id);
    }
}

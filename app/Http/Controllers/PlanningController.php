<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Destination;
use App\Models\Hotel;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlanningController extends Controller
{
    /**
     * Show planning form
     */
    public function index()
    {
        $destinations = Destination::all()->toArray();
        $hotels = Hotel::all()->toArray();
        $cars = Car::all()->toArray();

        // Ambil daftar kamar untuk setiap hotel
        $hotelRooms = [];
        foreach ($hotels as $hotel) {
            $hotelRooms[$hotel['id']] = \App\Models\HotelRoom::where('hotel_id', $hotel['id'])->get()->toArray();
        }

        return view('planning.index', compact('destinations', 'hotels', 'cars', 'hotelRooms'));
    }

    /**
     * Calculate and prepare checkout
     */
    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'leaving_date' => 'required|date|after_or_equal:today',
            'return_date' => 'required|date|after: leaving_date',
            'selected_destinations' => 'required|string',
            'selected_hotel_room' => 'required|json',
            'selected_cars' => 'nullable|string',
            'adults' => 'required|integer|min:1',
            'children' => 'nullable|integer|min:0',
            'special_needs' => 'nullable|integer|min:0'
        ]);

        // Parse data
        $leavingDate = new \DateTime($validated['leaving_date']);
        $returnDate = new \DateTime($validated['return_date']);
        $days = $returnDate->diff($leavingDate)->days;

        $destinationIds = array_filter(explode(',', $validated['selected_destinations']));
        $hotelRoom = null;
        $hotelRoomData = json_decode($validated['selected_hotel_room'], true);
        if (isset($hotelRoomData['room_id'])) {
            $room = \App\Models\HotelRoom::find($hotelRoomData['room_id']);
            if ($room) {
                $hotel = \App\Models\Hotel::find($room->hotel_id);
                $hotelRoom = [
                    'id' => $room->id,
                    'hotel_id' => $room->hotel_id,
                    'hotel_name' => $hotel ? $hotel->name : '',
                    'name' => $room->name,
                    'description' => $room->description,
                    'facilities' => $room->facilities,
                    'price' => $room->price,
                    'max_guest' => $room->max_guest,
                    'bed_type' => $room->bed_type,
                    'room_size' => $room->room_size,
                    'image' => $room->image,
                    'status' => $room->status,
                ];
            }
        }
        $carIds = array_filter(explode(',', $validated['selected_cars'] ?? ''));

        // Get destination details
        $destinations = Destination::whereIn('id', $destinationIds)->get()->toArray();

        // Get hotel details
        $hotelData = $hotelRoom;

        // Get car details
        $cars = Car::whereIn('id', $carIds)->get()->toArray();

        // Calculate totals
        $destinationTotal = collect($destinations)->sum('price');
        $hotelTotal = ($hotelRoom['price'] ?? 0) * $days;
        $carTotal = collect($cars)->sum(fn($car) => $car['price'] * $days);

        $totalPrice = $destinationTotal + $hotelTotal + $carTotal;

        // Prepare checkout data
        $checkoutData = [
            'leaving_date' => $validated['leaving_date'],
            'return_date' => $validated['return_date'],
            'days' => $days,
            'guests' => $validated['adults'] + ($validated['children'] ?? 0) + ($validated['special_needs'] ?? 0),
            'adults' => $validated['adults'],
            'children' => $validated['children'] ?? 0,
            'special_needs' => $validated['special_needs'] ?? 0,
            'destinations' => $destinations,
            'hotel' => $hotelData,
            'cars' => $cars,
            'pricing' => [
                'destination_total' => $destinationTotal,
                'hotel_total' => $hotelTotal,
                'car_total' => $carTotal,
                'grand_total' => $totalPrice
            ]
        ];

        // session(['planningData' => $checkoutData]);
        session(['planningData' => $checkoutData]);

        // return redirect()->route('checkout.show');
        return redirect()->route('checkout.planning');
    }

    /**
     * Show checkout form
     */
    public function showCheckout()
    {
        $checkoutData = session('planningData');

        if (!$checkoutData) {
            return redirect()->route('planning')->with('error', 'Session expired.  Please plan your trip again.');
        }

        $userData = [
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'phone' => auth()->user()->phone ?? ''
        ];

        return view('checkout.planning', compact('checkoutData', 'userData'));
    }

    /**
     * Submit checkout and save booking
     */
    public function submitCheckout(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:100',
            'gender' => 'required|in:male,female',
            'dob' => 'required|date|before:today',
            'address' => 'required|string|max:500',
            'guests' => 'required|integer|min:1',
            'emergency_name' => 'required|string|max:100',
            'emergency_phone' => 'required|string|max:20',
            'payment_method' => 'required|in:bank_transfer,qris,e_wallet',
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120'
        ]);

        $checkoutData = session('planningData');

        if (!$checkoutData) {
            return redirect()->route('planning')->with('error', 'Session expired. Please plan your trip again.');
        }

        // Upload payment proof
        $proofPath = null;
        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $filename = 'payment_' . time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $proofPath = $file->storeAs('payment_proofs', $filename, 'public');
        }

        // Create booking
        $booking = Booking::create([
            'user_id' => auth()->id(),
            'booking_code' => 'BK' . strtoupper(Str::random(8)) . time(),
            'full_name' => $validated['full_name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'gender' => $validated['gender'],
            'dob' => $validated['dob'],
            'address' => $validated['address'],
            'guests' => $validated['guests'],
            'emergency_name' => $validated['emergency_name'],
            'emergency_phone' => $validated['emergency_phone'],
            'payment_method' => $validated['payment_method'],
            'payment_proof' => $proofPath,
            'start_date' => $checkoutData['leaving_date'],
            'end_date' => $checkoutData['return_date'],
            'total_price' => $checkoutData['pricing']['grand_total'],
            'item_data' => json_encode([
                'destinations' => $checkoutData['destinations'],
                'hotel' => $checkoutData['hotel'],
                'cars' => $checkoutData['cars'],
                'days' => $checkoutData['days'],
                'guests' => $checkoutData['guests']
            ]),
            'status' => 'pending',
            'payment_status' => 'pending'
        ]);

        // Clear session
        session()->forget('planningData');

        return redirect()->route('booking.success', $booking->id)->with('success', 'Booking submitted successfully!');
    }

    /**
     * Show booking success page
     */
    public function bookingSuccess(Booking $booking)
    {
        // Ensure user can only view their own booking
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $booking->item_data = json_decode($booking->item_data, true);
        $booking->formatted_price = 'Rp' . number_format($booking->total_price, 0, ',', '.');

        return view('checkout.success', compact('booking'));
    }

    /**
     * Generate invoice PDF or view
     */
    public function generateInvoice(Booking $booking)
    {
        // Ensure user can only view their own invoice
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $booking->item_data = json_decode($booking->item_data, true);
        $booking->formatted_price = 'Rp' . number_format($booking->total_price, 0, ',', '.');

        $startDate = \DateTime::createFromFormat('Y-m-d', $booking->start_date);
        $endDate = \DateTime::createFromFormat('Y-m-d', $booking->end_date);
        $booking->formatted_start = $startDate->format('d M Y');
        $booking->formatted_end = $endDate->format('d M Y');

        return view('checkout.invoice', compact('booking'));
    }

    /**
     * Get hotel rooms by hotel ID
     */
    public function getHotelRooms($hotelId)
    {
        $rooms = \App\Models\HotelRoom::where('hotel_id', $hotelId)
            ->select('id', 'name', 'description', 'facilities', 'price', 'max_guest', 'bed_type', 'room_size', 'image', 'status')
            ->get();
        return response()->json($rooms);
    }
}
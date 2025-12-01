<?php

namespace App\Http\Controllers;

use App\Models\HotelBooking;
use App\Models\HotelDetail;
use App\Models\HotelRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HotelBookingController extends Controller
{
    /**
     * Display the checkout form for a specific hotel and room.
     */
    public function create($hotelId, $roomId)
    {
        $hotelDetail = HotelDetail::with('hotel')->findOrFail($hotelId);
        $hotelRoom = HotelRoom::findOrFail($roomId);

        // Verify that the room belongs to the hotel
        if ($hotelRoom->hotel_id !== $hotelDetail->hotel_id) {
            abort(404, 'Room not found for this hotel');
        }

        return view('hotel.checkout', compact('hotelDetail', 'hotelRoom'));
    }

    /**
     * Store a newly created booking in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'hotel_id' => 'required|exists:hotel_details,id',
            'room_id' => 'required|exists:hotel_rooms,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1'
        ]);

        // Get hotel and room details
        $hotelDetail = HotelDetail::findOrFail($request->hotel_id);
        $hotelRoom = HotelRoom::findOrFail($request->room_id);

        // Verify that the room belongs to the hotel
        if ($hotelRoom->hotel_id !== $hotelDetail->hotel_id) {
            return back()->withErrors(['error' => 'Invalid room selection for this hotel.']);
        }

        // Check if room capacity is sufficient
        if ($request->guests > $hotelRoom->capacity) {
            return back()->withErrors([
                'guests' => "Maximum guests for this room is {$hotelRoom->capacity}."
            ]);
        }

        // Check room availability
        $checkIn = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);

        $isAvailable = $this->checkRoomAvailability($request->room_id, $checkIn, $checkOut);

        if (!$isAvailable) {
            // Add some debugging info in development
            if (config('app.debug')) {
                \Log::info('Room availability conflict', [
                    'room_id' => $request->room_id,
                    'requested_check_in' => $checkIn->format('Y-m-d'),
                    'requested_check_out' => $checkOut->format('Y-m-d'),
                ]);
            }

            return back()->withErrors([
                'check_in' => 'Room is not available for the selected dates.'
            ]);
        }

        // Calculate total price
        $nights = $checkIn->diffInDays($checkOut);
        $totalPrice = $hotelRoom->price * $nights;

        // Create booking
        $booking = HotelBooking::create([
            'hotel_id' => $request->hotel_id,
            'room_id' => $request->room_id,
            'user_id' => Auth::id(),
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'guests' => $request->guests,
            'total_price' => $totalPrice,
            'status' => 'pending'
        ]);

        return redirect()->route('booking.success', $booking->id)
            ->with('success', 'Hotel booking created successfully!');
    }

    /**
     * Display the booking success page.
     */
    public function success($id)
    {
        $booking = HotelBooking::with(['hotelDetail', 'hotelRoom', 'user'])
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('hotel.booking-success', compact('booking'));
    }

    /**
     * Display the user's bookings.
     */
    public function index()
    {
        $bookings = HotelBooking::with(['hotelDetail', 'hotelRoom'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('hotel.my-bookings', compact('bookings'));
    }

    /**
     * Cancel a booking.
     */
    public function cancel($id)
    {
        $booking = HotelBooking::where('id', $id)
            ->where('user_id', Auth::id())
            ->where('status', '!=', 'cancelled')
            ->firstOrFail();

        $booking->update(['status' => 'cancelled']);

        return back()->with('success', 'Booking cancelled successfully.');
    }

    /**
     * Calculate price via AJAX.
     */
    public function calculatePrice(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:hotel_rooms,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in'
        ]);

        $room = HotelRoom::findOrFail($request->room_id);
        $checkIn = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);
        $nights = $checkIn->diffInDays($checkOut);
        $totalPrice = $room->price * $nights;

        // Also check availability for frontend
        $isAvailable = $this->checkRoomAvailability($request->room_id, $checkIn, $checkOut);

        return response()->json([
            'nights' => $nights,
            'price_per_night' => $room->price,
            'total_price' => $totalPrice,
            'formatted_total' => 'Rp ' . number_format($totalPrice, 0, ',', '.'),
            'available' => $isAvailable
        ]);
    }

    /**
     * Check if room is available for given dates
     */
    private function checkRoomAvailability($roomId, $checkIn, $checkOut)
    {
        return !HotelBooking::where('room_id', $roomId)
            ->where('status', '!=', 'cancelled')
            ->where(function ($query) use ($checkIn, $checkOut) {
                $query->where(function ($q) use ($checkIn, $checkOut) {
                    $q->where('check_in', '<', $checkOut)
                        ->where('check_out', '>', $checkIn);
                });
            })
            ->exists();
    }

    /**
     * Clear test bookings (only in development)
     */
    public function clearTestBookings()
    {
        if (!config('app.debug')) {
            abort(404);
        }

        $deleted = HotelBooking::where('status', 'pending')->delete();

        return response()->json([
            'message' => "Deleted {$deleted} test bookings",
            'deleted_count' => $deleted
        ]);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CarBookingController extends Controller
{
    /**
     * Display the checkout form for a specific car.
     */
    public function create($carId)
    {
        $car = Car::findOrFail($carId);

        return view('cars.checkout', compact('car'));
    }

    /**
     * Store a newly created car booking in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:car,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'passengers' => 'required|integer|min:1|max:8',
            'duration_type' => 'required|in:half,full',
            'with_driver' => 'required|boolean',
            'renter_name' => 'required|string|max:255',
            'driver_name' => 'nullable|required_if:with_driver,0|string|max:255',
            'ktp' => 'nullable|required_if:with_driver,0|file|mimes:jpg,png,pdf|max:2048',
            'sim_a' => 'nullable|required_if:with_driver,0|file|mimes:jpg,png,pdf|max:2048',
        ]);

        $car = Car::findOrFail($request->car_id);

        // Calculate total days
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $days = $startDate->diffInDays($endDate);

        // Calculate price based on duration type
        $basePrice = $car->price;
        $totalPrice = $basePrice * $days;

        // Add driver fee if with driver
        if ($request->with_driver) {
            $totalPrice += 100000 * $days; // Driver fee per day
        }

        // Store files if provided
        $ktpPath = null;
        $simPath = null;

        if ($request->hasFile('ktp')) {
            $ktpPath = $request->file('ktp')->store('car-bookings/ktp', 'public');
        }

        if ($request->hasFile('sim_a')) {
            $simPath = $request->file('sim_a')->store('car-bookings/sim', 'public');
        }

        // Create booking record
        $booking = CarBooking::create([
            'user_id' => Auth::id(),
            'car_id' => $request->car_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'passengers' => $request->passengers,
            'duration_type' => $request->duration_type,
            'with_driver' => $request->with_driver,
            'renter_name' => $request->renter_name,
            'driver_name' => $request->driver_name,
            'ktp_path' => $ktpPath,
            'sim_path' => $simPath,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        return redirect()->route('car.booking.success', ['bookingId' => $booking->id]);
    }

    /**
     * Show booking success page with invoice.
     */
    public function success($bookingId)
    {
        $booking = CarBooking::with('car', 'user')->findOrFail($bookingId);

        // Check if booking belongs to current user
        if ($booking->user_id !== Auth::id()) {
            return redirect()->route('cars.index')->with('error', 'Booking not found');
        }

        return view('cars.booking_success', compact('booking'));
    }

    /**
     * Calculate price for car rental
     */
    public function calculatePrice(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:car,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'duration_type' => 'required|in:half,full',
            'with_driver' => 'required|boolean',
        ]);

        $car = Car::findOrFail($request->car_id);

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $days = $startDate->diffInDays($endDate);

        $basePrice = $car->price;
        $totalPrice = $basePrice * $days;

        if ($request->with_driver) {
            $totalPrice += 100000 * $days; // Driver fee
        }

        return response()->json([
            'days' => $days,
            'base_price' => $basePrice,
            'driver_fee' => $request->with_driver ? 100000 * $days : 0,
            'total_price' => $totalPrice,
        ]);
    }
}
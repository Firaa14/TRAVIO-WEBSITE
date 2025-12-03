<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\PackageBooking;
use Illuminate\Support\Facades\Auth;

class PackageBookingController extends Controller
{
    public function create($packageId)
    {
        $package = Package::findOrFail($packageId);
        return view('packages.checkout', compact('package'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:package,id',
            'travel_date' => 'required|date|after:today',
            'number_of_travelers' => 'required|integer|min:1|max:8',
            'total_price' => 'required|numeric|min:0',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'special_requests' => 'nullable|string|max:1000'
        ]);

        $booking = PackageBooking::create([
            'user_id' => Auth::id(),
            'package_id' => $request->package_id,
            'travel_date' => $request->travel_date,
            'number_of_travelers' => $request->number_of_travelers,
            'total_price' => $request->total_price,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'special_requests' => $request->special_requests,
            'status' => 'pending',
            'booking_code' => 'PKG-' . strtoupper(uniqid())
        ]);

        return redirect()->route('package.booking.success', $booking->id)
            ->with('success', 'Package booking submitted successfully!');
    }

    public function success($bookingId)
    {
        $booking = PackageBooking::with(['package', 'user'])
            ->where('id', $bookingId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('packages.booking_success', compact('booking'));
    }

    public function calculatePrice(Request $request)
    {
        $package = Package::findOrFail($request->package_id);
        $numberOfTravelers = $request->number_of_travelers;

        $totalPrice = $package->price * $numberOfTravelers;

        return response()->json([
            'base_price' => $package->price,
            'number_of_travelers' => $numberOfTravelers,
            'total_price' => $totalPrice
        ]);
    }
}
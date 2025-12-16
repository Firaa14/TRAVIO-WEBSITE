<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\OpenTripBooking;
use App\Models\OpenTrip;

class TripController extends Controller
{
    use UserDataTrait;

    // Show trip detail page (view more)
    public function show($id)
    {
        $trip = OpenTrip::findOrFail($id);
        return view('opentrip.show', compact('trip'));
    }

    // Show checkout page
    public function checkout($id)
    {
        $trip = OpenTrip::findOrFail($id);
        $userData = $this->getUserData();
        return view('opentrip.checkout', compact('trip', 'userData'));
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

        // Get trip from database
        $trip = OpenTrip::findOrFail($id);
        
        // Check if enough slots available
        if ($trip->getAvailableSlots() < $validated['participants']) {
            return back()->withErrors(['participants' => 'Not enough available slots for this number of participants.']);
        }

        // Save payment proof
        $proofPath = $request->file('payment_proof')->store('payment_proofs', 'public');

        // Calculate total price
        $totalPrice = $trip->price * $validated['participants'];

        // Create booking
        $booking = OpenTripBooking::create([
            'user_id' => Auth::id(),
            'open_trip_id' => $id,
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

        // Update trip participant count (tentatively for pending booking)
        $trip->increment('current_participants', $validated['participants']);
        
        // Check if trip is now full
        if ($trip->current_participants >= $trip->max_participants) {
            $trip->update(['status' => 'full']);
        }

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

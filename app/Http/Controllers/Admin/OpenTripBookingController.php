<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OpenTripBooking;
use App\Models\OpenTrip;
use Illuminate\Http\Request;

class OpenTripBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = OpenTripBooking::with(['openTrip', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
            
        return view('admin.opentrip-bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(OpenTripBooking $openTripBooking)
    {
        $openTripBooking->load(['openTrip', 'user']);
        return view('admin.opentrip-bookings.show', compact('openTripBooking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OpenTripBooking $openTripBooking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OpenTripBooking $openTripBooking)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled'
        ]);

        $oldStatus = $openTripBooking->status;
        
        if ($validated['status'] === 'confirmed' && $oldStatus !== 'confirmed') {
            $openTripBooking->confirm();
        } elseif ($validated['status'] === 'cancelled' && $oldStatus !== 'cancelled') {
            $openTripBooking->cancel();
        } else {
            $openTripBooking->update($validated);
        }

        return redirect()->route('admin.opentrip-bookings.index')
            ->with('success', 'Booking status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OpenTripBooking $openTripBooking)
    {
        // Cancel booking before deleting to update participant counts
        if ($openTripBooking->status !== 'cancelled') {
            $openTripBooking->cancel();
        }
        
        $openTripBooking->delete();
        
        return redirect()->route('admin.opentrip-bookings.index')
            ->with('success', 'Booking deleted successfully.');
    }
}

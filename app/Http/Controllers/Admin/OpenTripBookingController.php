<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OpenTripBooking;
use Illuminate\Http\Request;

class OpenTripBookingController extends Controller
{
    public function index()
    {
        $openTripBookings = OpenTripBooking::all();
        return view('admin.opentripbooking.index', compact('openTripBookings'));
    }
    public function create()
    {
        return view('admin.opentripbooking.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|integer',
            'open_trip_id' => 'required|integer',
            'booking_date' => 'required|date',
        ]);
        OpenTripBooking::create($data);
        return redirect()->route('admin.opentripbooking.index')->with('success', 'Booking Open Trip berhasil ditambah.');
    }
    public function edit(OpenTripBooking $openTripBooking)
    {
        return view('admin.opentripbooking.edit', compact('openTripBooking'));
    }
    public function update(Request $request, OpenTripBooking $openTripBooking)
    {
        $data = $request->validate([
            'user_id' => 'required|integer',
            'open_trip_id' => 'required|integer',
            'booking_date' => 'required|date',
        ]);
        $openTripBooking->update($data);
        return redirect()->route('admin.opentripbooking.index')->with('success', 'Booking Open Trip berhasil diupdate.');
    }
    public function destroy(OpenTripBooking $openTripBooking)
    {
        $openTripBooking->delete();
        return redirect()->route('admin.opentripbooking.index')->with('success', 'Booking Open Trip berhasil dihapus.');
    }
}

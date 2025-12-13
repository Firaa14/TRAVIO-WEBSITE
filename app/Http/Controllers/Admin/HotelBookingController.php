<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HotelBooking;
use Illuminate\Http\Request;

class HotelBookingController extends Controller
{
    public function index()
    {
        $hotelBookings = HotelBooking::all();
        return view('admin.hotelbooking.index', compact('hotelBookings'));
    }
    public function create()
    {
        return view('admin.hotelbooking.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|integer',
            'hotel_id' => 'required|integer',
            'check_in' => 'required|date',
            'check_out' => 'required|date',
        ]);
        HotelBooking::create($data);
        return redirect()->route('admin.hotelbooking.index')->with('success', 'Booking hotel berhasil ditambah.');
    }
    public function edit(HotelBooking $hotelBooking)
    {
        return view('admin.hotelbooking.edit', compact('hotelBooking'));
    }
    public function update(Request $request, HotelBooking $hotelBooking)
    {
        $data = $request->validate([
            'user_id' => 'required|integer',
            'hotel_id' => 'required|integer',
            'check_in' => 'required|date',
            'check_out' => 'required|date',
        ]);
        $hotelBooking->update($data);
        return redirect()->route('admin.hotelbooking.index')->with('success', 'Booking hotel berhasil diupdate.');
    }
    public function destroy(HotelBooking $hotelBooking)
    {
        $hotelBooking->delete();
        return redirect()->route('admin.hotelbooking.index')->with('success', 'Booking hotel berhasil dihapus.');
    }
}

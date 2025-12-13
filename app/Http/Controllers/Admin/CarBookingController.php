<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarBooking;
use Illuminate\Http\Request;

class CarBookingController extends Controller
{
    public function index()
    {
        $carBookings = CarBooking::all();
        return view('admin.carbooking.index', compact('carBookings'));
    }
    public function create()
    {
        return view('admin.carbooking.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|integer',
            'car_id' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);
        CarBooking::create($data);
        return redirect()->route('admin.carbooking.index')->with('success', 'Booking mobil berhasil ditambah.');
    }
    public function edit(CarBooking $carBooking)
    {
        return view('admin.carbooking.edit', compact('carBooking'));
    }
    public function update(Request $request, CarBooking $carBooking)
    {
        $data = $request->validate([
            'user_id' => 'required|integer',
            'car_id' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);
        $carBooking->update($data);
        return redirect()->route('admin.carbooking.index')->with('success', 'Booking mobil berhasil diupdate.');
    }
    public function destroy(CarBooking $carBooking)
    {
        $carBooking->delete();
        return redirect()->route('admin.carbooking.index')->with('success', 'Booking mobil berhasil dihapus.');
    }
}

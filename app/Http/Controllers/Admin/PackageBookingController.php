<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PackageBooking;
use Illuminate\Http\Request;

class PackageBookingController extends Controller
{
    public function index()
    {
        $packageBookings = PackageBooking::all();
        return view('admin.packagebooking.index', compact('packageBookings'));
    }
    public function create()
    {
        return view('admin.packagebooking.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|integer',
            'package_id' => 'required|integer',
            'booking_date' => 'required|date',
        ]);
        PackageBooking::create($data);
        return redirect()->route('admin.packagebooking.index')->with('success', 'Booking paket berhasil ditambah.');
    }
    public function edit(PackageBooking $packageBooking)
    {
        return view('admin.packagebooking.edit', compact('packageBooking'));
    }
    public function update(Request $request, PackageBooking $packageBooking)
    {
        $data = $request->validate([
            'user_id' => 'required|integer',
            'package_id' => 'required|integer',
            'booking_date' => 'required|date',
        ]);
        $packageBooking->update($data);
        return redirect()->route('admin.packagebooking.index')->with('success', 'Booking paket berhasil diupdate.');
    }
    public function destroy(PackageBooking $packageBooking)
    {
        $packageBooking->delete();
        return redirect()->route('admin.packagebooking.index')->with('success', 'Booking paket berhasil dihapus.');
    }
}

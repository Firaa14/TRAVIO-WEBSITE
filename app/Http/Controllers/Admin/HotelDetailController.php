<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HotelDetail;
use Illuminate\Http\Request;

class HotelDetailController extends Controller
{
    public function index()
    {
        $hotelDetails = HotelDetail::all();
        return view('admin.hoteldetail.index', compact('hotelDetails'));
    }
    public function create()
    {
        return view('admin.hoteldetail.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'hotel_id' => 'required|integer',
            'description' => 'required',
        ]);
        HotelDetail::create($data);
        return redirect()->route('admin.hoteldetail.index')->with('success', 'Detail hotel berhasil ditambah.');
    }
    public function edit(HotelDetail $hotelDetail)
    {
        return view('admin.hoteldetail.edit', compact('hotelDetail'));
    }
    public function update(Request $request, HotelDetail $hotelDetail)
    {
        $data = $request->validate([
            'hotel_id' => 'required|integer',
            'description' => 'required',
        ]);
        $hotelDetail->update($data);
        return redirect()->route('admin.hoteldetail.index')->with('success', 'Detail hotel berhasil diupdate.');
    }
    public function destroy(HotelDetail $hotelDetail)
    {
        $hotelDetail->delete();
        return redirect()->route('admin.hoteldetail.index')->with('success', 'Detail hotel berhasil dihapus.');
    }
}

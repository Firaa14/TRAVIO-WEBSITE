<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HotelRoom;
use Illuminate\Http\Request;

class HotelRoomController extends Controller
{
    public function index()
    {
        $hotelRooms = HotelRoom::all();
        return view('admin.hotelroom.index', compact('hotelRooms'));
    }
    public function create()
    {
        return view('admin.hotelroom.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'hotel_id' => 'required|integer',
            'room_type' => 'required',
            'price' => 'required|numeric',
        ]);
        HotelRoom::create($data);
        return redirect()->route('admin.hotelroom.index')->with('success', 'Kamar hotel berhasil ditambah.');
    }
    public function edit(HotelRoom $hotelRoom)
    {
        return view('admin.hotelroom.edit', compact('hotelRoom'));
    }
    public function update(Request $request, HotelRoom $hotelRoom)
    {
        $data = $request->validate([
            'hotel_id' => 'required|integer',
            'room_type' => 'required',
            'price' => 'required|numeric',
        ]);
        $hotelRoom->update($data);
        return redirect()->route('admin.hotelroom.index')->with('success', 'Kamar hotel berhasil diupdate.');
    }
    public function destroy(HotelRoom $hotelRoom)
    {
        $hotelRoom->delete();
        return redirect()->route('admin.hotelroom.index')->with('success', 'Kamar hotel berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HotelRoom;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HotelRoomController extends Controller
{
    public function index()
    {
        $hotelRooms = HotelRoom::with('hotel')->latest()->paginate(10);
        return view('admin.hotel-room.index', compact('hotelRooms'));
    }

    public function create()
    {
        $hotels = Hotel::all();
        return view('admin.hotel-room.create', compact('hotels'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'max_guest' => 'required|integer|min:1',
            'size' => 'nullable|string',
            'bed_type' => 'nullable|string',
            'facilities' => 'nullable|string',
            'availability' => 'required|in:available,unavailable',
            'room_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('room_image')) {
            $validated['room_image'] = $request->file('room_image')->store('hotel-rooms', 'public');
        }

        HotelRoom::create($validated);

        return redirect()->route('admin.hotel-room.index')->with('success', 'Data kamar hotel berhasil ditambahkan.');
    }

    public function show(HotelRoom $hotelRoom)
    {
        $hotelRoom->load('hotel');
        return view('admin.hotel-room.show', compact('hotelRoom'));
    }

    public function edit(HotelRoom $hotelRoom)
    {
        $hotels = Hotel::all();
        return view('admin.hotel-room.edit', compact('hotelRoom', 'hotels'));
    }

    public function update(Request $request, HotelRoom $hotelRoom)
    {
        $validated = $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'max_guest' => 'required|integer|min:1',
            'size' => 'nullable|string',
            'bed_type' => 'nullable|string',
            'facilities' => 'nullable|string',
            'availability' => 'required|in:available,unavailable',
            'room_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('room_image')) {
            if ($hotelRoom->room_image) {
                Storage::disk('public')->delete($hotelRoom->room_image);
            }
            $validated['room_image'] = $request->file('room_image')->store('hotel-rooms', 'public');
        }

        $hotelRoom->update($validated);

        return redirect()->route('admin.hotel-room.index')->with('success', 'Data kamar hotel berhasil diperbarui.');
    }

    public function destroy(HotelRoom $hotelRoom)
    {
        if ($hotelRoom->room_image) {
            Storage::disk('public')->delete($hotelRoom->room_image);
        }

        $hotelRoom->delete();

        return redirect()->route('admin.hotel-room.index')->with('success', 'Data kamar hotel berhasil dihapus.');
    }
}

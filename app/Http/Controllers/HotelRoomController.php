<?php

namespace App\Http\Controllers;

use App\Models\HotelRoom;
use Illuminate\Http\Request;

class HotelRoomController extends Controller
{
    public function index()
    {
        $rooms = HotelRoom::with('hotel')->get();
        return response()->json($rooms);
    }

    public function show($id)
    {
        $room = HotelRoom::with('hotel')->findOrFail($id);
        return response()->json($room);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'facilities' => 'nullable|string',
            'price' => 'required|numeric',
            'max_guest' => 'nullable|integer',
            'bed_type' => 'nullable|string',
            'room_size' => 'nullable|string',
            'image' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);
        $room = HotelRoom::create($data);
        return response()->json($room, 201);
    }

    public function update(Request $request, $id)
    {
        $room = HotelRoom::findOrFail($id);
        $data = $request->validate([
            'hotel_id' => 'sometimes|exists:hotels,id',
            'name' => 'sometimes|string',
            'description' => 'nullable|string',
            'facilities' => 'nullable|string',
            'price' => 'sometimes|numeric',
            'max_guest' => 'nullable|integer',
            'bed_type' => 'nullable|string',
            'room_size' => 'nullable|string',
            'image' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);
        $room->update($data);
        return response()->json($room);
    }

    public function destroy($id)
    {
        $room = HotelRoom::findOrFail($id);
        $room->delete();
        return response()->json(['message' => 'Hotel room deleted']);
    }
}

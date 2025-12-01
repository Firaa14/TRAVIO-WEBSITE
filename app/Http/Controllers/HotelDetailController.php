<?php

namespace App\Http\Controllers;

use App\Models\HotelDetail;
use Illuminate\Http\Request;

class HotelDetailController extends Controller
{
    public function index()
    {
        $details = HotelDetail::with('hotel')->get();
        return response()->json($details);
    }

    public function show($id)
    {
        $detail = HotelDetail::with('hotel')->findOrFail($id);
        return response()->json($detail);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'facilities' => 'nullable|string',
            'nama' => 'required|string',
            'location' => 'required|string',
            'description' => 'nullable|string',
            'interiorImage' => 'nullable|string',
            'headerImage' => 'nullable|string',
            'syaratKetentuan' => 'nullable|string',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'rating' => 'nullable|numeric',
            'price' => 'nullable|numeric',
            'map_url' => 'nullable|string',
        ]);
        $detail = HotelDetail::create($validated);
        return response()->json($detail, 201);
    }

    public function update(Request $request, $id)
    {
        $detail = HotelDetail::findOrFail($id);
        $validated = $request->validate([
            'facilities' => 'nullable|string',
            'nama' => 'nullable|string',
            'location' => 'nullable|string',
            'description' => 'nullable|string',
            'interiorImage' => 'nullable|string',
            'headerImage' => 'nullable|string',
            'syaratKetentuan' => 'nullable|string',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'rating' => 'nullable|numeric',
            'price' => 'nullable|numeric',
            'map_url' => 'nullable|string',
        ]);
        $detail->update($validated);
        return response()->json($detail);
    }

    public function destroy($id)
    {
        $detail = HotelDetail::findOrFail($id);
        $detail->delete();
        return response()->json(['message' => 'Hotel detail deleted']);
    }
}

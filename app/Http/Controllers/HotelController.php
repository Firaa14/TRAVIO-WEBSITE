<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\HotelDetail;
use App\Models\HotelRoom;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        // Ambil semua hotel dari database
        $hotels = Hotel::all();

        return view('hotels.index', compact('hotels'));
    }

    public function show($id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotelDetail = HotelDetail::where('hotel_id', $hotel->id)->first();
        $hotelRooms = HotelRoom::where('hotel_id', $hotel->id)->get();

        return view('hotels.show', compact('hotel', 'hotelDetail', 'hotelRooms'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
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

        return view('hotels.show', compact('hotel'));
    }
}

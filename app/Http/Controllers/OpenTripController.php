<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OpenTrip;

class OpenTripController extends Controller
{
    public function index()
    {
        $trips = OpenTrip::where('status', 'available')
            ->latest()
            ->get();
        return view('opentrip.index', compact('trips'));
    }

    public function show($id)
    {
        $trip = OpenTrip::findOrFail($id);
        return view('opentrip.show', compact('trip'));
    }
}

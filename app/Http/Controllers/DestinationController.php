<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;

class DestinationController extends Controller
{
    public function show($id, $tab = 'details')
    {
        $destination = Destination::with('destinasi')->find($id);

        // Check if destination exists
        if (!$destination) {
            abort(404, 'Destination not found');
        }

        $activeTab = $tab;

        // Ambil data dari relasi destinasi
        $data = [
            'id' => $destination->id,
            'name' => $destination->destinasi->name ?? '',
            'image' => $destination->destinasi->image ?? '',
            'location' => $destination->location,
            'detail' => $destination->detail,
            'itinerary' => json_decode($destination->itinerary, true),
            'price' => json_decode($destination->price_details, true),
            'description' => $destination->detail, // agar view tetap bisa pakai description
        ];

        return view('destinasi.show', [
            'destination' => (object) $data,
            'activeTab' => $activeTab
        ]);
    }
}

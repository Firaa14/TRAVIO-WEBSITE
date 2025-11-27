<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DetailPaketController extends Controller
{
    public function show($id)
    {
        // Dummy data, replace with actual DB query if needed
        $package = [
            'id' => $id,
            'name' => "Paket $id",
            'image' => asset('photos/bromo.webp'),
            'price' => 1200000,
            'facilities' => [
                'Hotel / Homestay',
                'Transport & Jeep (if required)',
                'Breakfast, Lunch, Dinner',
                'Tour Guide',
            ],
            'include' => 'Transportation & Meals',
            'itinerary' => [
                'Day 1: Pick up, check in, sightseeing tour',
                'Day 2: Main attractions and activities',
                'Day 3: Free time and return trip',
            ],
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti corporis doloremque incidunt, voluptate nemo quia impedit nobis! Atque natus totam nostrum recusandae voluptas non.',
        ];
        return view('packages.show', compact('package'));
    }
}

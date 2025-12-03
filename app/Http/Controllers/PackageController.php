<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;

class PackageController extends Controller
{
    public function index()
    {
        // Menggunakan pagination seperti cars dan hotels
        $packages = Package::paginate(12);
        return view('packages.index', compact('packages'));
    }

    public function show($id)
    {
        $package = Package::findOrFail($id);

        // Menambahkan dummy data untuk compatibility dengan view yang ada
        $packageData = $package->toArray();
        $packageData['include'] = $packageData['include'] ?? 'Transportation & Meals';
        $packageData['facilities'] = $packageData['facilities'] ?? [
            'Hotel / Homestay',
            'Transport & Tour Guide',
            'Breakfast, Lunch, Dinner',
            'Entrance Tickets',
            'Professional Guide'
        ];
        $packageData['itinerary'] = $packageData['itinerary'] ?? [
            'Day 1: Pick up from meeting point, check in accommodation, city tour',
            'Day 2: Main attractions visit, cultural experience, local cuisine',
            'Day 3: Adventure activities, free time, shopping time',
            'Day 4: Final tour, check out, return journey'
        ];

        return view('packages.show', compact('package'))->with('package', (object) $packageData);
    }
}

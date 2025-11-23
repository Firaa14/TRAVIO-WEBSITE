<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = collect([
            [
                'id' => 1,
                'title' => 'Bromo Sunrise Tour',
                'price' => 'Rp 550,000 / pax',
                'description' => 'Golden sunrise view at Mount Bromo, Jeep adventure, and crater trekking.',
                'image' => 'photos/destination1.jpg'
            ],
            [
                'id' => 2,
                'title' => 'Bali 3 Days 2 Nights',
                'price' => 'Rp 1,850,000 / pax',
                'description' => 'Explore Bali beaches, cultural temples, and island tours.',
                'image' => 'photos/destination2.jpg'
            ],
            [
                'id' => 3,
                'title' => 'Lombok Island Tour',
                'price' => 'Rp 2,300,000 / pax',
                'description' => 'Enjoy pink beach, Gili island hopping, and snorkeling.',
                'image' => 'photos/destination3.jpg'
            ],
            [
                'id' => 4,
                'title' => 'Malang City Tour',
                'price' => 'Rp 350,000 / pax',
                'description' => 'Visit Jatim Park, Museum Angkut, and Batu Night Spectacular.',
                'image' => 'photos/destination4.jpg'
            ],
        ]);

        return view('packages.index', compact('packages'));
    }

    public function show($id)
    {
        return view('packages.show', compact('id'));
    }
}

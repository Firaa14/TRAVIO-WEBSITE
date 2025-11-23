<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        // Dummy data hotel
        $hotels = collect([
            [
                'id' => 1,
                'title' => 'Grand Palace Hotel',
                'price' => 'Rp 850,000 / night',
                'description' => 'Luxury hotel located in the heart of the city with premium facilities.',
                'image' => 'photos/hotel1.jpg',
                'facilities' => ['WiFi', 'Breakfast', 'Pool', 'AC', 'King Bed']
            ],
            [
                'id' => 2,
                'title' => 'Sunrise Beach Resort',
                'price' => 'Rp 1,200,000 / night',
                'description' => 'Beautiful beachfront resort with stunning ocean views.',
                'image' => 'photos/hotel2.jpg',
                'facilities' => ['WiFi', 'Breakfast', 'Beach View', 'AC', 'Pool']
            ],
            [
                'id' => 3,
                'title' => 'Mountain View Lodge',
                'price' => 'Rp 600,000 / night',
                'description' => 'Cozy lodge located near the mountains, perfect for nature lovers.',
                'image' => 'photos/hotel3.jpg',
                'facilities' => ['WiFi', 'Breakfast', 'Mountain View', 'Heater']
            ],
            [
                'id' => 4,
                'title' => 'City Boutique Hotel',
                'price' => 'Rp 700,000 / night',
                'description' => 'Modern boutique style hotel with excellent service.',
                'image' => 'photos/hotel4.jpg',
                'facilities' => ['WiFi', 'Breakfast', 'AC', 'Smart TV']
            ],
            [
                'id' => 5,
                'title' => 'Royal Paradise Resort',
                'price' => 'Rp 2,400,000 / night',
                'description' => 'Exclusive luxury stay with private pool and VIP service.',
                'image' => 'photos/hotel5.jpg',
                'facilities' => ['WiFi', 'Private Pool', 'Breakfast', 'AC', 'VIP']
            ],
        ]);

        return view('hotels.index', compact('hotels'));
    }

    public function show($id)
    {
        // Dummy detail hotel
        return view('hotels.show', ['id' => $id]);
    }
}

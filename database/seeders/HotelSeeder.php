<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hotel;

class HotelSeeder extends Seeder
{
    public function run(): void
    {
        $hotels = [
            [
                'title' => 'Grand Palace Hotel',
                'price' => 'Rp 850,000 / night',
                'description' => 'Luxury hotel located in the heart of the city with premium facilities.',
                'image' => 'photos/hotel1.jpg',
                'location' => 'City Center',
                'facilities' => ['WiFi', 'Breakfast', 'Pool', 'AC', 'King Bed']
            ],
            [
                'title' => 'Sunrise Beach Resort',
                'price' => 'Rp 1,200,000 / night',
                'description' => 'Beautiful beachfront resort with stunning ocean views.',
                'image' => 'photos/hotel2.jpg',
                'location' => 'Beachfront',
                'facilities' => ['WiFi', 'Breakfast', 'Beach View', 'AC', 'Pool']
            ],
            [
                'title' => 'Mountain View Lodge',
                'price' => 'Rp 600,000 / night',
                'description' => 'Cozy lodge located near the mountains, perfect for nature lovers.',
                'image' => 'photos/hotel3.jpg',
                'location' => 'Mountain Area',
                'facilities' => ['WiFi', 'Breakfast', 'Mountain View', 'Heater']
            ],
            [
                'title' => 'City Boutique Hotel',
                'price' => 'Rp 700,000 / night',
                'description' => 'Modern boutique style hotel with excellent service.',
                'image' => 'photos/hotel4.jpg',
                'location' => 'Downtown',
                'facilities' => ['WiFi', 'Breakfast', 'AC', 'Smart TV']
            ],
            [
                'title' => 'Royal Paradise Resort',
                'price' => 'Rp 2,400,000 / night',
                'description' => 'Exclusive luxury stay with private pool and VIP service.',
                'image' => 'photos/hotel5.jpg',
                'location' => 'Exclusive Area',
                'facilities' => ['WiFi', 'Private Pool', 'Breakfast', 'AC', 'VIP']
            ],
        ];

        foreach ($hotels as $hotel) {
            Hotel::create($hotel);
        }
    }
}

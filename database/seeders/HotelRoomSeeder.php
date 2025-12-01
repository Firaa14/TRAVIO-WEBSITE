<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HotelRoom;
use App\Models\Hotel;

class HotelRoomSeeder extends Seeder
{
    public function run(): void
    {
        $hotels = Hotel::all();
        foreach ($hotels as $hotel) {
            HotelRoom::create([
                'hotel_id' => $hotel->id,
                'name' => 'Deluxe Room',
                'description' => 'Kamar luas dengan pemandangan indah dan fasilitas lengkap.',
                'facilities' => 'WiFi, AC, TV, Minibar, Shower, Breakfast',
                'price' => 750000,
                'max_guest' => 2,
                'bed_type' => 'King',
                'room_size' => '32m2',
                'image' => 'hr1.jpg',
                'status' => true,
            ]);
            HotelRoom::create([
                'hotel_id' => $hotel->id,
                'name' => 'Standard Room',
                'description' => 'Kamar nyaman untuk perjalanan bisnis atau liburan.',
                'facilities' => 'WiFi, AC, TV, Shower',
                'price' => 500000,
                'max_guest' => 2,
                'bed_type' => 'Queen',
                'room_size' => '24m2',
                'image' => 'hr2.jpg',
                'status' => true,
            ]);
        }
    }
}

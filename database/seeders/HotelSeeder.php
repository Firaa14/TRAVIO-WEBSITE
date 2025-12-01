<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hotel;
use App\Models\HotelDetail;
use App\Models\HotelRoom;

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

        foreach ($hotels as $hotelData) {
            $hotel = Hotel::create($hotelData);

            // Create hotel detail for the first hotel as example
            if ($hotel->id === 1) {
                $hotelDetail = HotelDetail::create([
                    'hotel_id' => $hotel->id,
                    'nama' => $hotel->title,
                    'location' => $hotel->location . ', Jakarta',
                    'description' => $hotel->description . ' The hotel features contemporary interiors with warm lighting and a relaxed atmosphere, creating a welcoming experience from the moment guests arrive. All rooms come equipped with comfortable bedding, air conditioning, a flat-screen TV, work desk, complimentary Wi-Fi, and a private bathroom with essential amenities.',
                    'headerImage' => 'photos/hotel1_header.jpg',
                    'interiorImage' => 'photos/hotel1_interior.jpg',
                    'facilities' => json_encode([
                        'Free WiFi',
                        'Swimming Pool',
                        'Fitness Center',
                        'Restaurant',
                        'Parking',
                        'Air Conditioning',
                        '24/7 Room Service',
                        'Concierge Service',
                        'Laundry Service',
                        'Business Center'
                    ]),
                    'syaratKetentuan' => "Check-in time: 3:00 PM\nCheck-out time: 12:00 PM\nCancellation policy: Free cancellation up to 24 hours before check-in\nNo smoking in rooms\nPets are not allowed\nAdditional bed charges may apply\nBreakfast is included in room rate\nID required at check-in",
                    'address' => 'Jl. Sudirman No.123, Jakarta Pusat',
                    'phone' => '+62211234567',
                    'email' => 'info@grandpalace.com',
                    'rating' => '4.5',
                    'price' => '850000'
                ]);

                // Create sample rooms for the first hotel
                $rooms = [
                    [
                        'name' => 'Deluxe Queen',
                        'description' => 'Spacious room with queen bed and city view',
                        'facilities' => json_encode(['Queen Bed', 'Air Conditioning', 'Free WiFi', 'TV', 'Minibar', 'Private Bathroom']),
                        'price' => '850000',
                        'max_guest' => '2',
                        'bed_type' => '1 Queen Bed',
                        'room_size' => '30 sqm',
                        'image' => 'photos/room1.jpg',
                        'status' => true
                    ],
                    [
                        'name' => 'Executive Suite',
                        'description' => 'Premium suite with executive lounge access',
                        'facilities' => json_encode(['King Bed', 'Living Area', 'Air Conditioning', 'Free WiFi', 'TV', 'Executive Lounge Access']),
                        'price' => '1200000',
                        'max_guest' => '3',
                        'bed_type' => '1 King Bed',
                        'room_size' => '50 sqm',
                        'image' => 'photos/room2.jpg',
                        'status' => true
                    ],
                    [
                        'name' => 'Family Room',
                        'description' => 'Perfect for families with connecting rooms',
                        'facilities' => json_encode(['2 Queen Beds', 'Air Conditioning', 'Free WiFi', 'TV', 'Refrigerator']),
                        'price' => '1100000',
                        'max_guest' => '4',
                        'bed_type' => '2 Queen Beds',
                        'room_size' => '40 sqm',
                        'image' => 'photos/room3.jpg',
                        'status' => true
                    ]
                ];

                foreach ($rooms as $roomData) {
                    $roomData['hotel_id'] = $hotel->id;
                    HotelRoom::create($roomData);
                }
            }
        }
    }
}

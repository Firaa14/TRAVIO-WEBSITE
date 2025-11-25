<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DetailHotelController extends Controller
{
    public function show($id)
    {
        // Dummy hotel data
        $hotel = [
            'id' => $id,
            'name' => 'Swiss-Belinn Malang',
            'location' => 'Jl. Veteran No.8A, Penanggungan, Kec. Klojen, Kota Malang, Jawa Timur 65145',
            'description' => 'Swiss-Belinn Malang is a modern 3-star hotel located in the lively district of Jalan Veteran, offering easy access to popular destinations such as Malang Town Square (MATOS), Universitas Brawijaya, and various cafés, shops, and entertainment spots. Its strategic location makes it an ideal choice for business travelers, families, students, and leisure guests seeking comfort and convenience in the heart of the city.

The hotel features contemporary interiors with warm lighting and a relaxed atmosphere, creating a welcoming experience from the moment guests arrive. Swiss-Belinn Malang offers several room types, including Superior, Deluxe, and Suites, each designed with a modern minimalist concept. All rooms come equipped with comfortable bedding, air conditioning, a flat-screen TV, work desk, complimentary Wi-Fi, and a private bathroom with essential amenities.

Guests can enjoy a variety of facilities, such as an outdoor swimming pool, fitness center, and an all-day dining restaurant serving Indonesian and international dishes. The hotel also provides meeting rooms suitable for business events, seminars, and small gatherings, supported by complete audio-visual equipment.

Known for its friendly staff and reliable service, Swiss-Belinn Malang ensures a pleasant and memorable stay for every guest visiting the beautiful city of Malang.',
            'images' => [
                '/photos/sb1.jpg',
                '/photos/sb2.jpg',
                '/photos/sb3.jpg',
                '/photos/sb4.jpg',
                '/photos/sb5.jpg',
                '/photos/sb6.jpg',
            ],

            'header_image' => 'assets/images/hotel_header.jpg',
            'checkin' => 'Mon, 29 Sept 2025',
            'date' => 'Mon, 29 Sept 2025 - Wed, 1 Oct 2025',
            'guest' => '1 Adult(s), 0 Child, 1 Room',
            'checkout' => 'Wed, 1 Oct 2025',
        ];

        // Room list (minimal 6 rooms)
        $rooms = [
            [
                'name' => 'Deluxe Queen',
                'bed' => '1 Queen Bed',
                'policy' => 'Free cancellation until Wed 12:59',
                'pay_type' => 'Pay at Hotel',
                'benefit' => 'Breakfast included',
                'price' => 'Rp 420.000',
                'image' => '/photos/hr1.jpg',
            ],
            [
                'name' => 'Executive Queen',
                'bed' => '1 Queen Bed',
                'policy' => 'Free cancellation',
                'pay_type' => 'Pay Now',
                'benefit' => 'Extra Benefit',
                'price' => 'Rp 510.000',
                'image' => '/photos/hr2.jpg',
            ],
            [
                'name' => 'Deluxe Twin',
                'bed' => '2 Single Beds',
                'policy' => 'Free cancellation',
                'pay_type' => 'Pay at Hotel',
                'benefit' => 'Breakfast included',
                'price' => 'Rp 430.000',
                'image' => '/photos/hr3.jpg',
            ],
            [
                'name' => 'Premier Room',
                'bed' => '1 King Bed',
                'policy' => 'Free cancellation',
                'pay_type' => 'Pay Near Stay Date',
                'benefit' => 'Excluded service fees',
                'price' => 'Rp 550.000',
                'image' => '/photos/hr4.jpg',
            ],
            [
                'name' => 'Junior Suite',
                'bed' => '1 King Bed',
                'policy' => 'Can reschedule',
                'pay_type' => 'Pay Now',
                'benefit' => 'Breakfast included',
                'price' => 'Rp 680.000',
                'image' => '/photos/hr5.jpg',
            ],
            [
                'name' => 'Family Suite',
                'bed' => '1 King Bed + Sofa Bed',
                'policy' => 'Free cancellation',
                'pay_type' => 'Pay at Hotel',
                'benefit' => 'Extra Benefit',
                'price' => 'Rp 750.000',
                'image' => '/photos/hr6.jpg',
            ],
        ];

        // Facilities
        $facilities = [
            'public' => ['Parking', 'Elevator', 'Restaurant', 'Free WiFi', 'Swimming Pool'],
            'services' => ['24-hour receptionist', 'Laundry service', 'Luggage storage', 'Tours'],
            'nearby' => ['ATM', 'Grocery', 'Salon', 'Hospital', 'Supermarket'],
            'inroom' => ['Desk', 'TV', 'Shower', 'Free WiFi'],
            'general' => ['AC', 'Non-smoking room'],
            'things' => ['Outdoor pool', 'Fitness center'],
            'business' => ['Business center', 'Meeting facilities'],
            'transport' => ['Parking area', 'Car rental'],
        ];

        return view('hotels.show', compact('hotel', 'rooms', 'facilities'));
    }
}

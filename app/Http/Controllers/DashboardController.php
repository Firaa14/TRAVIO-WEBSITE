<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $destinations = [
            [
                'name' => 'Nature Tourism',
                'image' => 'destination1.jpg',
                'discount' => 'Tumpak Sewu Waterfall'
            ],
            [
                'name' => 'Urban City',
                'image' => 'destination2.jpg',
                'discount' => 'Jodipan Vilage'
            ],
            [
                'name' => 'Historical & Cultural Tourism',
                'image' => 'destination3.jpg',
                'discount' => 'Satwa Museum and Batu Secret Zoo'
            ],
            [
                'name' => 'Thematic Villages',
                'image' => 'destination4.jpg',
                'discount' => 'Alun-alun Bunder Malang'
            ],
            [
                'name' => 'Theme Parks & Interactive Museums',
                'image' => 'destination4.jpg',
                'discount' => 'Jawa Timur Park'
            ],
            [
                'name' => 'Culinary Tourism',
                'image' => 'destination6.jpg',
                'discount' => 'Malang Cafe Aesthetic'
            ],
            [
                'name' => 'Photo Spot Destinations',
                'image' => 'destination7.jpg',
                'discount' => 'Pasar Apung Jawa Timur Park 1'
            ],
            [
                'name' => 'Adventure & Outdoor Tourism',
                'image' => 'destination8.jpg',
                'discount' => 'Coban Talun'
            ],
        ];

        $hotels = [
            [
                'name' => 'Solaris Hotel Malang',
                'image' => 'hotel1.jpg',
                'address' => 'Jl. Raya Karanglo No.69, Karanglo, Banjararum, Kec. Singosari, Kabupaten Malang, Jawa Timur 65153',
                'facilities' => ['Free WiFi', 'Spa', 'Restaurant', 'Swimming Pool'],
                'price' => 800000
            ],
            [
                'name' => 'Swiss-Belinn Malang',
                'image' => 'hotel2.jpg',
                'address' => 'Jl. Veteran No.8A, Penanggungan, Kec. Klojen, Kota Malang, Jawa Timur 65145',
                'facilities' => ['Free WiFi', 'Spa', 'Restaurant', 'Swimming Pool'],
                'price' => 410000
            ],
            [
                'name' => 'The Aliante Hotel & Convention Center',
                'image' => 'hotel3.jpg',
                'address' => 'Jl. Aries Munandar No.41-45, Kiduldalem, Kec. Klojen, Kota Malang, Jawa Timur 65112',
                'facilities' => ['Free WiFi', 'Spa', 'Restaurant', 'Swimming Pool'],
                'price' => 349000
            ],
            [
                'name' => 'Ascent Hotel & Cafe Malang',
                'image' => 'hotel4.jpg',
                'address' => 'Jl. Jaksa Agung Suprapto No.75 A, Rampal Celaket, Kec. Klojen, Kota Malang, Jawa Timur 65112',
                'facilities' => ['Free WiFi', 'Cafe', 'Restaurant', 'Swimming Pool'],
                'price' => 400000
            ],
        ];

        $cars = [
            [
                'name' => 'All New Raize GR Sport',
                'image' => 'All New Raize GR Sport.png',
                'spec' => 'Manual/Automatic, 7 seats, AC, Audio',
                'features' => ['Free Pickup', 'Full Tank', 'Insurance'],
                'price' => 350000
            ],
            [
                'name' => 'New Urban Cruiser Battery EV',
                'image' => 'New Urban Cruiser Battery EV.avif',
                'spec' => 'Manual/Automatic, 7 seats, AC, Audio',
                'features' => ['Free Pickup', 'Full Tank', 'Insurance'],
                'price' => 320000
            ],
            [
                'name' => 'New Agya GR Sport',
                'image' => 'New Agya GR Sport.png',
                'spec' => 'Automatic, 5 seats, AC, Audio',
                'features' => ['Free Pickup', 'Full Tank', 'Insurance'],
                'price' => 300000
            ],
            [
                'name' => 'New Hiace Commuter',
                'image' => 'New Hiace Commuter.jpg',
                'spec' => 'Manual/Automatic, 7 seats, AC, Audio',
                'features' => ['Free Pickup', 'Full Tank', 'Insurance'],
                'price' => 330000
            ],
        ];

        $packages = [
            [
                'name' => 'Bromo Sunrise & Malang Tour',
                'image' => 'bromo.webp',
                'discount' => '2 Days 1 Night'
            ],
            [
                'name' => 'Family Holiday Malang',
                'image' => 'family holiday.avif',
                'discount' => '4 Days 3 Nights'
            ],
            [
                'name' => 'Malang City Explore Package',
                'image' => 'Malang City Explore.jpg',
                'discount' => '2 Days 1 Night'
            ],
            [
                'name' => 'Malang Culinary & City Highlight',
                'image' => 'Malang Culinary & City Highlight.webp',
                'discount' => '1 Day'
            ],
            [
                'name' => 'Malang Nature Adventure',
                'image' => 'Malang Nature Adventure.webp',
                'discount' => '3 Days 2 Nights'
            ],
            [
                'name' => 'Romantic Honeymoon Staycation',
                'image' => 'Romantic Honeymoon Staycation.jpg',
                'discount' => '3 Days 2 Nights'
            ],
            [
                'name' => 'Study Tour & Edu Trip Malang',
                'image' => 'Study Tour & Edu Trip Malang.webp',
                'discount' => '1 Day'
            ],
            [
                'name' => 'Premium Luxury Vacation Malang',
                'image' => 'Premium Luxury Vacation Malang.webp',
                'discount' => '5 Days 4 Nights'
            ],
        ];

        $rentalAdvantages = [
            [
                'image' => 'rental1.png',
                'title' => 'Wide Car Selection',
                'desc' => 'Find the right car for every journey. From compact city cars to spacious family rides.'
            ],
            [
                'image' => 'rental2.png',
                'title' => 'Easy Booking Process',
                'desc' => 'Rent car in just a few clicks. No hassle, no long forms. Just book your ride anytime, anywhere, directly from Travio.'
            ],
            [
                'image' => 'rental3.png',
                'title' => 'Trusted Partners',
                'desc' => 'Drive with peace of mind. All rental cars are provided by verified partners to ensure safety, comfort, and reliability.'
            ],
            [
                'image' => 'rental4.png',
                'title' => 'Transparent',
                'desc' => 'No hidden fees, only cars costs. See all prices upfront, compare easily, and pay securely with various methods.'
            ],
        ];

        return view('dashboard', compact('destinations', 'hotels', 'cars', 'packages', 'rentalAdvantages'));
    }
}

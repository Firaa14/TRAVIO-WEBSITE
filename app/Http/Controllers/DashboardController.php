<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $destinations = [
            [
                'name' => 'Cultural City Discovery',
                'image' => 'destination1.jpg',
                'discount' => '15%'
            ],
            [
                'name' => 'Eco Green Park',
                'image' => 'destination6.jpg',
                'discount' => '18%'
            ],
            [
                'name' => 'Mountain Explorer Adventure',
                'image' => 'destination2.jpg',
                'discount' => '20%'
            ],
            [
                'name' => 'Tropical Beach Escape',
                'image' => 'destination3.jpg',
                'discount' => '30%'
            ],
            [
                'name' => 'Majestic Waterfall Journey',
                'image' => 'destination4.jpg',
                'discount' => '25%'
            ],
            [
                'name' => 'City Lights Nightlife',
                'image' => 'destination6.jpg',
                'discount' => '10%'
            ],
            [
                'name' => 'Safari Adventure',
                'image' => 'destination7.jpg',
                'discount' => '22%'
            ],
            [
                'name' => 'Waterfall Trekking',
                'image' => 'destination8.jpg',
                'discount' => '12%'
            ],
        ];

        $hotels = [
            [
                'name' => 'Grand Malang Hotel',
                'image' => 'hotel1.jpg',
                'address' => 'Jl. A. Yani no. 123, Klojen, Kota Malang',
                'facilities' => ['Free WiFi', 'Spa', 'Restaurant', 'Swimming Pool'],
                'price' => 800000
            ],
            [
                'name' => 'Swiss-Belinn Malang',
                'image' => 'hotel2.jpg',
                'address' => 'Jl. KH. Agus Salim, Dau, Kab. Malang',
                'facilities' => ['Free WiFi', 'Spa', 'Restaurant', 'Swimming Pool'],
                'price' => 410000
            ],
            [
                'name' => 'Jiwa Jawa Resort Ijen',
                'image' => 'hotel3.jpg',
                'address' => 'Jl. Boulevard Ijen, Klojen, Kota Malang',
                'facilities' => ['Free WiFi', 'Spa', 'Restaurant', 'Swimming Pool'],
                'price' => 450000
            ],
            [
                'name' => 'Grand Savero Hotel Malang',
                'image' => 'hotel4.jpg',
                'address' => 'Jl. Kalibiru no. 45, Kab. Malang',
                'facilities' => ['Free WiFi', 'Spa', 'Restaurant', 'Swimming Pool'],
                'price' => 550000
            ],
        ];

        $cars = [
            [
                'name' => 'Toyota Avanza',
                'image' => 'mobil1.jpg',
                'spec' => 'Manual/Automatic, 7 seats, AC, Audio',
                'features' => ['Free Pickup', 'Full Tank', 'Insurance'],
                'price' => 350000
            ],
            [
                'name' => 'Daihatsu Xenia',
                'image' => 'mobil2.jpg',
                'spec' => 'Manual/Automatic, 7 seats, AC, Audio',
                'features' => ['Free Pickup', 'Full Tank', 'Insurance'],
                'price' => 320000
            ],
            [
                'name' => 'Honda Brio',
                'image' => 'mobil3.jpg',
                'spec' => 'Automatic, 5 seats, AC, Audio',
                'features' => ['Free Pickup', 'Full Tank', 'Insurance'],
                'price' => 300000
            ],
            [
                'name' => 'Suzuki Ertiga',
                'image' => 'mobil4.jpg',
                'spec' => 'Manual/Automatic, 7 seats, AC, Audio',
                'features' => ['Free Pickup', 'Full Tank', 'Insurance'],
                'price' => 330000
            ],
        ];

        $packages = [
            [
                'name' => 'Cultural City Discovery',
                'image' => 'destination1.jpg',
                'discount' => '15%'
            ],
            [
                'name' => 'Mountain Explorer Adventure',
                'image' => 'destination2.jpg',
                'discount' => '20%'
            ],
            [
                'name' => 'Tropical Beach Escape',
                'image' => 'destination3.jpg',
                'discount' => '30%'
            ],
            [
                'name' => 'Majestic Waterfall Journey',
                'image' => 'destination4.jpg',
                'discount' => '25%'
            ],
            [
                'name' => 'City Lights Nightlife',
                'image' => 'destination5.jpg',
                'discount' => '10%'
            ],
            [
                'name' => 'Eco Green Park',
                'image' => 'destination6.jpg',
                'discount' => '18%'
            ],
            [
                'name' => 'Safari Adventure',
                'image' => 'destination7.jpg',
                'discount' => '22%'
            ],
            [
                'name' => 'Waterfall Trekking',
                'image' => 'destination8.jpg',
                'discount' => '12%'
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

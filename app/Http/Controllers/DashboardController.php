<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destinasi;
use App\Models\Hotel;
use App\Models\Car;

class DashboardController extends Controller
{
    public function index()
    {
        $destinations = Destinasi::all();

        $hotels = Hotel::all();

        $cars = Car::all();

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

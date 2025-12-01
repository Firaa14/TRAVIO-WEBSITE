<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destinasi;
use App\Models\Hotel;
use App\Models\Car;
use App\Models\Package;

class DashboardController extends Controller
{
    public function index()
    {
        $destinations = Destinasi::all();

        $hotels = Hotel::all();

        $cars = Car::all();

        $packages = Package::all();

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

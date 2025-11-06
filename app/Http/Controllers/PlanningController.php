<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlanningController extends Controller
{
    public function index()
    {
        // Dummy data destinasi
        $destinations = [
            [
                'name' => 'Cultural City Discovery',
                'discount' => '15%',
                'price' => 500000,
                'image' => asset('photos/destination1.jpg')
            ],
            [
                'name' => 'Mount Bromo Sunrise',
                'discount' => '10%',
                'price' => 600000,
                'image' => asset('photos/destination2.jpg')
            ],
            [
                'name' => 'Beach Escape Adventure',
                'discount' => '5%',
                'price' => 400000,
                'image' => asset('photos/destination3.jpg')
            ],
        ];

        // Dummy data hotel
        $hotels = [
            [
                'name' => 'Grand Malang Hotel',
                'price' => 800000,
                'image' => asset('photos/hotel1.jpg')
            ],
            [
                'name' => 'Tugu Heritage Hotel',
                'price' => 950000,
                'image' => asset('photos/hotel2.jpg')
            ],
            [
                'name' => 'Urban Stay Malang',
                'price' => 650000,
                'image' => asset('photos/hotel3.jpg')
            ],
        ];

        // Dummy data mobil
        $cars = [
            [
                'name' => 'Toyota Avanza',
                'price' => 400000,
                'image' => asset('photos/mobil1.jpg')
            ],
            [
                'name' => 'Innova Reborn',
                'price' => 600000,
                'image' => asset('photos/mobil2.jpg')
            ],
            [
                'name' => 'Hiace Premium',
                'price' => 1000000,
                'image' => asset('photos/mobil3.jpg')
            ],
        ];

        return view('planning', compact('destinations', 'hotels', 'cars'));
    }

    public function calculate(Request $request)
    {
        $total = 0;

        if ($request->destination_price)
            $total += $request->destination_price;
        if ($request->hotel_price)
            $total += $request->hotel_price;
        if ($request->car_price)
            $total += $request->car_price;

        $guestTotal = ($request->adults ?? 0) + ($request->children ?? 0) + ($request->special_needs ?? 0);
        $total *= max($guestTotal, 1);

        return back()->with('totalPrice', $total);
    }
}

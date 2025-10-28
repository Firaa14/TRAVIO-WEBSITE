<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlanningController extends Controller
{
    public function index()
    {
        // Dummy data destinations & hotels & cars
        $destinations = [
            ['name' => 'Cultural City Discovery', 'discount' => '15%', 'price' => 500000],
            ['name' => 'Mount Bromo Sunrise', 'discount' => '10%', 'price' => 600000],
            ['name' => 'Beach Escape Adventure', 'discount' => '5%', 'price' => 400000],
        ];

        $hotels = [
            ['name' => 'Grand Malang Hotel', 'price' => 800000],
            ['name' => 'Tugu Heritage Hotel', 'price' => 950000],
            ['name' => 'Urban Stay Malang', 'price' => 650000],
        ];

        $cars = [
            ['name' => 'Toyota Avanza', 'price' => 400000],
            ['name' => 'Innova Reborn', 'price' => 600000],
            ['name' => 'Hiace Premium', 'price' => 1000000],
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

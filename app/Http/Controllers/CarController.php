<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        // Dummy data mobil
        $cars = collect([
            [
                'id' => 1,
                'title' => 'Toyota Avanza',
                'price' => 'Rp 350,000 / day',
                'description' => 'Comfortable family car, fuel efficient, seats 7 passengers.',
                'image' => 'photos/mobil1.jpg',
                'facilities' => ['AC', 'Audio', '7 Seats', 'Automatic']
            ],
            [
                'id' => 2,
                'title' => 'Honda Brio',
                'price' => 'Rp 300,000 / day',
                'description' => 'Compact city car, suitable for urban driving and parking.',
                'image' => 'photos/mobil2.jpg',
                'facilities' => ['AC', 'Audio', '5 Seats', 'Manual']
            ],
            [
                'id' => 3,
                'title' => 'Toyota Fortuner',
                'price' => 'Rp 900,000 / day',
                'description' => 'Premium SUV with strong performance for any terrain.',
                'image' => 'photos/mobil3.jpg',
                'facilities' => ['AC', 'Audio', '7 Seats', 'Automatic', 'SUV']
            ],
            [
                'id' => 4,
                'title' => 'Mitsubishi Pajero Sport',
                'price' => 'Rp 1,000,000 / day',
                'description' => 'Luxury SUV perfect for long trips and adventure.',
                'image' => 'photos/mobil4.jpg',
                'facilities' => ['AC', 'Audio', '7 Seats', 'Automatic', 'SUV']
            ],
            [
                'id' => 5,
                'title' => 'Toyota Alphard',
                'price' => 'Rp 2,800,000 / day',
                'description' => 'High-end MPV with amazing comfort and VIP features.',
                'image' => 'photos/mobil5.jpg',
                'facilities' => ['AC', 'Audio', '7 Seats', 'Automatic', 'MPV', 'VIP']
            ],
        ]);

        return view('cars.index', compact('cars'));
    }

    public function show($id)
    {
        // Dummy detail mobil
        return view('cars.show', ['id' => $id]);
    }
}

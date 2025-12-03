<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        // Ambil mobil dari database dengan paginasi seperti hotel
        $cars = Car::paginate(8);

        return view('cars.index', compact('cars'));
    }

    public function show($id)
    {
        $car = Car::findOrFail($id);

        // Debug untuk memastikan data
        if (!$car) {
            abort(404, 'Car not found');
        }

        // Pastikan facilities adalah array
        if (!is_array($car->facilities)) {
            $car->facilities = [];
        }

        return view('cars.show', compact('car'));
    }
}
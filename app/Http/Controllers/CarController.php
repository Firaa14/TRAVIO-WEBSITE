<?php

namespace App\Http\Controllers;

use App\Models\Car; // Import model Car
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all()->toArray();
        return view('cars.index', compact('cars'));
    }

    public function show($id)
    {

        $car = Car::findOrFail($id);
        return view('cars.show', compact('car'));
    }
}
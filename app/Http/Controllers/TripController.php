<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TripController extends Controller
{
    // Show trip detail page (view more)
    public function show($id)
    {
        // Dummy trip data; nanti bisa diganti database
        $trip = (object) [
            'id' => $id,
            'title' => 'Open Trip Bromo Sunrise',
            'location' => 'Mount Bromo, Malang',
            'schedule' => 'Every Saturday & Sunday',
            'price' => 350000,
            'description' => 'Enjoy the beautiful sunrise at Mount Bromo with a group of travelers.',
            'image' => 'photos/bromo.webp',

            // dynamic lists
            'included' => [
                'Transportation (Jeep)',
                'Entrance Tickets',
                'Local Tour Guide',
                'Photo Spots',
                'Mineral Water',
            ],

            'prepare' => [
                'Warm Jacket',
                'Comfortable Shoes',
                'Camera or Phone',
                'Personal Medication',
                'Extra Cash',
            ],
        ];

        return view('opentrip.show', compact('trip'));
    }


    // Show registration form
    public function register($id)
    {
        // Dummy trip data; nanti bisa diganti database
        $trip = (object) [
            'id' => $id,
            'title' => 'Open Trip Bromo Sunrise',
            'price' => 350000,
        ];
        return view('opentrip.register', compact('trip'));
    }


    // Handle registration form submission
    public function registerSubmit(Request $request, $id)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        // Normally: save to database
        // For now: just return success page

        return back()->with('success', 'Your registration has been submitted successfully.');
    }
}

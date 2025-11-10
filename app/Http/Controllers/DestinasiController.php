<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DestinasiController extends Controller
{
    public function index()
    {
        // Dummy data destinasi wisata
        $destinations = collect([
            [
                'id' => 1,
                'title' => 'Ranu Regulo & Ngliyep Beach',
                'price' => 'Rp 48,000',
                'description' => 'Enjoy the cool mountain air and the southern Malang beach in one exciting trip.',
                'image' => 'photos/destination1.jpg'
            ],
            [
                'id' => 2,
                'title' => 'Tiban Mosque Turen & Kidal Temple',
                'price' => 'Rp 50,000',
                'description' => 'A religious and historical journey at two famous Malang landmarks.',
                'image' => 'photos/destination2.jpg'
            ],
            [
                'id' => 3,
                'title' => 'Tumpak Sewu Waterfall & Bromo',
                'price' => 'Rp 90,000',
                'description' => 'Experience the beauty of East Malang and the charm of Mount Bromo.',
                'image' => 'photos/destination3.jpg'
            ],
            [
                'id' => 4,
                'title' => 'Jatim Park 1 & 2',
                'price' => 'Rp 120,000',
                'description' => 'A family destination full of education and entertainment in Batu.',
                'image' => 'photos/destination4.jpg'
            ],
            [
                'id' => 5,
                'title' => 'Jatim Park 1 & 2',
                'price' => 'Rp 120,000',
                'description' => 'A family destination full of education and entertainment in Batu.',
                'image' => 'photos/destination5.jpg'
            ],
            [
                'id' => 6,
                'title' => 'Ranu Regulo & Ngliyep Beach',
                'price' => 'Rp 48,000',
                'description' => 'Enjoy the cool mountain air and the southern Malang beach in one exciting trip.',
                'image' => 'photos/destination1.jpg'
            ],
            [
                'id' => 7,
                'title' => 'Tiban Mosque Turen & Kidal Temple',
                'price' => 'Rp 50,000',
                'description' => 'A religious and historical journey at two famous Malang landmarks.',
                'image' => 'photos/destination2.jpg'
            ],
            [
                'id' => 8,
                'title' => 'Tumpak Sewu Waterfall & Bromo',
                'price' => 'Rp 90,000',
                'description' => 'Experience the beauty of East Malang and the charm of Mount Bromo.',
                'image' => 'photos/destination3.jpg'
            ],
            [
                'id' => 9,
                'title' => 'Jatim Park 1 & 2',
                'price' => 'Rp 120,000',
                'description' => 'A family destination full of education and entertainment in Batu.',
                'image' => 'photos/destination4.jpg'
            ],
            [
                'id' => 10,
                'title' => 'Jatim Park 1 & 2',
                'price' => 'Rp 120,000',
                'description' => 'A family destination full of education and entertainment in Batu.',
                'image' => 'photos/destination5.jpg'
            ],
        ]);

        return view('destinasi.index', compact('destinations'));
    }

    public function show($id)
    {
        // Dummy detail destinasi
        return view('destinasi.show', ['id' => $id]);
    }
}

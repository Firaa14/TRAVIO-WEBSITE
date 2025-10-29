<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TravelController extends Controller
{
    public function show($id)
    {
        // Dummy data destinasi populer
        $destinations = [
            1 => [
                'title' => 'Brakseng & Bedengan',
                'hero_image' => 'photos/bedengan.jpg',
                'details' => "Paket wisata Brakseng & Bedengan menghadirkan pengalaman berlibur yang menyegarkan dengan pesona alam pegunungan khas Kota Batu, Malang. Perjalanan dimulai di kawasan Brakseng...",
                'itinerary' => [
                    '08:00 - Berangkat menuju kawasan Brakseng',
                    '09:30 - Menikmati panorama dan berfoto di spot instagramable',
                    '11:00 - Istirahat dan makan siang di area Brakseng',
                    '13:00 - Melanjutkan perjalanan ke Bedengan',
                    '15:00 - Aktivitas camping ringan dan eksplorasi alam sekitar',
                    '17:30 - Kembali ke titik awal perjalanan'
                ],
                'price_details' => [
                    'Harga Paket: Rp 50.000/orang',
                    'Sudah termasuk: tiket masuk, pemandu wisata, dan snack ringan',
                    'Belum termasuk: transportasi pribadi dan makan utama'
                ],
            ],
        ];

        $destination = $destinations[$id] ?? null;

        if (!$destination) {
            abort(404);
        }

        return view('travel.show', compact('destination'));
    }
}

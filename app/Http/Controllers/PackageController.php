<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        // Halaman utama /package
        $package = [
            'title' => 'Brakseng & Bedengan Adventure',
            'description' => 'Paket wisata Brakseng & Bedengan menghadirkan pengalaman berlibur yang menyegarkan dengan pesona alam pegunungan khas Kota Batu, Malang...',
            'itinerary' => [
                '07:00 - Berangkat dari Kota Batu menuju Brakseng',
                '09:00 - Menikmati pemandangan kebun sayur dan berfoto',
                '11:00 - Perjalanan ke Bedengan dan istirahat siang',
                '13:00 - Aktivitas camping ringan dan eksplorasi alam',
                '17:00 - Kembali ke titik awal dan selesai.'
            ],
            'price' => [
                'Per orang' => 'Rp 50.000',
                'Include' => [
                    'Transportasi lokal',
                    'Tiket masuk area wisata',
                    'Snack & air mineral'
                ],
                'Exclude' => [
                    'Makan utama',
                    'Sewa tenda (opsional)'
                ]
            ]
        ];

        return view('package.details', compact('package'));
    }

    public function show($id)
    {
        // Untuk sementara, gunakan dummy data (nanti bisa ambil dari database pakai id)
        $package = [
            'id' => $id,
            'title' => 'Brakseng & Bedengan Adventure',
            'description' => 'Detail paket wisata ID #' . $id . ' — nikmati kesejukan udara pegunungan dan pemandangan alam yang memukau di Brakseng dan Bedengan.',
            'itinerary' => [
                '07:00 - Berangkat dari titik kumpul',
                '09:00 - Tiba di Brakseng dan jelajah kebun sayur',
                '12:00 - Istirahat dan makan siang',
                '14:00 - Aktivitas di Bedengan',
                '17:00 - Kembali ke titik awal'
            ],
            'price' => [
                'Per orang' => 'Rp 75.000',
                'Include' => [
                    'Transportasi lokal',
                    'Guide wisata',
                    'Tiket masuk area wisata'
                ],
                'Exclude' => [
                    'Makan siang',
                    'Pengeluaran pribadi'
                ]
            ]
        ];

        return view('package.details', compact('package'));
    }
}

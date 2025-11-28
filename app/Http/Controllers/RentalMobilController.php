<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RentalMobilController extends Controller
{
    public function checkout($id = null)
    {
        $mobil = null;
        if ($id) {
            // Dummy mobil data, replace with DB query if needed
            $mobil = [
                'id' => $id,
                'name' => 'Toyota Avanza 2022',
                'description' => 'Mobil nyaman untuk perjalanan keluarga, irit, kabin luas.',
                'capacity' => 7,
                'location' => 'Makassar, Indonesia',
                'images' => [
                    '/photos/it1.jpg',
                    '/photos/it2.jpg',
                    '/photos/it3.jpg',
                    '/photos/it4.jpg',
                    '/photos/it1.jpg',
                    '/photos/it5.jpg'
                ],
                'features' => [
                    'AC Dingin',
                    'Bluetooth Audio',
                    'Kursi Reclining',
                    'Power Steering',
                    'Usb Charger'
                ],
                'rules' => [
                    'Dilarang merokok di dalam mobil',
                    'BBM kembali seperti awal',
                    'Telat pengembalian kena charge tambahan'
                ],
                'price_full' => 450000,
                'price_half' => 250000,
            ];
        }
        return view('cars.checkout_mobil', compact('mobil'));
    }
    public function show($id)
    {
        // Dummy mobil
        $car = [
            'id' => $id,
            'name' => 'Toyota Avanza 2022',
            'description' => 'Mobil nyaman untuk perjalanan keluarga, irit, kabin luas.',
            'capacity' => 7,
            'location' => 'Makassar, Indonesia',
            'images' => [
                '/photos/it1.jpg',
                '/photos/it2.jpg',
                '/photos/it3.jpg',
                '/photos/it4.jpg',
                '/photos/it1.jpg',
                '/photos/it5.jpg'
            ],
            'features' => [
                'AC Dingin',
                'Bluetooth Audio',
                'Kursi Reclining',
                'Power Steering',
                'Usb Charger'
            ],
            'rules' => [
                'Dilarang merokok di dalam mobil',
                'BBM kembali seperti awal',
                'Telat pengembalian kena charge tambahan'
            ],
            'price_full' => 450000,
            'price_half' => 250000,
        ];

        return view('cars.show', compact('car'));
    }

    public function form($id)
    {
        $carId = $id;
        return view('cars.form', compact('carId'));
    }

    public function submit(Request $request, $id)
    {
        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'jumlah_penumpang' => 'required|integer|min:1',
            'driver' => 'required|in:dengan,tanpa',
            'durasi' => 'required|in:half,full',
            'nama_penyewa' => 'required|string',
            'nama_sopir' => 'nullable|required_if:driver,tanpa',
            'ktp' => 'nullable|required_if:driver,tanpa|file|mimes:jpg,png,pdf',
            'sim_a' => 'nullable|required_if:driver,tanpa|file|mimes:jpg,png,pdf',
            'kk' => 'nullable|required_if:driver,tanpa|file|mimes:jpg,png,pdf',
        ]);

        // Simulasi bookingId, pada aplikasi nyata ambil dari database setelah insert
        $bookingId = 1;
        return redirect()->route('invoice.mobil', ['bookingId' => $bookingId]);
    }

    public function invoiceMobil($bookingId)
    {
        // Dummy data, pada aplikasi nyata ambil dari database
        $booking = [
            'id' => $bookingId,
            'nama_penyewa' => 'Contoh Penyewa',
            'mobil_name' => 'Toyota Avanza 2022',
            'start_date' => '2025-12-01',
            'end_date' => '2025-12-02',
            'durasi' => 'full',
            'jumlah_penumpang' => 4,
            'driver' => 'dengan',
            'total' => 450000,
        ];
        return view('cars.invoice_mobil', compact('booking'));
    }
}

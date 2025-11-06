<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OpenTripController extends Controller
{
    public function index()
    {
        // Contoh data statis (nanti bisa diganti dari database)
        $trips = [
            [
                'id' => 1,
                'judul' => 'Open Trip Bromo Sunrise',
                'lokasi' => 'Gunung Bromo, Malang',
                'tanggal' => 'Setiap Sabtu & Minggu',
                'harga' => 350000,
                'gambar' => 'photos/destination5.jpg',
                'deskripsi' => 'Nikmati keindahan matahari terbit di Bromo bersama rombongan traveler lainnya!'
            ],
            [
                'id' => 2,
                'judul' => 'Open Trip Pulau Sempu',
                'lokasi' => 'Sendang Biru, Malang Selatan',
                'tanggal' => 'Setiap Jumat - Minggu',
                'harga' => 450000,
                'gambar' => 'photos/destination12.jpg',
                'deskripsi' => 'Jelajahi pulau tersembunyi dengan pasir putih dan danau biru yang menakjubkan.'
            ],
            [
                'id' => 3,
                'judul' => 'Open Trip Coban Rondo',
                'lokasi' => 'Batu, Malang',
                'tanggal' => 'Setiap Akhir Pekan',
                'harga' => 250000,
                'gambar' => 'photos/destination2.jpg',
                'deskripsi' => 'Nikmati keindahan air terjun legendaris Coban Rondo dalam suasana alam yang sejuk.'
            ],
        ];

        return view('opentrip.index', compact('trips'));
    }
}

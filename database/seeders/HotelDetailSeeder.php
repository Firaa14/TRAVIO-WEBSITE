<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HotelDetail;
use App\Models\Hotel;

class HotelDetailSeeder extends Seeder
{
    public function run(): void
    {
        $hotels = Hotel::all();
        foreach ($hotels as $hotel) {
            $price = $hotel->price ?? 500000;
            if (!is_numeric($price)) {
                // Ambil angka dari string harga, misal "Rp 850,000 / night" menjadi 850000
                $price = preg_replace('/[^0-9]/', '', $price);
                $price = $price ? (int) $price : 500000;
            }
            HotelDetail::create([
                'hotel_id' => $hotel->id,
                'facilities' => is_array($hotel->facilities) ? implode(', ', $hotel->facilities) : ($hotel->facilities ?? 'WiFi, Pool, Restaurant'),
                'nama' => $hotel->nama ?? ($hotel->title ?? 'Hotel Tanpa Nama'),
                'location' => $hotel->location ?? 'Lokasi tidak tersedia',
                'description' => 'Deskripsi hotel ' . ($hotel->nama ?? $hotel->title ?? ''),
                'interiorImage' => 'interior_default.jpg',
                'headerImage' => 'destinaion.jpg',
                'syaratKetentuan' => 'Check-in mulai pukul 14:00, tidak boleh membawa hewan peliharaan.',
                'address' => $hotel->address ?? 'Alamat default',
                'phone' => $hotel->phone ?? '08123456789',
                'email' => $hotel->email ?? 'info@hotel.com',
                'rating' => $hotel->rating ?? 4.5,
                'price' => $price,
                'map_url' => $hotel->map_url ?? 'https://maps.google.com',
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Car;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Car::insert([
            [
                'title' => 'Toyota Avanza 2022',
                'brand' => 'Toyota',
                'model' => 'Avanza',
                'year' => 2022,
                'transmission' => 'Automatic',
                'fuel_type' => 'Petrol',
                'capacity' => 7,
                'color' => 'Silver',
                'license_plate' => 'DD 1234 AB',
                'price' => 500000,
                'description' => 'Mobil keluarga yang nyaman dan ekonomis dengan kapasitas 7 penumpang. Cocok untuk perjalanan keluarga atau group kecil.',
                'location' => 'Makassar, Indonesia',
                'image' => 'photos/car1.jpg',
                'interior_image' => 'photos/avanza_interior.jpg',
                'gallery_images' => json_encode([
                    'photos/avanza_front.jpg',
                    'photos/avanza_side.jpg',
                    'photos/avanza_back.jpg',
                    'photos/avanza_dashboard.jpg'
                ]),
                'facilities' => json_encode(['Air Conditioning', 'Automatic Transmission', 'GPS Navigation', 'Bluetooth Audio', '7 Seats', 'USB Charger']),
                'terms_conditions' => json_encode([
                    'Dilarang merokok di dalam mobil',
                    'BBM kembali seperti awal saat pengambilan',
                    'Keterlambatan pengembalian dikenakan charge tambahan Rp 50.000/jam',
                    'Kerusakan mobil menjadi tanggung jawab penyewa',
                    'Wajib memiliki SIM A yang masih berlaku (untuk self drive)'
                ])
            ],
            [
                'title' => 'Honda Civic 2021',
                'brand' => 'Honda',
                'model' => 'Civic',
                'year' => 2021,
                'transmission' => 'Manual',
                'fuel_type' => 'Petrol',
                'capacity' => 5,
                'color' => 'Black',
                'license_plate' => 'DD 5678 CD',
                'price' => 750000,
                'description' => 'Sedan mewah dengan performa excellent dan kenyamanan tinggi. Ideal untuk business trip atau acara formal.',
                'location' => 'Makassar, Indonesia',
                'image' => 'photos/car2.jpg',
                'interior_image' => 'photos/civic_interior.jpg',
                'gallery_images' => json_encode([
                    'photos/civic_front.jpg',
                    'photos/civic_side.jpg',
                    'photos/civic_back.jpg',
                    'photos/civic_dashboard.jpg'
                ]),
                'facilities' => json_encode(['Air Conditioning', 'Manual Transmission', 'Sunroof', 'Leather Seats', 'Premium Audio', 'Cruise Control']),
                'terms_conditions' => json_encode([
                    'Dilarang merokok di dalam mobil',
                    'BBM kembali seperti awal saat pengambilan',
                    'Keterlambatan pengembalian dikenakan charge tambahan Rp 75.000/jam',
                    'Kerusakan mobil menjadi tanggung jawab penyewa',
                    'Wajib memiliki SIM A yang masih berlaku (untuk self drive)'
                ])
            ],
            [
                'title' => 'Suzuki Ertiga 2023',
                'brand' => 'Suzuki',
                'model' => 'Ertiga',
                'year' => 2023,
                'transmission' => 'Automatic',
                'fuel_type' => 'Petrol',
                'capacity' => 7,
                'color' => 'White',
                'license_plate' => 'DD 9012 EF',
                'price' => 600000,
                'description' => 'MPV compact yang menawarkan efisiensi bahan bakar tinggi dan kenyamanan optimal untuk keluarga.',
                'location' => 'Makassar, Indonesia',
                'image' => 'photos/car3.jpg',
                'interior_image' => 'photos/ertiga_interior.jpg',
                'gallery_images' => json_encode([
                    'photos/ertiga_front.jpg',
                    'photos/ertiga_side.jpg',
                    'photos/ertiga_back.jpg',
                    'photos/ertiga_dashboard.jpg'
                ]),
                'facilities' => json_encode(['Air Conditioning', 'Automatic Transmission', 'Rearview Camera', 'USB Charging Ports', 'Keyless Entry', 'Electric Windows']),
                'terms_conditions' => json_encode([
                    'Dilarang merokok di dalam mobil',
                    'BBM kembali seperti awal saat pengambilan',
                    'Keterlambatan pengembalian dikenakan charge tambahan Rp 60.000/jam',
                    'Kerusakan mobil menjadi tanggung jawab penyewa',
                    'Wajib memiliki SIM A yang masih berlaku (untuk self drive)'
                ])
            ],
        ]);
    }
}

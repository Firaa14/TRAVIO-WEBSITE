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
                'title' => 'Toyota Avanza',
                'price' => '500000',
                'description' => 'A reliable and spacious MPV suitable for family trips.',
                'image' => 'photos/car1.jpg',
                'facilities' => json_encode(['Air Conditioning', 'Automatic Transmission', 'GPS Navigation', 'Bluetooth Connectivity'])
            ],
            [
                'title' => 'Honda Civic',
                'price' => '750000',
                'description' => 'A stylish sedan with excellent performance and comfort.',
                'image' => 'photos/car2.jpg',
                'facilities' => json_encode(['Air Conditioning', 'Manual Transmission', 'Sunroof', 'Leather Seats'])
            ],
            [
                'title' => 'Suzuki Ertiga',
                'price' => '600000',
                'description' => 'A compact MPV that offers great fuel efficiency and comfort.',
                'image' => 'photos/car3.jpg',
                'facilities' => json_encode(['Air Conditioning', 'Automatic Transmission', 'Rearview Camera', 'USB Charging Ports'])
            ],
        ]);
    }
}

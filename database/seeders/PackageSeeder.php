<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Package;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Package::insert([
            [
                'title' => 'Adventure in Bromo',
                'price' => 300000,
                'description' => 'Experience the breathtaking views of Mount Bromo with our guided adventure package.',
                'image' => 'photos/package1.jpg'
            ],
            [
                'title' => 'Cultural Tour of Yogyakarta',
                'price' => 450000,
                'description' => 'Explore the rich cultural heritage of Yogyakarta with visits to temples and traditional markets.',
                'image' => 'photos/package2.jpg'
            ],
            [
                'title' => 'Beach Getaway in Bali',
                'price' => 600000,
                'description' => 'Relax on the beautiful beaches of Bali with our exclusive beach getaway package.',
                'image' => 'photos/package3.jpg'
            ],
        ]);
    }
}

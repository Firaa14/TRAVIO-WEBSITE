<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Destinasi;

class DestinasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Destinasi::insert([
            [
                'name' => 'Ranu Regulo & Ngliyep Beach',
                'price' => 48000,
                'description' => 'Enjoy the cool mountain air and the southern Malang beach in one exciting trip.',
                'image' => 'photos/destination1.jpg'
            ],
            [
                'name' => 'Tiban Mosque Turen & Kidal Temple',
                'price' => 50000,
                'description' => 'A religious and historical journey at two famous Malang landmarks.',
                'image' => 'photos/destination2.jpg'
            ],
            [
                'name' => 'Tumpak Sewu Waterfall & Bromo',
                'price' => 90000,
                'description' => 'Experience the beauty of East Malang and the charm of Mount Bromo.',
                'image' => 'photos/destination3.jpg'
            ],
            [
                'name' => 'Jatim Park 1 & 2',
                'price' => 120000,
                'description' => 'A family destination full of education and entertainment in Batu.',
                'image' => 'photos/destination4.jpg'
            ],
            [
                'name' => 'Jatim Park 1 & 2',
                'price' => 120000,
                'description' => 'A family destination full of education and entertainment in Batu.',
                'image' => 'photos/destination5.jpg'
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed destinasi
        $this->call(DestinasiSeeder::class);
        // Seed destination details
        $this->call(DestinationSeeder::class);
        // Seed hotel
        $this->call(HotelSeeder::class);
        // Seed cars
        $this->call(CarSeeder::class);
        // Seed users
        $this->call(UserSeeder::class);
        // Seed car bookings
        $this->call(CarBookingSeeder::class);
    }
}

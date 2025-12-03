<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CarBooking;
use App\Models\Car;
use App\Models\User;

class CarBookingSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $cars = Car::all();
        $users = User::all();

        if ($cars->isEmpty() || $users->isEmpty()) {
            $this->command->info('Please run CarSeeder and create users before running CarBookingSeeder');
            return;
        }

        $bookings = [
            [
                'user_id' => $users->random()->id,
                'car_id' => $cars->random()->id,
                'start_date' => now()->addDays(1),
                'end_date' => now()->addDays(3),
                'passengers' => 4,
                'duration_type' => 'full',
                'with_driver' => true,
                'renter_name' => 'John Doe',
                'driver_name' => null,
                'ktp_path' => null,
                'sim_path' => null,
                'total_price' => 800000,
                'status' => 'confirmed',
                'notes' => 'Business trip',
            ],
            [
                'user_id' => $users->random()->id,
                'car_id' => $cars->random()->id,
                'start_date' => now()->addDays(5),
                'end_date' => now()->addDays(7),
                'passengers' => 2,
                'duration_type' => 'full',
                'with_driver' => false,
                'renter_name' => 'Jane Smith',
                'driver_name' => 'Jane Smith',
                'ktp_path' => 'car-bookings/ktp/sample_ktp.jpg',
                'sim_path' => 'car-bookings/sim/sample_sim.jpg',
                'total_price' => 600000,
                'status' => 'pending',
                'notes' => 'Weekend trip',
            ],
            [
                'user_id' => $users->random()->id,
                'car_id' => $cars->random()->id,
                'start_date' => now()->addDays(10),
                'end_date' => now()->addDays(15),
                'passengers' => 6,
                'duration_type' => 'full',
                'with_driver' => true,
                'renter_name' => 'Michael Johnson',
                'driver_name' => null,
                'ktp_path' => null,
                'sim_path' => null,
                'total_price' => 2500000,
                'status' => 'confirmed',
                'notes' => 'Family vacation',
            ],
        ];

        foreach ($bookings as $booking) {
            CarBooking::create($booking);
        }

        $this->command->info('CarBookingSeeder completed successfully!');
    }
}
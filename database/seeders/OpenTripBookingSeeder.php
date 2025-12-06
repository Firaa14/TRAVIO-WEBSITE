<?php

namespace Database\Seeders;

use App\Models\OpenTripBooking;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class OpenTripBookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->error('No users found. Please run UserSeeder first.');
            return;
        }

        $trips = [
            [
                'title' => 'Open Trip Bromo Sunrise',
                'location' => 'Gunung Bromo, Malang',
                'schedule' => 'Setiap Sabtu & Minggu',
                'price' => 350000,
            ],
            [
                'title' => 'Open Trip Pulau Sempu',
                'location' => 'Sendang Biru, Malang Selatan',
                'schedule' => 'Setiap Jumat - Minggu',
                'price' => 450000,
            ],
            [
                'title' => 'Open Trip Coban Rondo',
                'location' => 'Batu, Malang',
                'schedule' => 'Setiap Akhir Pekan',
                'price' => 250000,
            ],
        ];

        $statuses = ['pending', 'confirmed', 'cancelled'];
        $paymentMethods = ['bank_transfer', 'qris', 'e_wallet', 'cash'];
        $genders = ['male', 'female'];

        // Create 15 sample bookings
        for ($i = 0; $i < 15; $i++) {
            $trip = $trips[array_rand($trips)];
            $user = $users->random();
            $participants = rand(1, 4);
            $status = $statuses[array_rand($statuses)];

            OpenTripBooking::create([
                'user_id' => $user->id,
                'trip_title' => $trip['title'],
                'trip_location' => $trip['location'],
                'trip_schedule' => $trip['schedule'],
                'trip_price' => $trip['price'],
                'full_name' => $user->name,
                'phone' => '08' . rand(1000000000, 9999999999),
                'email' => $user->email,
                'gender' => $genders[array_rand($genders)],
                'dob' => Carbon::now()->subYears(rand(20, 50))->format('Y-m-d'),
                'address' => 'Jl. Example No. ' . rand(1, 100) . ', Malang',
                'emergency_name' => 'Emergency Contact ' . $i,
                'emergency_phone' => '08' . rand(1000000000, 9999999999),
                'participants' => $participants,
                'total_price' => $trip['price'] * $participants,
                'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                'payment_proof' => 'payment_proofs/sample_' . $i . '.jpg',
                'status' => $status,
                'notes' => $i % 3 == 0 ? 'Need vegetarian meals' : null,
                'created_at' => Carbon::now()->subDays(rand(1, 30)),
            ]);
        }

        $this->command->info('Open Trip Booking seeder completed successfully!');
    }
}

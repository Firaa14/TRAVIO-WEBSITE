<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HotelBooking;
use App\Models\HotelDetail;
use App\Models\HotelRoom;
use App\Models\User;
use Carbon\Carbon;

class HotelBookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing data
        $users = User::all();
        $hotelDetails = HotelDetail::all();
        $hotelRooms = HotelRoom::all();

        if ($users->isEmpty() || $hotelDetails->isEmpty() || $hotelRooms->isEmpty()) {
            $this->command->info('No users, hotels, or rooms found. Please seed them first.');
            return;
        }

        $statuses = ['pending', 'confirmed', 'cancelled'];

        // Create sample bookings
        for ($i = 0; $i < 20; $i++) {
            $user = $users->random();
            $hotelDetail = $hotelDetails->random();
            $hotelRoom = $hotelRooms->where('hotel_id', $hotelDetail->hotel_id)->random();

            if (!$hotelRoom) {
                continue;
            }

            $checkIn = Carbon::now()->addDays(rand(1, 30));
            $checkOut = $checkIn->copy()->addDays(rand(1, 7));
            $nights = $checkIn->diffInDays($checkOut);
            $totalPrice = $hotelRoom->price * $nights;

            HotelBooking::create([
                'hotel_id' => $hotelDetail->id,
                'room_id' => $hotelRoom->id,
                'user_id' => $user->id,
                'check_in' => $checkIn,
                'check_out' => $checkOut,
                'guests' => rand(1, $hotelRoom->capacity),
                'total_price' => $totalPrice,
                'status' => $statuses[array_rand($statuses)],
                'created_at' => Carbon::now()->subDays(rand(0, 30)),
                'updated_at' => Carbon::now()->subDays(rand(0, 5))
            ]);
        }

        $this->command->info('Hotel bookings seeded successfully.');
    }
}
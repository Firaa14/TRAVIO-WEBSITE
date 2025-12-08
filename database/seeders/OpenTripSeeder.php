<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OpenTrip;
use Carbon\Carbon;

class OpenTripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $openTrips = [
            [
                'title' => 'Bromo Sunrise Adventure',
                'location' => 'Mount Bromo, East Java',
                'description' => 'Experience the magical sunrise at Mount Bromo with our guided tour. Includes jeep ride, breakfast, and professional photographer.',
                'image' => 'photos/opentrip1.jpg',
                'price' => 450000,
                'start_date' => Carbon::now()->addDays(10),
                'end_date' => Carbon::now()->addDays(12),
                'duration_days' => 3,
                'max_participants' => 15,
                'current_participants' => 0,
                'facilities' => json_encode(['Transportation', 'Meals', 'Tour Guide', 'Entrance Tickets', 'Photography']),
                'itinerary' => json_encode([
                    'Day 1' => 'Departure from Malang - Arrive at Bromo area - Check-in hotel',
                    'Day 2' => 'Sunrise tour at Mount Bromo - Breakfast - Explore Savanna - Return to hotel',
                    'Day 3' => 'Breakfast - Free time - Return to Malang'
                ]),
                'meeting_point' => 'Alun-alun Malang',
                'meeting_time' => '05:00:00',
                'status' => 'available',
            ],
            [
                'title' => 'Bali Island Hopping',
                'location' => 'Bali',
                'description' => 'Explore the beautiful islands around Bali including Nusa Penida, Nusa Lembongan, and Nusa Ceningan.',
                'image' => 'photos/opentrip2.jpg',
                'price' => 850000,
                'start_date' => Carbon::now()->addDays(15),
                'end_date' => Carbon::now()->addDays(18),
                'duration_days' => 4,
                'max_participants' => 20,
                'current_participants' => 0,
                'facilities' => json_encode(['Fast Boat', 'Snorkeling Equipment', 'Meals', 'Tour Guide', 'Hotel']),
                'itinerary' => json_encode([
                    'Day 1' => 'Arrival - Hotel check-in - Free time',
                    'Day 2' => 'Nusa Penida tour - Kelingking Beach - Angel Billabong',
                    'Day 3' => 'Nusa Lembongan - Snorkeling - Beach activities',
                    'Day 4' => 'Breakfast - Return to Bali'
                ]),
                'meeting_point' => 'Sanur Beach Harbor',
                'meeting_time' => '07:00:00',
                'status' => 'available',
            ],
            [
                'title' => 'Ijen Blue Fire Expedition',
                'location' => 'Ijen Crater, East Java',
                'description' => 'Witness the rare blue fire phenomenon at Ijen Crater. An unforgettable trekking experience.',
                'image' => 'photos/opentrip3.jpg',
                'price' => 550000,
                'start_date' => Carbon::now()->addDays(20),
                'end_date' => Carbon::now()->addDays(22),
                'duration_days' => 3,
                'max_participants' => 12,
                'current_participants' => 0,
                'facilities' => json_encode(['Transportation', 'Gas Mask', 'Flashlight', 'Tour Guide', 'Meals', 'Hotel']),
                'itinerary' => json_encode([
                    'Day 1' => 'Departure - Arrive at Banyuwangi - Rest at hotel',
                    'Day 2' => 'Midnight trek to Ijen - Blue fire viewing - Sunrise at crater - Return to hotel',
                    'Day 3' => 'Breakfast - Return trip'
                ]),
                'meeting_point' => 'Malang Railway Station',
                'meeting_time' => '08:00:00',
                'status' => 'available',
            ],
            [
                'title' => 'Yogyakarta Cultural Heritage',
                'location' => 'Yogyakarta',
                'description' => 'Discover the rich cultural heritage of Yogyakarta visiting temples, palace, and traditional markets.',
                'image' => 'photos/opentrip4.jpg',
                'price' => 650000,
                'start_date' => Carbon::now()->addDays(25),
                'end_date' => Carbon::now()->addDays(27),
                'duration_days' => 3,
                'max_participants' => 18,
                'current_participants' => 0,
                'facilities' => json_encode(['AC Vehicle', 'Hotel', 'Meals', 'Tour Guide', 'Entrance Tickets']),
                'itinerary' => json_encode([
                    'Day 1' => 'Departure - Borobudur Temple - Hotel check-in',
                    'Day 2' => 'Prambanan Temple - Keraton - Malioboro shopping',
                    'Day 3' => 'Breakfast - Kotagede - Return trip'
                ]),
                'meeting_point' => 'Meeting point TBA',
                'meeting_time' => '06:00:00',
                'status' => 'available',
            ],
            [
                'title' => 'Raja Ampat Diving Paradise',
                'location' => 'Raja Ampat, Papua',
                'description' => 'Explore the underwater paradise of Raja Ampat with professional diving instructors.',
                'image' => 'photos/opentrip5.jpg',
                'price' => 2500000,
                'start_date' => Carbon::now()->addDays(30),
                'end_date' => Carbon::now()->addDays(35),
                'duration_days' => 6,
                'max_participants' => 10,
                'current_participants' => 0,
                'facilities' => json_encode(['Flight Tickets', 'Boat', 'Diving Equipment', 'Meals', 'Accommodation', 'Diving Instructor']),
                'itinerary' => json_encode([
                    'Day 1' => 'Flight to Sorong - Transfer to resort',
                    'Day 2-5' => 'Daily diving activities - Island hopping',
                    'Day 6' => 'Return to Sorong - Flight back'
                ]),
                'meeting_point' => 'Juanda Airport Surabaya',
                'meeting_time' => '05:00:00',
                'status' => 'available',
            ],
            [
                'title' => 'Komodo Island Explorer',
                'location' => 'Komodo National Park, NTT',
                'description' => 'Adventure to see Komodo dragons in their natural habitat and explore Pink Beach.',
                'image' => 'photos/opentrip6.jpg',
                'price' => 1800000,
                'start_date' => Carbon::now()->addDays(35),
                'end_date' => Carbon::now()->addDays(39),
                'duration_days' => 5,
                'max_participants' => 12,
                'current_participants' => 0,
                'facilities' => json_encode(['Flight Tickets', 'Boat', 'Snorkeling', 'Meals', 'Accommodation', 'Park Ranger']),
                'itinerary' => json_encode([
                    'Day 1' => 'Flight to Labuan Bajo - Hotel check-in',
                    'Day 2' => 'Komodo Island - See Komodo dragons',
                    'Day 3' => 'Pink Beach - Snorkeling',
                    'Day 4' => 'Padar Island trekking',
                    'Day 5' => 'Breakfast - Flight back'
                ]),
                'meeting_point' => 'Juanda Airport Surabaya',
                'meeting_time' => '06:00:00',
                'status' => 'available',
            ],
            [
                'title' => 'Lombok Beach Getaway',
                'location' => 'Lombok, NTB',
                'description' => 'Relax and enjoy the pristine beaches of Lombok with various water activities.',
                'image' => 'photos/opentrip7.jpg',
                'price' => 950000,
                'start_date' => Carbon::now()->addDays(40),
                'end_date' => Carbon::now()->addDays(43),
                'duration_days' => 4,
                'max_participants' => 16,
                'current_participants' => 0,
                'facilities' => json_encode(['Transportation', 'Hotel', 'Meals', 'Tour Guide', 'Water Activities']),
                'itinerary' => json_encode([
                    'Day 1' => 'Arrival - Hotel check-in - Free time',
                    'Day 2' => 'Gili Trawangan - Snorkeling',
                    'Day 3' => 'Pink Beach - Tanjung Aan Beach',
                    'Day 4' => 'Breakfast - Return trip'
                ]),
                'meeting_point' => 'Lombok Airport',
                'meeting_time' => '09:00:00',
                'status' => 'available',
            ],
            [
                'title' => 'Tana Toraja Cultural Tour',
                'location' => 'Tana Toraja, South Sulawesi',
                'description' => 'Experience the unique culture and traditions of Toraja people.',
                'image' => 'photos/opentrip8.jpg',
                'price' => 1200000,
                'start_date' => Carbon::now()->addDays(45),
                'end_date' => Carbon::now()->addDays(49),
                'duration_days' => 5,
                'max_participants' => 14,
                'current_participants' => 0,
                'facilities' => json_encode(['Flight Tickets', 'AC Vehicle', 'Hotel', 'Meals', 'Local Guide']),
                'itinerary' => json_encode([
                    'Day 1' => 'Flight to Makassar - Drive to Toraja',
                    'Day 2' => 'Visit traditional villages - Londa burial caves',
                    'Day 3' => 'Lemo burial site - Traditional ceremony (if available)',
                    'Day 4' => 'Local market - Batutumonga viewpoint',
                    'Day 5' => 'Return to Makassar - Flight back'
                ]),
                'meeting_point' => 'Hasanuddin Airport Makassar',
                'meeting_time' => '08:00:00',
                'status' => 'available',
            ],
        ];

        foreach ($openTrips as $trip) {
            OpenTrip::create($trip);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;
use App\Models\Destinasi;

class DestinationSeeder extends Seeder
{
    public function run(): void
    {
        // Get existing destinasi IDs
        $destinasiList = Destinasi::all();
        
        if ($destinasiList->isEmpty()) {
            $this->command->info('No destinasi found. Please run DestinasiSeeder first.');
            return;
        }

        // Clear existing destinations
        Destination::query()->delete();

        foreach ($destinasiList as $index => $destinasi) {
            $this->createDestinationData($destinasi, $index + 1);
        }
    }
    
    private function createDestinationData($destinasi, $index)
    {
        $destinasiId = $destinasi->id;
        
        // Create different data based on index/name
        $itinerary = [];
        $priceDetails = [];
        $location = '';
        $detail = $destinasi->description;
        
        switch($index) {
            case 1:
                $location = 'Malang, Lumajang';
                $detail = 'A breathtaking waterfall known as the most beautiful in Java, perfect for adventurers and nature lovers.';
                $itinerary = [
                    '05:30 – Depart from Malang (or nearby hotel)',
                    '07:30-08:00 – Arrive at Tumpak Sewu entrance area',
                    '08:00-09:00 – Orientation, ticket purchase, trek down',
                    '09:00-11:00 – Explore waterfall canyon, take photos',
                    '11:00-12:00 – Lunch break at local warung',
                    '12:00-13:00 – Return trek heading up',
                    '13:00-15:00 – Drive back to Malang',
                    '15:00 – Arrive back at accommodation'
                ];
                $priceDetails = [
                    'Entrance fee: ~ IDR 20,000 per person',
                    'Parking fee: Car ~ IDR 10,000, Motorbike ~ IDR 2,000',
                    'Private car + driver tour: IDR 450,000 – 525,000 per person',
                    'Combined tour (Tumpak Sewu + Bromo + Ijen): Starts at IDR 9,400,000 (for 2 pax)'
                ];
                break;
                
            case 2:
                $location = 'Probolinggo, East Java';
                $detail = 'Experience the magical sunrise over Mount Bromo, one of Indonesia\'s most iconic volcanic landscapes.';
                $itinerary = [
                    '02:00 – Pick up from hotel in Malang/Surabaya',
                    '04:00 – Arrive at Penanjakan viewpoint for sunrise',
                    '05:30-06:30 – Sunrise viewing and photography',
                    '07:00-08:00 – Breakfast at local restaurant',
                    '08:30-10:00 – Explore Bromo crater by jeep and horseback',
                    '10:30-11:30 – Visit Whispering Sand (Pasir Berbisik)',
                    '12:00-13:00 – Lunch at nearby restaurant',
                    '14:00 – Return journey to Malang/Surabaya'
                ];
                $priceDetails = [
                    'Entrance fee: IDR 34,000 per person (local), IDR 320,000 (foreign)',
                    'Jeep rental: IDR 600,000 - 800,000 per jeep (max 5 people)',
                    'Horse riding: IDR 150,000 - 200,000 per person',
                    'Private tour package: IDR 750,000 - 950,000 per person'
                ];
                break;
                
            case 3:
                $location = 'Banyuwangi, East Java';
                $detail = 'Witness the rare blue fire phenomenon and stunning turquoise crater lake at Ijen volcano.';
                $itinerary = [
                    '23:00 – Pick up from hotel in Banyuwangi',
                    '01:00 – Arrive at Ijen basecamp, registration',
                    '02:00-04:00 – Trek to Ijen crater (3km uphill)',
                    '04:00-05:30 – Blue fire observation (if conditions allow)',
                    '05:30-07:00 – Sunrise viewing over crater lake',
                    '07:00-08:30 – Explore crater rim and sulfur mining area',
                    '09:00-11:00 – Trek back to basecamp',
                    '12:00 – Return to hotel in Banyuwangi'
                ];
                $priceDetails = [
                    'Entrance fee: IDR 15,000 per person (weekday), IDR 20,000 (weekend)',
                    'Parking fee: IDR 5,000 per vehicle',
                    'Guide fee: IDR 300,000 - 400,000 per group',
                    'Private tour: IDR 850,000 - 1,200,000 per person'
                ];
                break;
                
            default:
                $location = 'Indonesia';
                $detail = $destinasi->description ?: 'Discover the beauty and wonder of this amazing destination.';
                $itinerary = [
                    'Day 1: Arrival and check-in',
                    'Day 2: Explore main attractions',
                    'Day 3: Cultural activities and local experiences',
                    'Day 4: Adventure activities',
                    'Day 5: Departure'
                ];
                $priceDetails = [
                    'Tour package: Starting from IDR 500,000 per person',
                    'Entrance fees: Varies by location',
                    'Transportation: Local transport included',
                    'Guide services: Professional local guides available'
                ];
                break;
        }

        Destination::create([
            'destinasi_id' => $destinasiId,
            'location' => $location,
            'detail' => $detail,
            'itinerary' => $itinerary,
            'price_details' => $priceDetails,
        ]);
        
        $this->command->info("Created destination data for: {$destinasi->name} (ID: {$destinasiId})");
    }
}

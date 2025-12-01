<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;

class DestinationSeeder extends Seeder
{
    public function run(): void
    {
        // Tumpak Sewu Waterfall
        $itinerary1 = [
            '05:30 – Depart from Malang (or nearby hotel)',
            '07:30-08:00 – Arrive at Tumpak Sewu entrance area',
            '08:00-09:00 – Orientation, ticket purchase, trek down',
            '09:00-11:00 – Explore waterfall canyon, take photos',
            '11:00-12:00 – Lunch break at local warung',
            '12:00-13:00 – Return trek heading up',
            '13:00-15:00 – Drive back to Malang',
            '15:00 – Arrive back at accommodation'
        ];

        $priceDetails1 = [
            'Entrance fee: ~ IDR 20,000 per person',
            'Parking fee: Car ~ IDR 10,000, Motorbike ~ IDR 2,000',
            'Private car + driver tour: IDR 450,000 – 525,000 per person',
            'Combined tour (Tumpak Sewu + Bromo + Ijen): Starts at IDR 9,400,000 (for 2 pax)'
        ];

        Destination::create([
            'destinasi_id' => 1, // Tumpak Sewu
            'location' => 'Malang, Lumajang',
            'detail' => 'A breathtaking waterfall known as the most beautiful in Java, perfect for adventurers and nature lovers.',
            'itinerary' => json_encode($itinerary1),
            'price_details' => json_encode($priceDetails1),
        ]);

        // Bromo Tengger Semeru
        $itinerary2 = [
            '02:00 – Pick up from hotel in Malang/Surabaya',
            '04:00 – Arrive at Penanjakan viewpoint for sunrise',
            '05:30-06:30 – Sunrise viewing and photography',
            '07:00-08:00 – Breakfast at local restaurant',
            '08:30-10:00 – Explore Bromo crater by jeep and horseback',
            '10:30-11:30 – Visit Whispering Sand (Pasir Berbisik)',
            '12:00-13:00 – Lunch at nearby restaurant',
            '14:00 – Return journey to Malang/Surabaya'
        ];

        $priceDetails2 = [
            'Entrance fee: IDR 34,000 per person (local), IDR 320,000 (foreign)',
            'Jeep rental: IDR 600,000 - 800,000 per jeep (max 5 people)',
            'Horse riding: IDR 150,000 - 200,000 per person',
            'Private tour package: IDR 750,000 - 950,000 per person'
        ];

        Destination::create([
            'destinasi_id' => 2, // Bromo
            'location' => 'Probolinggo, East Java',
            'detail' => 'Experience the magical sunrise over Mount Bromo, one of Indonesia\'s most iconic volcanic landscapes.',
            'itinerary' => json_encode($itinerary2),
            'price_details' => json_encode($priceDetails2),
        ]);

        // Ijen Crater
        $itinerary3 = [
            '23:00 – Pick up from hotel in Banyuwangi',
            '01:00 – Arrive at Ijen basecamp, registration',
            '02:00-04:00 – Trek to Ijen crater (3km uphill)',
            '04:00-05:30 – Blue fire observation (if conditions allow)',
            '05:30-07:00 – Sunrise viewing over crater lake',
            '07:00-08:30 – Explore crater rim and sulfur mining area',
            '09:00-11:00 – Trek back to basecamp',
            '12:00 – Return to hotel in Banyuwangi'
        ];

        $priceDetails3 = [
            'Entrance fee: IDR 15,000 per person (weekday), IDR 20,000 (weekend)',
            'Parking fee: IDR 5,000 per vehicle',
            'Guide fee: IDR 300,000 - 400,000 per group',
            'Private tour: IDR 850,000 - 1,200,000 per person'
        ];

        Destination::create([
            'destinasi_id' => 3, // Ijen
            'location' => 'Banyuwangi, East Java',
            'detail' => 'Witness the rare blue fire phenomenon and stunning turquoise crater lake at Ijen volcano.',
            'itinerary' => json_encode($itinerary3),
            'price_details' => json_encode($priceDetails3),
        ]);

        // Raja Ampat (if exists in destinasi table)
        $itinerary4 = [
            'Day 1: Arrival in Sorong, transfer to Waisai',
            'Day 2: Diving at Cape Kri and Sawandarek',
            'Day 3: Pianemo (Little Wayag) and Arborek Village',
            'Day 4: Wayag Island lagoons and mushroom rocks',
            'Day 5: Gam Island and hidden lagoons',
            'Day 6: Final diving session and return to Sorong'
        ];

        $priceDetails4 = [
            'Liveaboard 6D5N: USD 1,200 - 1,800 per person',
            'Marine park fee: IDR 1,000,000 per person',
            'Diving equipment rental: USD 35 per day',
            'Domestic flights: IDR 3,500,000 - 5,000,000'
        ];

        // Only create if destinasi_id 4 exists
        if (\App\Models\Destinasi::find(4)) {
            Destination::create([
                'destinasi_id' => 4,
                'location' => 'West Papua',
                'detail' => 'Explore the world\'s richest marine biodiversity in the pristine waters of Raja Ampat.',
                'itinerary' => json_encode($itinerary4),
                'price_details' => json_encode($priceDetails4),
            ]);
        }
    }
}

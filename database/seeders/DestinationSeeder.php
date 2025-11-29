<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;

class DestinationSeeder extends Seeder
{
    public function run(): void
    {
        // Itinerary (array → JSON)
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

        // Price details (array → JSON)
        $priceDetails = [
            'Entrance fee: ~ IDR 20,000 per person',
            'Parking fee: Car ~ IDR 10,000, Motorbike ~ IDR 2,000',
            'Private car + driver tour: IDR 450,000 – 525,000 per person',
            'Combined tour (Tumpak Sewu + Bromo + Ijen): Starts at IDR 9,400,000 (for 2 pax)'
        ];

        Destination::create([
            'destinasi_id' => 1, // harus sudah ada di tabel destinasi
            'location' => 'Malang, Lumajang',
            'detail' => 'A breathtaking waterfall known as the most beautiful in Java, perfect for adventurers and nature lovers.',
            'itinerary' => json_encode($itinerary),
            'price_details' => json_encode($priceDetails),
        ]);
    }
}

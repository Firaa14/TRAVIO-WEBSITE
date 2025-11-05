<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function show($id, $tab = 'details')
    {
        // contoh data destinasi
        $destination = [
            'id' => $id,
            'name' => 'Tumpak Sewu Waterfall',
            'location' => 'Malang, Lumajang',
            'image' => '/photos/destination1.jpg',
            'description' => 'Tumpak Sewu Waterfall, often called the Niagara of Indonesia, is located on the border between Malang and Lumajang, East Java. Standing about 120 meters tall, the waterfall features a stunning curtain-like flow surrounded by lush green cliffs, creating a breathtaking natural panorama.

Reaching the base of the waterfall requires an adventurous trek through rocky paths, bamboo stairs, and small streams. Although the journey can be challenging, every step is rewarded with the sight of majestic cascades and the refreshing mist of the falls below.

Tumpak Sewu is a favorite destination for nature lovers, photographers, and adventure seekers who wish to experience the raw beauty of East Java. The sound of thundering water and the cool mountain air make it a truly serene and mesmerizing escape from the bustle of city life.',
            'itinerary' => [
                '05:30 – Depart from Malang (or nearby hotel)',
                '07:30-08:00 – Arrive at parking/entrance area of Tumpak Sewu (Sidomulyo Village, Pronojiwo, Lumajang)',
                '08:00-09:00 – Orientation, purchase tickets, trek from viewpoint down (or explore from the top)',
                '09:00-11:00 – Explore the waterfall canyon, take photos, possibly descend to base if fit enough',
                '11:00-12:00 – Light lunch (bring your own or stop at a local warung)',
                '12:00-13:00 – Head back up/return trek, exit the area',
                '13:00-15:00 – Drive back to Malang or your accommodation',
                '15:00 – Arrive back, rest or continue with other activities'
            ],
            'price' => [
                'Entrance fee: ~ IDR 20,000 per person for the viewpoint area.',
                'Parking & additional fees: e.g., car parking ~ IDR 10,000, motorbike ~ IDR 2,000.',
                'Transport from Malang (private car + driver) + guide: Many tours list ≈ IDR 450,000 – 525,000 per person for the day trip from Malang.',
                'Multi-day / combined tours (with other sites) obviously cost much more.',
                'Including Tumpak Sewu, Bromo, Ijen starting at ~ IDR 9,400,000 for two people.'
            ]
        ];

        $activeTab = $tab;
        return view('destination.show', compact('destination', 'activeTab'));
    }
}

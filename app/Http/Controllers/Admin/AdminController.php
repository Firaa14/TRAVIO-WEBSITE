<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarBooking;
use App\Models\DestinationBooking;
use App\Models\HotelBooking;
use App\Models\PackageBooking;
use App\Models\PlanningBooking;
use App\Models\OpenTripBooking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Ambil data analitik booking
        $bookingStats = [
            'car_bookings' => [
                'total' => CarBooking::count(),
                'pending' => CarBooking::where('status', 'pending')->count(),
                'confirmed' => CarBooking::where('status', 'confirmed')->count(),
                'cancelled' => CarBooking::where('status', 'cancelled')->count(),
                'today' => CarBooking::whereDate('created_at', Carbon::today())->count(),
            ],
            'destination_bookings' => [
                'total' => DestinationBooking::count(),
                'pending' => DestinationBooking::where('status', 'pending')->count(),
                'confirmed' => DestinationBooking::where('status', 'confirmed')->count(),
                'cancelled' => DestinationBooking::where('status', 'cancelled')->count(),
                'today' => DestinationBooking::whereDate('created_at', Carbon::today())->count(),
            ],
            'hotel_bookings' => [
                'total' => HotelBooking::count(),
                'pending' => HotelBooking::where('status', 'pending')->count(),
                'confirmed' => HotelBooking::where('status', 'confirmed')->count(),
                'cancelled' => HotelBooking::where('status', 'cancelled')->count(),
                'today' => HotelBooking::whereDate('created_at', Carbon::today())->count(),
            ],
            'package_bookings' => [
                'total' => PackageBooking::count(),
                'pending' => PackageBooking::where('status', 'pending')->count(),
                'confirmed' => PackageBooking::where('status', 'confirmed')->count(),
                'cancelled' => PackageBooking::where('status', 'cancelled')->count(),
                'today' => PackageBooking::whereDate('created_at', Carbon::today())->count(),
            ],
        ];

        // Booking terbaru
        $recentBookings = [
            'car' => CarBooking::with('user', 'car')->latest()->take(5)->get(),
            'destination' => DestinationBooking::with('user', 'destination')->latest()->take(5)->get(),
            'hotel' => HotelBooking::with('user', 'hotelDetail', 'hotelRoom')->latest()->take(5)->get(),
            'package' => PackageBooking::with('user', 'package')->latest()->take(5)->get(),
        ];

        // Total revenue (approximate)
        $revenue = [
            'car' => CarBooking::where('status', 'confirmed')->sum('total_price'),
            'destination' => DestinationBooking::where('status', 'confirmed')->sum('total_price'),
            'hotel' => HotelBooking::where('status', 'confirmed')->sum('total_price'),
            'package' => PackageBooking::where('status', 'confirmed')->sum('total_price'),
        ];

        return view('admin.dashboard', compact('bookingStats', 'recentBookings', 'revenue'));
    }
}
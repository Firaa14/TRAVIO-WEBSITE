<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarBooking;
use App\Models\DestinationBooking;
use App\Models\HotelBooking;
use App\Models\PackageBooking;
use App\Models\Car;
use App\Models\Hotel;
use App\Models\Package;
use App\Models\Destinasi;
use App\Models\Destination;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        try {
            // Data dasar untuk statistik
            $stats = [
                'cars' => Car::count(),
                'hotels' => Hotel::count(), 
                'packages' => Package::count(),
                'destinasi' => Destinasi::count(),
                'destinations' => Destination::count(),
            ];

            // Booking stats with error handling
            $bookingStats = [
                'car_bookings' => [
                    'total' => CarBooking::count() ?? 0,
                    'pending' => CarBooking::where('status', 'pending')->count() ?? 0,
                    'confirmed' => CarBooking::where('status', 'confirmed')->count() ?? 0,
                    'cancelled' => CarBooking::where('status', 'cancelled')->count() ?? 0,
                    'today' => CarBooking::whereDate('created_at', Carbon::today())->count() ?? 0,
                ],
                'destination_bookings' => [
                    'total' => DestinationBooking::count() ?? 0,
                    'pending' => DestinationBooking::where('status', 'pending')->count() ?? 0,
                    'confirmed' => DestinationBooking::where('status', 'confirmed')->count() ?? 0,
                    'cancelled' => DestinationBooking::where('status', 'cancelled')->count() ?? 0,
                    'today' => DestinationBooking::whereDate('created_at', Carbon::today())->count() ?? 0,
                ],
                'hotel_bookings' => [
                    'total' => HotelBooking::count() ?? 0,
                    'pending' => HotelBooking::where('status', 'pending')->count() ?? 0,
                    'confirmed' => HotelBooking::where('status', 'confirmed')->count() ?? 0,
                    'cancelled' => HotelBooking::where('status', 'cancelled')->count() ?? 0,
                    'today' => HotelBooking::whereDate('created_at', Carbon::today())->count() ?? 0,
                ],
                'package_bookings' => [
                    'total' => PackageBooking::count() ?? 0,
                    'pending' => PackageBooking::where('status', 'pending')->count() ?? 0,
                    'confirmed' => PackageBooking::where('status', 'confirmed')->count() ?? 0,
                    'cancelled' => PackageBooking::where('status', 'cancelled')->count() ?? 0,
                    'today' => PackageBooking::whereDate('created_at', Carbon::today())->count() ?? 0,
                ],
            ];

            // Recent bookings with safe loading
            $recentBookings = [
                'car' => CarBooking::with(['user', 'car'])->latest()->take(5)->get(),
                'destination' => DestinationBooking::with(['user', 'destination'])->latest()->take(5)->get(),
                'hotel' => HotelBooking::latest()->take(5)->get(), // Simplified to avoid relation errors
                'package' => PackageBooking::with(['user', 'package'])->latest()->take(5)->get(),
            ];

            // Total revenue
            $revenue = [
                'car' => CarBooking::where('status', 'confirmed')->sum('total_price') ?? 0,
                'destination' => DestinationBooking::where('status', 'confirmed')->sum('total_price') ?? 0,
                'hotel' => HotelBooking::where('status', 'confirmed')->sum('total_price') ?? 0,
                'package' => PackageBooking::where('status', 'confirmed')->sum('total_price') ?? 0,
            ];

            return view('admin.dashboard', compact('stats', 'bookingStats', 'recentBookings', 'revenue'));
            
        } catch (\Exception $e) {
            // Fallback dashboard if there are database issues
            $stats = [
                'cars' => 0,
                'hotels' => 0, 
                'packages' => 0,
                'destinasi' => 0,
                'destinations' => 0,
            ];

            $bookingStats = [
                'car_bookings' => ['total' => 0, 'pending' => 0, 'confirmed' => 0, 'cancelled' => 0, 'today' => 0],
                'destination_bookings' => ['total' => 0, 'pending' => 0, 'confirmed' => 0, 'cancelled' => 0, 'today' => 0],
                'hotel_bookings' => ['total' => 0, 'pending' => 0, 'confirmed' => 0, 'cancelled' => 0, 'today' => 0],
                'package_bookings' => ['total' => 0, 'pending' => 0, 'confirmed' => 0, 'cancelled' => 0, 'today' => 0],
            ];

            $recentBookings = ['car' => collect(), 'destination' => collect(), 'hotel' => collect(), 'package' => collect()];
            $revenue = ['car' => 0, 'destination' => 0, 'hotel' => 0, 'package' => 0];

            return view('admin.dashboard', compact('stats', 'bookingStats', 'recentBookings', 'revenue'));
        }
    }
}
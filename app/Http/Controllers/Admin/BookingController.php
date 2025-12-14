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

class BookingController extends Controller
{
    public function index()
    {
        // Get all bookings from different tables
        $allBookings = collect();

        // Car bookings
        $carBookings = CarBooking::with('user', 'car')->get()->map(function ($booking) {
            $booking->type = 'car';
            $booking->item_name = $booking->car->title ?? 'N/A';
            return $booking;
        });

        // Destination bookings
        $destinationBookings = DestinationBooking::with('user', 'destination')->get()->map(function ($booking) {
            $booking->type = 'destination';
            $booking->item_name = $booking->destination->name ?? 'N/A';
            return $booking;
        });

        // Hotel bookings
        $hotelBookings = HotelBooking::with('user', 'hotelDetail', 'hotelRoom')->get()->map(function ($booking) {
            $booking->type = 'hotel';
            $booking->item_name = $booking->hotelDetail->name ?? 'N/A';
            return $booking;
        });

        // Package bookings
        $packageBookings = PackageBooking::with('user', 'package')->get()->map(function ($booking) {
            $booking->type = 'package';
            $booking->item_name = $booking->package->name ?? 'N/A';
            return $booking;
        });

        // Combine all bookings
        $allBookings = $allBookings->merge($carBookings)
                                  ->merge($destinationBookings)
                                  ->merge($hotelBookings)
                                  ->merge($packageBookings)
                                  ->sortByDesc('created_at');

        return view('admin.bookings.index', compact('allBookings'));
    }

    public function carBookings()
    {
        $bookings = CarBooking::with('user', 'car')->latest()->paginate(15);
        return view('admin.bookings.car', compact('bookings'));
    }

    public function destinationBookings()
    {
        $bookings = DestinationBooking::with('user', 'destination')->latest()->paginate(15);
        return view('admin.bookings.destination', compact('bookings'));
    }

    public function hotelBookings()
    {
        $bookings = HotelBooking::with('user', 'hotelDetail', 'hotelRoom')->latest()->paginate(15);
        return view('admin.bookings.hotel', compact('bookings'));
    }

    public function packageBookings()
    {
        $bookings = PackageBooking::with('user', 'package')->latest()->paginate(15);
        return view('admin.bookings.package', compact('bookings'));
    }

    public function destinasiBookings()
    {
        // Booking destinasi menggunakan model Destinasi yang berbeda
        // Jika belum ada booking model untuk destinasi, gunakan placeholder
        $bookings = collect(); // Placeholder sampai ada model booking destinasi
        return view('admin.bookings.destinasi', compact('bookings'));
    }

    public function updateStatus(Request $request, $type, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled'
        ]);

        $booking = null;

        switch ($type) {
            case 'car':
                $booking = CarBooking::findOrFail($id);
                break;
            case 'destination':
                $booking = DestinationBooking::findOrFail($id);
                break;
            case 'hotel':
                $booking = HotelBooking::findOrFail($id);
                break;
            case 'package':
                $booking = PackageBooking::findOrFail($id);
                break;
            default:
                return response()->json(['error' => 'Invalid booking type'], 400);
        }

        if ($booking) {
            $oldStatus = $booking->status;
            $booking->status = $request->status;
            $booking->save();

            return response()->json([
                'success' => true,
                'message' => "Status booking {$type} berhasil diubah dari {$oldStatus} ke {$request->status}",
                'new_status' => $request->status
            ]);
        }

        return response()->json(['error' => 'Booking not found'], 404);
    }
}
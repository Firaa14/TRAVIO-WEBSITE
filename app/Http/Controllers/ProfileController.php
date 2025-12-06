<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\OpenTripBooking;
use App\Models\DestinationBooking;
use App\Models\HotelBooking;
use App\Models\CarBooking;
use App\Models\PackageBooking;
use Dompdf\Dompdf;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        // Fetch all bookings for the user
        $openTripBookings = OpenTripBooking::where('user_id', $user->id)
            ->latest()
            ->get()
            ->map(function ($booking) {
                return [
                    'type' => 'Open Trip',
                    'title' => $booking->trip_title,
                    'location' => $booking->trip_location,
                    'date' => $booking->created_at->format('d M Y'),
                    'status' => ucfirst($booking->status),
                    'price' => $booking->total_price,
                    'details' => "Schedule: {$booking->trip_schedule}, Participants: {$booking->participants}",
                ];
            });

        $destinationBookings = DestinationBooking::where('user_id', $user->id)
            ->latest()
            ->get()
            ->map(function ($booking) {
                return [
                    'type' => 'Destination',
                    'title' => $booking->destination->name ?? 'Destination Booking',
                    'location' => $booking->destination->location ?? 'N/A',
                    'date' => $booking->created_at->format('d M Y'),
                    'status' => ucfirst($booking->status),
                    'price' => $booking->total_price,
                    'details' => "Guests: {$booking->guests}",
                ];
            });

        $hotelBookings = HotelBooking::where('user_id', $user->id)
            ->latest()
            ->get()
            ->map(function ($booking) {
                return [
                    'type' => 'Hotel',
                    'title' => $booking->hotel->name ?? 'Hotel Booking',
                    'location' => $booking->hotel->location ?? 'N/A',
                    'date' => $booking->created_at->format('d M Y'),
                    'status' => ucfirst($booking->status),
                    'price' => $booking->total_price,
                    'details' => "Check-in: {$booking->check_in_date}, Check-out: {$booking->check_out_date}",
                ];
            });

        $carBookings = CarBooking::where('user_id', $user->id)
            ->latest()
            ->get()
            ->map(function ($booking) {
                return [
                    'type' => 'Car Rental',
                    'title' => $booking->car->name ?? 'Car Booking',
                    'location' => $booking->pickup_location ?? 'N/A',
                    'date' => $booking->created_at->format('d M Y'),
                    'status' => ucfirst($booking->status),
                    'price' => $booking->total_price,
                    'details' => "Duration: {$booking->rental_days} days",
                ];
            });

        $packageBookings = PackageBooking::where('user_id', $user->id)
            ->latest()
            ->get()
            ->map(function ($booking) {
                return [
                    'type' => 'Package',
                    'title' => $booking->package->name ?? 'Package Booking',
                    'location' => $booking->package->destination ?? 'N/A',
                    'date' => $booking->created_at->format('d M Y'),
                    'status' => ucfirst($booking->status),
                    'price' => $booking->total_price,
                    'details' => "Participants: {$booking->participants}",
                ];
            });

        // Merge all bookings and sort by date
        $bookings = collect()
            ->merge($openTripBookings)
            ->merge($destinationBookings)
            ->merge($hotelBookings)
            ->merge($carBookings)
            ->merge($packageBookings)
            ->sortByDesc('date');

        return view('profile', compact('user', 'bookings'));
    }

    public function update(Request $request)
    {
        // ...existing code...
        $validated = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'nullable|min:10',
            'password' => 'nullable|min:6',
        ]);

        // Simulasikan update (biasanya pakai auth()->user()->update($validated))
        return back()->with('success', 'Profile updated successfully!');
    }

    public function upload(Request $request)
    {
        // ...existing code...
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simulasi upload file (bisa diganti dengan logic storage asli)
        return back()->with('success', 'Profile photo updated successfully!');
    }

    // PDF Booking History
    public function bookingsPdf()
    {
        $user = (object) [
            'name' => 'Syafira Nuzulla',
            'username' => 'syafira',
            'email' => 'syafira@gmail.com',
            'phone' => '0812 3456 1234',
        ];
        $bookings = [
            ['title' => 'Mountain Trip', 'location' => 'Bromo National Park', 'date' => 'Completed on 2025-09-10', 'status' => 'Completed'],
            ['title' => 'Beach Holiday', 'location' => 'Batu Beach', 'date' => 'Completed on 2025-10-05', 'status' => 'Completed'],
        ];

        $pdfHtml = view('pdf.booking-history', compact('user', 'bookings'))->render();

        // Gunakan dompdf
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($pdfHtml);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return response($dompdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="booking-history.pdf"');
    }
}

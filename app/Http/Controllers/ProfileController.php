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
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|min:3|max:255',
            'username' => 'nullable|min:3|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|min:10|max:20',
            'password' => 'nullable|min:6|confirmed',
        ]);

        // Update user data
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['username'])) {
            $user->username = $validated['username'];
        }

        if (!empty($validated['phone'])) {
            $user->phone = $validated['phone'];
        }

        // Only update password if provided
        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }

    public function upload(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->photo && file_exists(public_path($user->photo))) {
                unlink(public_path($user->photo));
            }

            // Store new photo
            $file = $request->file('photo');
            $filename = 'profile_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('photos/profiles'), $filename);

            // Update user photo path
            $user->photo = '/photos/profiles/' . $filename;
            $user->save();
        }

        return back()->with('success', 'Profile photo updated successfully!');
    }

    // PDF Booking History
    public function bookingsPdf()
    {
        $user = Auth::user();

        // Fetch all bookings for the user (same logic as show method)
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
            ->sortByDesc('date')
            ->values();

        $pdfHtml = view('pdf.booking-history', compact('user', 'bookings'))->render();

        // Gunakan dompdf
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($pdfHtml);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $filename = 'booking-history-' . $user->name . '-' . date('Y-m-d') . '.pdf';

        return response($dompdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}

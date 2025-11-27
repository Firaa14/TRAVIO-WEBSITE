<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;

class ProfileController extends Controller
{
    public function show()
    {
        // ...existing code...
        $user = (object) [
            'name' => 'Syafira Nuzulla',
            'username' => 'syafira',
            'email' => 'syafira@gmail.com',
            'phone' => '0812 3456 1234',
            'photo' => '/images/user1.jpg',
            'points' => 2500,
            'points_expiry' => '2025-12-31',
        ];

        $bookings = [
            ['title' => 'Mountain Trip', 'location' => 'Bromo National Park', 'date' => 'Completed on 2025-09-10', 'status' => 'Completed'],
            ['title' => 'Beach Holiday', 'location' => 'Batu Beach', 'date' => 'Completed on 2025-10-05', 'status' => 'Completed'],
        ];

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

<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Destination;
use App\Models\Hotel;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlanningController extends Controller
{
    /**
     * Show planning form
     */
    public function index()
    {
        // Get destinations with destinasi relation - mengambil data dari tabel destinasi yang memiliki nama, gambar, dan harga
        $destinations = \App\Models\Destinasi::latest()->get()->map(function($destinasi) {
            return [
                'id' => $destinasi->id,
                'name' => $destinasi->name,
                'location' => substr($destinasi->description, 0, 50) . '...', // Use truncated description as location
                'description' => $destinasi->description,
                'image' => $destinasi->image ? asset('photos/' . $destinasi->image) : asset('photos/destination1.jpg'), // Construct proper path to photos directory
                'price' => $destinasi->price ?? 0,
            ];
        })->toArray();
        
        // Get hotels with proper field mapping
        $hotels = Hotel::all()->map(function($hotel) {
            // Extract numeric price from string format "Rp 850,000 / night"
            $price = 0;
            if (is_numeric($hotel->price)) {
                $price = (float)$hotel->price;
            } else {
                // Extract numbers from string like "Rp 850,000 / night"
                preg_match('/[\d.,]+/', $hotel->price, $matches);
                if (!empty($matches[0])) {
                    $price = (float)str_replace([',', '.'], '', $matches[0]);
                }
            }
            
            return [
                'id' => $hotel->id,
                'name' => $hotel->title, // Use title field as name
                'title' => $hotel->title,
                'location' => $hotel->location,
                'description' => $hotel->description,
                'image' => $hotel->image ? asset($hotel->image) : asset('photos/hotel1.jpg'), // Use direct asset path
                'price' => $price,
                'facilities' => $hotel->facilities,
            ];
        })->toArray();
        
        // Get cars with proper field mapping
        $cars = Car::all()->map(function($car) {
            // Extract numeric price from string format if needed
            $price = 0;
            if (is_numeric($car->price)) {
                $price = (float)$car->price;
            } else {
                // Extract numbers from string format
                preg_match('/[\d.,]+/', $car->price, $matches);
                if (!empty($matches[0])) {
                    $price = (float)str_replace([',', '.'], '', $matches[0]);
                }
            }
            
            return [
                'id' => $car->id,
                'title' => $car->title,
                'brand' => $car->brand,
                'model' => $car->model,
                'description' => $car->description,
                'image' => $car->image ? asset($car->image) : asset('photos/car1.jpg'), // Use direct asset path
                'price' => $price,
                'capacity' => $car->capacity,
                'transmission' => $car->transmission,
                'fuel_type' => $car->fuel_type,
                'facilities' => $car->facilities,
            ];
        })->toArray();

        // Ambil daftar kamar untuk setiap hotel
        $hotelRooms = [];
        foreach ($hotels as $hotel) {
            $hotelRooms[$hotel['id']] = \App\Models\HotelRoom::where('hotel_id', $hotel['id'])->get()->toArray();
        }

        return view('planning', compact('destinations', 'hotels', 'cars', 'hotelRooms'));
    }

    /**
     * Calculate and prepare checkout
     */
    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'leaving_date' => 'required|date|after_or_equal:today',
            'return_date' => 'required|date|after: leaving_date',
            'selected_destinations' => 'required|string',
            'selected_hotel_room' => 'required|json',
            'selected_cars' => 'nullable|string',
            'adults' => 'required|integer|min:1',
            'children' => 'nullable|integer|min:0',
            'special_needs' => 'nullable|integer|min:0'
        ]);

        // Parse data
        $leavingDate = new \DateTime($validated['leaving_date']);
        $returnDate = new \DateTime($validated['return_date']);
        $days = $returnDate->diff($leavingDate)->days;

        $destinationIds = array_filter(explode(',', $validated['selected_destinations']));
        $hotelRoom = null;
        $hotelRoomData = json_decode($validated['selected_hotel_room'], true);
        if (isset($hotelRoomData['room_id'])) {
            $room = \App\Models\HotelRoom::find($hotelRoomData['room_id']);
            if ($room) {
                $hotel = \App\Models\Hotel::find($room->hotel_id);
                $hotelRoom = [
                    'id' => $room->id,
                    'hotel_id' => $room->hotel_id,
                    'hotel_name' => $hotel ? $hotel->title : '', // Use 'title' field from hotels table
                    'hotel_location' => $hotel ? $hotel->location : '',
                    'name' => $room->name,
                    'description' => $room->description,
                    'facilities' => $room->facilities,
                    'price' => $room->price,
                    'max_guest' => $room->max_guest,
                    'bed_type' => $room->bed_type,
                    'room_size' => $room->room_size,
                    'image' => $room->image,
                    'status' => $room->status,
                ];
            }
        }
        $carIds = array_filter(explode(',', $validated['selected_cars'] ?? ''));

        // Get destination details with destinasi relation
        $destinations = Destination::with('destinasi')->whereIn('id', $destinationIds)->get()->map(function($destination) {
            return [
                'id' => $destination->id,
                'destinasi_id' => $destination->destinasi_id,
                'location' => $destination->location,
                'detail' => $destination->detail,
                'itinerary' => $destination->itinerary,
                'price_details' => $destination->price_details,
                'destinasi' => $destination->destinasi ? [
                    'id' => $destination->destinasi->id,
                    'name' => $destination->destinasi->name,
                    'description' => $destination->destinasi->description,
                    'image' => $destination->destinasi->image,
                    'price' => $destination->destinasi->price,
                ] : null
            ];
        })->toArray();

        // Get hotel details with better error handling
        $hotelData = null;
        if ($hotelRoom) {
            $hotel = \App\Models\Hotel::find($hotelRoom['hotel_id']);
            $hotelData = [
                'id' => $hotelRoom['id'],
                'hotel_id' => $hotelRoom['hotel_id'],
                'hotel_name' => $hotel ? $hotel->title : 'Unknown Hotel',
                'hotel_location' => $hotel ? $hotel->location : '',
                'name' => $hotelRoom['name'],
                'description' => $hotelRoom['description'],
                'facilities' => $hotelRoom['facilities'],
                'price' => $hotelRoom['price'],
                'max_guest' => $hotelRoom['max_guest'],
                'bed_type' => $hotelRoom['bed_type'],
                'room_size' => $hotelRoom['room_size'],
                'image' => $hotelRoom['image'],
                'status' => $hotelRoom['status'],
            ];
        }

        // Get car details with proper field mapping
        $cars = Car::whereIn('id', $carIds)->get()->map(function($car) {
            // Extract numeric price from string format if needed
            $price = 0;
            if (is_numeric($car->price)) {
                $price = (float)$car->price;
            } else {
                // Extract numbers from string format
                preg_match('/[\d.,]+/', $car->price, $matches);
                if (!empty($matches[0])) {
                    $price = (float)str_replace([',', '.'], '', $matches[0]);
                }
            }
            
            return [
                'id' => $car->id,
                'title' => $car->title,
                'brand' => $car->brand,
                'model' => $car->model,
                'year' => $car->year,
                'transmission' => $car->transmission,
                'fuel_type' => $car->fuel_type,
                'capacity' => $car->capacity,
                'color' => $car->color,
                'license_plate' => $car->license_plate,
                'price' => $price,
                'description' => $car->description,
                'location' => $car->location,
                'image' => $car->image,
                'interior_image' => $car->interior_image,
                'facilities' => $car->facilities,
            ];
        })->toArray();

        // Calculate totals with proper price handling
        $destinationTotal = collect($destinations)->sum(function($dest) {
            return $dest['destinasi']['price'] ?? 0;
        });
        $hotelTotal = ($hotelData['price'] ?? 0) * $days;
        $carTotal = collect($cars)->sum(function($car) use ($days) {
            return $car['price'] * $days;
        });

        $totalPrice = $destinationTotal + $hotelTotal + $carTotal;

        // Prepare checkout data
        $checkoutData = [
            'leaving_date' => $validated['leaving_date'],
            'return_date' => $validated['return_date'],
            'days' => $days,
            'guests' => $validated['adults'] + ($validated['children'] ?? 0) + ($validated['special_needs'] ?? 0),
            'adults' => $validated['adults'],
            'children' => $validated['children'] ?? 0,
            'special_needs' => $validated['special_needs'] ?? 0,
            'destinations' => $destinations,
            'hotel' => $hotelData,
            'cars' => $cars,
            'pricing' => [
                'destination_total' => $destinationTotal,
                'hotel_total' => $hotelTotal,
                'car_total' => $carTotal,
                'grand_total' => $totalPrice
            ]
        ];

        // session(['planningData' => $checkoutData]);
        session(['planningData' => $checkoutData]);

        // return redirect()->route('checkout.show');
        return redirect()->route('checkout.planning');
    }

    /**
     * Show checkout form
     */
    public function showCheckout()
    {
        $checkoutData = session('planningData');

        if (!$checkoutData) {
            return redirect()->route('planning')->with('error', 'Session expired.  Please plan your trip again.');
        }

        $userData = [
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'phone' => auth()->user()->phone ?? ''
        ];

        return view('checkout.planning', compact('checkoutData', 'userData'));
    }

    /**
     * Submit checkout and save booking
     */
    public function submitCheckout(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:100',
            'gender' => 'required|in:male,female',
            'dob' => 'required|date|before:today',
            'address' => 'required|string|max:500',
            'guests' => 'required|integer|min:1',
            'emergency_name' => 'required|string|max:100',
            'emergency_phone' => 'required|string|max:20',
            'payment_method' => 'required|in:bank_transfer,qris,e_wallet',
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120'
        ]);

        $checkoutData = session('planningData');

        if (!$checkoutData) {
            return redirect()->route('planning')->with('error', 'Session expired. Please plan your trip again.');
        }

        // Upload payment proof
        $proofPath = null;
        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $filename = 'payment_' . time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $proofPath = $file->storeAs('payment_proofs', $filename, 'public');
        }

        // Create booking
        $booking = Booking::create([
            'user_id' => auth()->id(),
            'booking_code' => 'BK' . strtoupper(Str::random(8)) . time(),
            'full_name' => $validated['full_name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'gender' => $validated['gender'],
            'dob' => $validated['dob'],
            'address' => $validated['address'],
            'guests' => $validated['guests'],
            'emergency_name' => $validated['emergency_name'],
            'emergency_phone' => $validated['emergency_phone'],
            'payment_method' => $validated['payment_method'],
            'payment_proof' => $proofPath,
            'start_date' => $checkoutData['leaving_date'],
            'end_date' => $checkoutData['return_date'],
            'total_price' => $checkoutData['pricing']['grand_total'],
            'item_data' => json_encode([
                'destinations' => $checkoutData['destinations'],
                'hotel' => $checkoutData['hotel'],
                'cars' => $checkoutData['cars'],
                'days' => $checkoutData['days'],
                'guests' => $checkoutData['guests']
            ]),
            'status' => 'pending',
            'payment_status' => 'pending'
        ]);

        // Clear session
        session()->forget('planningData');

        return redirect()->route('booking.success', $booking->id)->with('success', 'Booking submitted successfully!');
    }

    /**
     * Show booking success page
     */
    public function bookingSuccess(Booking $booking)
    {
        // Ensure user can only view their own booking
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $booking->item_data = json_decode($booking->item_data, true);
        $booking->formatted_price = 'Rp' . number_format($booking->total_price, 0, ',', '.');

        return view('checkout.success', compact('booking'));
    }

    /**
     * Generate invoice PDF or view
     */
    public function generateInvoice(Booking $booking)
    {
        // Ensure user can only view their own invoice
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $booking->item_data = json_decode($booking->item_data, true);
        $booking->formatted_price = 'Rp' . number_format($booking->total_price, 0, ',', '.');

        $startDate = \DateTime::createFromFormat('Y-m-d', $booking->start_date);
        $endDate = \DateTime::createFromFormat('Y-m-d', $booking->end_date);
        $booking->formatted_start = $startDate->format('d M Y');
        $booking->formatted_end = $endDate->format('d M Y');

        return view('checkout.invoice', compact('booking'));
    }

    /**
     * Get hotel rooms by hotel ID
     */
    public function getHotelRooms($hotelId)
    {
        $rooms = \App\Models\HotelRoom::where('hotel_id', $hotelId)
            ->select('id', 'name', 'description', 'facilities', 'price', 'max_guest', 'bed_type', 'room_size', 'image', 'status')
            ->get();
        return response()->json($rooms);
    }
}
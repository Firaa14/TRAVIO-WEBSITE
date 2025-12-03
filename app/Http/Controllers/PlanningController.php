<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Destination;
use App\Models\Hotel;
use App\Models\HotelRoom;
use App\Models\Car;
use Illuminate\Support\Facades\DB;

class PlanningController extends Controller
{
    public function index()
    {
        // Get real data from database
        $destinations = Destination::with('destinasi')
            ->limit(10)
            ->get()
            ->map(function ($destination) {
                return [
                    'id' => $destination->id,
                    'name' => $destination->destinasi->name ?? 'Unknown Destination',
                    'location' => $destination->location,
                    'price' => $destination->destinasi->price ?? 0,
                    'description' => $destination->destinasi->description ?? '',
                    'image' => $destination->destinasi->image ? asset('storage/' . $destination->destinasi->image) : asset('photos/destination1.jpg')
                ];
            });

        $hotels = Hotel::select('id', 'title', 'location', 'price', 'description', 'image')
            ->limit(10)
            ->get()
            ->map(function ($hotel) {
                return [
                    'id' => $hotel->id,
                    'name' => $hotel->title,
                    'location' => $hotel->location,
                    'price' => is_numeric($hotel->price) ? $hotel->price : 0,
                    'description' => $hotel->description,
                    'image' => $hotel->image ? asset('storage/' . $hotel->image) : asset('photos/hotel1.jpg')
                ];
            });

        $cars = Car::select('id', 'title', 'price', 'description', 'image')
            ->limit(10)
            ->get()
            ->map(function ($car) {
                return [
                    'id' => $car->id,
                    'name' => $car->title,
                    'brand' => 'Car', // Generic brand since not available in table
                    'price' => is_numeric($car->price) ? $car->price : 0,
                    'description' => $car->description,
                    'image' => $car->image ? asset('storage/' . $car->image) : asset('photos/mobil1.jpg')
                ];
            });

        return view('planning', compact('destinations', 'hotels', 'cars'));
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'leaving_date' => 'required|date|after_or_equal:today',
            'return_date' => 'required|date|after:leaving_date',
            'adults' => 'integer|min:1',
            'children' => 'integer|min:0',
            'special_needs' => 'integer|min:0'
        ]);

        $selectedItems = [];
        $total = 0;

        // Calculate destinations
        if ($request->selected_destinations) {
            $destinationIds = explode(',', $request->selected_destinations);
            $destinations = Destination::with('destinasi')->whereIn('id', $destinationIds)->get();
            foreach ($destinations as $destination) {
                $selectedItems['destinations'][] = [
                    'id' => $destination->id,
                    'name' => $destination->destinasi->name ?? 'Unknown Destination',
                    'price' => $destination->destinasi->price ?? 0
                ];
                $total += $destination->destinasi->price ?? 0;
            }
        }

        // Calculate hotels
        if ($request->selected_hotel_room) {
            $roomData = json_decode($request->selected_hotel_room, true);
            if ($roomData) {
                $selectedItems['hotel'] = $roomData;
                $total += is_numeric($roomData['price']) ? $roomData['price'] : 0;
            }
        }

        // Calculate cars
        if ($request->selected_cars) {
            $carIds = explode(',', $request->selected_cars);
            $cars = Car::whereIn('id', $carIds)->get();
            foreach ($cars as $car) {
                $selectedItems['cars'][] = [
                    'id' => $car->id,
                    'name' => $car->title,
                    'price' => is_numeric($car->price) ? $car->price : 0
                ];
                $total += is_numeric($car->price) ? $car->price : 0;
            }
        }

        $guestTotal = ($request->adults ?? 1) + ($request->children ?? 0) + ($request->special_needs ?? 0);
        $days = \Carbon\Carbon::parse($request->leaving_date)->diffInDays(\Carbon\Carbon::parse($request->return_date)) + 1;

        // Calculate total considering days and guests
        $finalTotal = $total * $days;
        if (isset($selectedItems['hotel'])) {
            // Hotel price is per room per night, not per person
            $finalTotal = ($total - $selectedItems['hotel']['price']) * $days + ($selectedItems['hotel']['price'] * $days);
        }

        return back()->with([
            'calculationResult' => [
                'selectedItems' => $selectedItems,
                'total' => $finalTotal,
                'days' => $days,
                'guests' => $guestTotal,
                'leaving_date' => $request->leaving_date,
                'return_date' => $request->return_date
            ]
        ]);
    }

    public function addToCart(Request $request)
    {
        $user = Auth::user();
        $calculationData = $request->session()->get('calculationResult');

        if (!$calculationData) {
            return back()->with('error', 'No calculation data found. Please calculate first.');
        }

        DB::beginTransaction();
        try {
            // Create cart item for planning package
            Cart::create([
                'user_id' => $user->id,
                'item_type' => 'planning',
                'item_data' => $calculationData['selectedItems'],
                'quantity' => 1,
                'unit_price' => $calculationData['total'],
                'total_price' => $calculationData['total'],
                'start_date' => $calculationData['leaving_date'],
                'end_date' => $calculationData['return_date'],
                'guests' => $calculationData['guests']
            ]);

            DB::commit();
            return redirect()->route('cart.index')->with('success', 'Planning package added to cart successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Failed to add to cart. Please try again.');
        }
    }

    public function checkout(Request $request)
    {
        $calculationData = $request->session()->get('calculationResult');

        if (!$calculationData) {
            return back()->with('error', 'No calculation data found. Please calculate first.');
        }

        // Redirect to checkout page with planning data
        return redirect()->route('checkout.planning')->with('planningData', $calculationData);
    }

    public function getHotelRooms($hotelId)
    {
        $rooms = HotelRoom::where('hotel_id', $hotelId)->get();
        return response()->json($rooms);
    }
}

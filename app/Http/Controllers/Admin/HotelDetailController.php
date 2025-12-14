<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HotelDetail;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HotelDetailController extends Controller
{
    public function index()
    {
        $hotelDetails = HotelDetail::with('hotel')->latest()->paginate(10);
        return view('admin.hotel-detail.index', compact('hotelDetails'));
    }

    public function create()
    {
        $hotels = Hotel::all();
        return view('admin.hotel-detail.create', compact('hotels'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'nama' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'facilities' => 'nullable|string',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'rating' => 'nullable|numeric|min:0|max:5',
            'price' => 'nullable|numeric|min:0',
            'syaratKetentuan' => 'nullable|string',
            'map_url' => 'nullable|url',
            'headerImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'interiorImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('headerImage')) {
            $validated['headerImage'] = $request->file('headerImage')->store('hotel-details/header', 'public');
        }
        
        if ($request->hasFile('interiorImage')) {
            $validated['interiorImage'] = $request->file('interiorImage')->store('hotel-details/interior', 'public');
        }

        HotelDetail::create($validated);

        return redirect()->route('admin.hotel-detail.index')->with('success', 'Data detail hotel berhasil ditambahkan.');
    }

    public function show(HotelDetail $hotelDetail)
    {
        $hotelDetail->load('hotel');
        return view('admin.hotel-detail.show', compact('hotelDetail'));
    }

    public function edit(HotelDetail $hotelDetail)
    {
        $hotels = Hotel::all();
        return view('admin.hotel-detail.edit', compact('hotelDetail', 'hotels'));
    }

    public function update(Request $request, HotelDetail $hotelDetail)
    {
        $validated = $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'nama' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'facilities' => 'nullable|string',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'rating' => 'nullable|numeric|min:0|max:5',
            'price' => 'nullable|numeric|min:0',
            'syaratKetentuan' => 'nullable|string',
            'map_url' => 'nullable|url',
            'headerImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'interiorImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('headerImage')) {
            if ($hotelDetail->headerImage) {
                Storage::disk('public')->delete($hotelDetail->headerImage);
            }
            $validated['headerImage'] = $request->file('headerImage')->store('hotel-details/header', 'public');
        }
        
        if ($request->hasFile('interiorImage')) {
            if ($hotelDetail->interiorImage) {
                Storage::disk('public')->delete($hotelDetail->interiorImage);
            }
            $validated['interiorImage'] = $request->file('interiorImage')->store('hotel-details/interior', 'public');
        }

        $hotelDetail->update($validated);

        return redirect()->route('admin.hotel-detail.index')->with('success', 'Data detail hotel berhasil diperbarui.');
    }

    public function destroy(HotelDetail $hotelDetail)
    {
        if ($hotelDetail->headerImage) {
            Storage::disk('public')->delete($hotelDetail->headerImage);
        }
        if ($hotelDetail->interiorImage) {
            Storage::disk('public')->delete($hotelDetail->interiorImage);
        }

        $hotelDetail->delete();

        return redirect()->route('admin.hotel-detail.index')->with('success', 'Data detail hotel berhasil dihapus.');
    }
}

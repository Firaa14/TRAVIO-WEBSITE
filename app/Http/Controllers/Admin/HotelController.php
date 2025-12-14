<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::latest()->paginate(10);
        return view('admin.hotel.index', compact('hotels'));
    }

    public function create()
    {
        return view('admin.hotel.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|string',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'facilities' => 'nullable|string'
        ]);

        // Konversi fasilitas dari string ke array jika ada
        if (!empty($validated['facilities'])) {
            $validated['facilities'] = preg_split('/\r\n|\r|\n/', $validated['facilities']);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('hotels', 'public');
        }

        Hotel::create($validated);

        return redirect()->route('admin.hotel.index')->with('success', 'Data hotel berhasil ditambahkan.');
    }

    public function show(Hotel $hotel)
    {
        return view('admin.hotel.show', compact('hotel'));
    }

    public function edit(Hotel $hotel)
    {
        return view('admin.hotel.edit', compact('hotel'));
    }

    public function update(Request $request, Hotel $hotel)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|string',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'facilities' => 'nullable|string'
        ]);

        // Konversi fasilitas dari string ke array jika ada
        if (!empty($validated['facilities'])) {
            $validated['facilities'] = preg_split('/\r\n|\r|\n/', $validated['facilities']);
        }

        if ($request->hasFile('image')) {
            if ($hotel->image) {
                Storage::disk('public')->delete($hotel->image);
            }
            $validated['image'] = $request->file('image')->store('hotels', 'public');
        }

        $hotel->update($validated);

        return redirect()->route('admin.hotel.index')->with('success', 'Data hotel berhasil diperbarui.');
    }

    public function destroy(Hotel $hotel)
    {
        if ($hotel->image) {
            Storage::disk('public')->delete($hotel->image);
        }

        $hotel->delete();

        return redirect()->route('admin.hotel.index')->with('success', 'Data hotel berhasil dihapus.');
    }
}

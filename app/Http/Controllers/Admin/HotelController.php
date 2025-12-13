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
        $hotels = Hotel::all();
        return view('admin.hotel.index', compact('hotels'));
    }

    public function create()
    {
        return view('admin.hotel.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'location' => 'required|string|max:255',
            'facilities' => 'nullable|array',
            'facilities.*' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('hotels', 'public');
        }

        if (isset($data['facilities'])) {
            $data['facilities'] = json_encode($data['facilities']);
        }

        Hotel::create($data);

        return redirect()
            ->route('admin.hotel.index')
            ->with('success', 'Data hotel berhasil ditambahkan.');
    }

    public function edit(Hotel $hotel)
    {
        return view('admin.hotel.edit', compact('hotel'));
    }

    public function update(Request $request, Hotel $hotel)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'location' => 'required|string|max:255',
            'facilities' => 'nullable|array',
            'facilities.*' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            if ($hotel->image) {
                Storage::disk('public')->delete($hotel->image);
            }
            $data['image'] = $request->file('image')->store('hotels', 'public');
        }

        if (isset($data['facilities'])) {
            $data['facilities'] = json_encode($data['facilities']);
        }

        $hotel->update($data);

        return redirect()
            ->route('admin.hotel.index')
            ->with('success', 'Data hotel berhasil diperbarui.');
    }

    public function destroy(Hotel $hotel)
    {
        if ($hotel->image) {
            Storage::disk('public')->delete($hotel->image);
        }

        $hotel->delete();

        return redirect()
            ->route('admin.hotel.index')
            ->with('success', 'Data hotel berhasil dihapus.');
    }
}

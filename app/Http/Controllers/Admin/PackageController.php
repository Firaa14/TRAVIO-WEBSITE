<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::latest()->paginate(10);
        return view('admin.package.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.package.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'location' => 'required|string|max:255',
            'duration' => 'nullable|string',
            'facilities' => 'nullable|string',
            'itinerary' => 'nullable|string',
            'price_details' => 'nullable|string',
            'include' => 'nullable|string',
            'exclude' => 'nullable|string',
            'terms_conditions' => 'nullable|string',
        ]);

        // Convert string dengan pemisah baris menjadi array jika diperlukan
        if ($request->itinerary) {
            $itineraryArray = array_filter(explode("\n", str_replace("\r", "", $request->itinerary)));
            $validated['itinerary'] = json_encode($itineraryArray);
        }

        if ($request->price_details) {
            $priceDetailsArray = array_filter(explode("\n", str_replace("\r", "", $request->price_details)));
            $validated['price_details'] = json_encode($priceDetailsArray);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('packages', 'public');
        }

        Package::create($validated);

        return redirect()->route('admin.package.index')->with('success', 'Data paket berhasil ditambahkan.');
    }

    public function show(Package $package)
    {
        return view('admin.package.show', compact('package'));
    }

    public function edit(Package $package)
    {
        return view('admin.package.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'location' => 'required|string|max:255',
            'duration' => 'nullable|string',
            'facilities' => 'nullable|string',
            'itinerary' => 'nullable|string',
            'price_details' => 'nullable|string',
            'include' => 'nullable|string',
            'exclude' => 'nullable|string',
            'terms_conditions' => 'nullable|string',
        ]);

        // Convert string dengan pemisah baris menjadi array jika diperlukan
        if ($request->itinerary) {
            $itineraryArray = array_filter(explode("\n", str_replace("\r", "", $request->itinerary)));
            $validated['itinerary'] = json_encode($itineraryArray);
        }

        if ($request->price_details) {
            $priceDetailsArray = array_filter(explode("\n", str_replace("\r", "", $request->price_details)));
            $validated['price_details'] = json_encode($priceDetailsArray);
        }

        if ($request->hasFile('image')) {
            if ($package->image) {
                Storage::disk('public')->delete($package->image);
            }
            $validated['image'] = $request->file('image')->store('packages', 'public');
        }

        $package->update($validated);

        return redirect()->route('admin.package.index')->with('success', 'Data paket berhasil diperbarui.');
    }

    public function destroy(Package $package)
    {
        if ($package->image) {
            Storage::disk('public')->delete($package->image);
        }

        $package->delete();

        return redirect()->route('admin.package.index')->with('success', 'Data paket berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;

class PackageController extends Controller
{
    public function index()
    {
        // Menggunakan pagination seperti cars dan hotels
        $packages = Package::latest()->paginate(12);
        return view('packages.index', compact('packages'));
    }

    public function show($id, $tab = 'details')
    {
        $package = Package::findOrFail($id);

        $activeTab = $tab;

        // Format data untuk view
        $data = [
            'id' => $package->id,
            'title' => $package->title,
            'name' => $package->title, // alias untuk kompatibilitas
            'image' => $package->image,
            'location' => $package->location,
            'description' => $package->description,
            'detail' => $package->description, // alias untuk kompatibilitas
            'duration' => $package->duration,
            'price' => $package->price_details, // menggunakan price_details untuk tab price
            'base_price' => $package->price, // harga dasar untuk display
            'include' => $package->include,
            'facilities' => $package->facilities,
            'itinerary' => $package->itinerary,
        ];

        return view('packages.show', [
            'package' => (object) $data,
            'activeTab' => $activeTab
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('admin.car.index', compact('cars'));
    }
    public function create()
    {
        return view('admin.car.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'brand' => 'nullable',
            'model' => 'nullable',
            'year' => 'nullable|integer',
            'transmission' => 'nullable',
            'fuel_type' => 'nullable',
            'capacity' => 'nullable|integer',
            'color' => 'nullable',
            'price' => 'required',
            'description' => 'required',
            'location' => 'nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'interior_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'license_plate' => 'nullable',
            'facilities' => 'nullable',
            'terms_conditions' => 'nullable',
        ]);
        // Upload image utama
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('car', 'public');
        }
        // Upload interior image
        if ($request->hasFile('interior_image')) {
            $data['interior_image'] = $request->file('interior_image')->store('car', 'public');
        }
        // Upload gallery images
        $galleryImages = [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $file) {
                $galleryImages[] = $file->store('car', 'public');
            }
        }
        $data['gallery_images'] = json_encode($galleryImages);
        // Convert array/JSON fields
        $data['facilities'] = $request->filled('facilities') ? json_encode(array_map('trim', explode(',', $request->facilities))) : json_encode([]);
        $data['terms_conditions'] = $request->filled('terms_conditions') ? json_encode(array_map('trim', explode(',', $request->terms_conditions))) : json_encode([]);
        Car::create($data);
        return redirect()->route('admin.car.index')->with('success', 'Data mobil berhasil ditambah.');
    }
    public function edit(Car $car)
    {
        return view('admin.car.edit', compact('car'));
    }
    public function update(Request $request, Car $car)
    {
        $data = $request->validate([
            'title' => 'required',
            'brand' => 'nullable',
            'model' => 'nullable',
            'year' => 'nullable|integer',
            'transmission' => 'nullable',
            'fuel_type' => 'nullable',
            'capacity' => 'nullable|integer',
            'color' => 'nullable',
            'price' => 'required',
            'description' => 'required',
            'location' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'interior_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'license_plate' => 'nullable',
            'facilities' => 'nullable',
            'terms_conditions' => 'nullable',
        ]);
        // Upload image utama jika ada
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('car', 'public');
        } else {
            unset($data['image']);
        }
        // Upload interior image jika ada
        if ($request->hasFile('interior_image')) {
            $data['interior_image'] = $request->file('interior_image')->store('car', 'public');
        } else {
            unset($data['interior_image']);
        }
        // Upload gallery images jika ada
        $galleryImages = $car->gallery_images ?? [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $file) {
                $galleryImages[] = $file->store('car', 'public');
            }
        }
        $data['gallery_images'] = $galleryImages;
        // Convert array/JSON fields
        $data['facilities'] = $request->filled('facilities') ? array_map('trim', explode(',', $request->facilities)) : [];
        $data['terms_conditions'] = $request->filled('terms_conditions') ? array_map('trim', explode(',', $request->terms_conditions)) : [];
        $car->update($data);
        return redirect()->route('admin.car.index')->with('success', 'Data mobil berhasil diupdate.');
    }
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('admin.car.index')->with('success', 'Data mobil berhasil dihapus.');
    }
}

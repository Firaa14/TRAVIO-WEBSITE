<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::latest()->paginate(10);
        return view('admin.car.index', compact('cars'));
    }

    public function create()
    {
        return view('admin.car.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'brand' => 'nullable|string|max:100',
            'model' => 'nullable|string|max:100',
            'year' => 'nullable|integer|min:1990|max:' . (date('Y') + 1),
            'transmission' => 'nullable|string|max:50',
            'fuel_type' => 'required|in:Petrol,Diesel,Electric,Hybrid',
            'capacity' => 'nullable|integer|min:1|max:50',
            'color' => 'nullable|string|max:50',
            'license_plate' => 'nullable|string|max:20',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'interior_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'facilities' => 'nullable|array',
            'terms_conditions' => 'nullable|string'
        ]);

        // Pastikan facilities valid JSON dan tidak null
        if (!isset($validated['facilities'])) {
            $validated['facilities'] = json_encode([]);
        } elseif (is_array($validated['facilities'])) {
            $validated['facilities'] = json_encode($validated['facilities']);
        }

        // Handle main image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('cars', 'public');
        }

        // Handle interior image upload
        if ($request->hasFile('interior_image')) {
            $validated['interior_image'] = $request->file('interior_image')->store('cars/interior', 'public');
        }

        // Handle gallery images upload
        if ($request->hasFile('gallery_images')) {
            $galleryPaths = [];
            foreach ($request->file('gallery_images') as $file) {
                $galleryPaths[] = $file->store('cars/gallery', 'public');
            }
            $validated['gallery_images'] = $galleryPaths;
        }

        // Pastikan terms_conditions valid JSON
        if (isset($validated['terms_conditions']) && !is_array($validated['terms_conditions'])) {
            $validated['terms_conditions'] = json_encode([$validated['terms_conditions']]);
        } elseif (isset($validated['terms_conditions']) && is_array($validated['terms_conditions'])) {
            $validated['terms_conditions'] = json_encode($validated['terms_conditions']);
        }

        Car::create($validated);

        return redirect()->route('admin.car.index')->with('success', 'Data mobil berhasil ditambahkan.');
    }

    public function show(Car $car)
    {
        return view('admin.car.show', compact('car'));
    }

    public function edit(Car $car)
    {
        return view('admin.car.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'brand' => 'nullable|string|max:100',
            'model' => 'nullable|string|max:100',
            'year' => 'nullable|integer|min:1990|max:' . (date('Y') + 1),
            'transmission' => 'nullable|string|max:50',
            'fuel_type' => 'required|in:Petrol,Diesel,Electric,Hybrid',
            'capacity' => 'nullable|integer|min:1|max:50',
            'color' => 'nullable|string|max:50',
            'license_plate' => 'nullable|string|max:20',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'interior_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'facilities' => 'nullable|array',
            'terms_conditions' => 'nullable|string'
        ]);

        // Pastikan facilities valid JSON dan tidak null
        if (!isset($validated['facilities'])) {
            $validated['facilities'] = json_encode([]);
        } elseif (is_array($validated['facilities'])) {
            $validated['facilities'] = json_encode($validated['facilities']);
        }

        // Handle main image upload
        if ($request->hasFile('image')) {
            if ($car->image) {
                Storage::disk('public')->delete($car->image);
            }
            $validated['image'] = $request->file('image')->store('cars', 'public');
        }

        // Handle interior image upload
        if ($request->hasFile('interior_image')) {
            if ($car->interior_image) {
                Storage::disk('public')->delete($car->interior_image);
            }
            $validated['interior_image'] = $request->file('interior_image')->store('cars/interior', 'public');
        }

        // Handle gallery images upload
        if ($request->hasFile('gallery_images')) {
            if ($car->gallery_images) {
                foreach ($car->gallery_images as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
            $galleryPaths = [];
            foreach ($request->file('gallery_images') as $file) {
                $galleryPaths[] = $file->store('cars/gallery', 'public');
            }
            $validated['gallery_images'] = $galleryPaths;
        }

        // Pastikan terms_conditions valid JSON
        if (isset($validated['terms_conditions']) && !is_array($validated['terms_conditions'])) {
            $validated['terms_conditions'] = json_encode([$validated['terms_conditions']]);
        } elseif (isset($validated['terms_conditions']) && is_array($validated['terms_conditions'])) {
            $validated['terms_conditions'] = json_encode($validated['terms_conditions']);
        }

        $car->update($validated);

        return redirect()->route('admin.car.index')->with('success', 'Data mobil berhasil diperbarui.');
    }

    public function destroy(Car $car)
    {
        // Delete associated images
        if ($car->image) {
            Storage::disk('public')->delete($car->image);
        }
        if ($car->interior_image) {
            Storage::disk('public')->delete($car->interior_image);
        }
        if ($car->gallery_images) {
            foreach ($car->gallery_images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $car->delete();

        return redirect()->route('admin.car.index')->with('success', 'Data mobil berhasil dihapus.');
    }
}
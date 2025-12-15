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
            'include' => 'nullable|string',
            'exclude' => 'nullable|string',
            'facilities' => 'nullable|string',
            'itinerary' => 'nullable|string',
            'price_details' => 'nullable|string',
            'terms_conditions' => 'nullable|string',
        ]);

        // Clean price format
        $validated['price'] = (float) str_replace(['.', ','], ['', '.'], preg_replace('/[^0-9,.]/', '', $validated['price']));

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('packages', 'public');
        }

        // Handle JSON fields as arrays for database storage
        $jsonFields = ['facilities', 'itinerary', 'price_details'];
        foreach ($jsonFields as $field) {
            if (!empty($validated[$field])) {
                $validated[$field] = [$validated[$field]];
            } else {
                $validated[$field] = [];
            }
        }

        try {
            Package::create($validated);
            return redirect()->route('admin.package.index')->with('success', 'Data paket berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menyimpan data: ' . $e->getMessage()])->withInput();
        }
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
            'include' => 'nullable|string',
            'exclude' => 'nullable|string',
            'facilities' => 'nullable|string',
            'itinerary' => 'nullable|string',
            'price_details' => 'nullable|string',
            'terms_conditions' => 'nullable|string',
        ]);

        // Clean price format
        $validated['price'] = (float) str_replace(['.', ','], ['', '.'], preg_replace('/[^0-9,.]/', '', $validated['price']));

        // Handle JSON fields as arrays for database storage
        $jsonFields = ['facilities', 'itinerary', 'price_details'];
        foreach ($jsonFields as $field) {
            if (!empty($validated[$field])) {
                $validated[$field] = [$validated[$field]];
            } else {
                $validated[$field] = [];
            }
        }

        if ($request->hasFile('image')) {
            if ($package->image) {
                Storage::disk('public')->delete($package->image);
            }
            $validated['image'] = $request->file('image')->store('packages', 'public');
        }

        try {
            $package->update($validated);
            return redirect()->route('admin.package.index')->with('success', 'Data paket berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal memperbarui data: ' . $e->getMessage()])->withInput();
        }
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

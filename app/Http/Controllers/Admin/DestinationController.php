<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::latest()->paginate(10);
        return view('admin.destination.index', compact('destinations'));
    }

    public function create()
    {
        return view('admin.destination.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('destinations', 'public');
        }

        Destination::create($validated);

        return redirect()->route('admin.destination.index')->with('success', 'Data destination berhasil ditambahkan.');
    }

    public function show(Destination $destination)
    {
        return view('admin.destination.show', compact('destination'));
    }

    public function edit(Destination $destination)
    {
        return view('admin.destination.edit', compact('destination'));
    }

    public function update(Request $request, Destination $destination)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mixes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($destination->image) {
                Storage::disk('public')->delete($destination->image);
            }
            $validated['image'] = $request->file('image')->store('destinations', 'public');
        }

        $destination->update($validated);

        return redirect()->route('admin.destination.index')->with('success', 'Data destination berhasil diperbarui.');
    }

    public function destroy(Destination $destination)
    {
        if ($destination->image) {
            Storage::disk('public')->delete($destination->image);
        }

        $destination->delete();

        return redirect()->route('admin.destination.index')->with('success', 'Data destination berhasil dihapus.');
    }
}

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
            'destinasi_id' => 'required|exists:destinasi,id',
            'location' => 'required|string|max:255',
            'detail' => 'required|string',
            'itinerary' => 'nullable|string',
            'price_details' => 'nullable|string',
        ]);

        // Convert textarea to array
        if ($validated['itinerary']) {
            $validated['itinerary'] = array_filter(explode("\n", $validated['itinerary']));
        }
        
        if ($validated['price_details']) {
            $validated['price_details'] = array_filter(explode("\n", $validated['price_details']));
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
            'destinasi_id' => 'required|exists:destinasi,id',
            'location' => 'required|string|max:255',
            'detail' => 'required|string',
            'itinerary' => 'nullable|string',
            'price_details' => 'nullable|string',
        ]);

        // Convert textarea to array
        if ($validated['itinerary']) {
            $validated['itinerary'] = array_filter(explode("\n", $validated['itinerary']));
        }
        
        if ($validated['price_details']) {
            $validated['price_details'] = array_filter(explode("\n", $validated['price_details']));
        }

        $destination->update($validated);

        return redirect()->route('admin.destination.index')->with('success', 'Data destination berhasil diperbarui.');
    }

    public function destroy(Destination $destination)
    {
        $destination->delete();

        return redirect()->route('admin.destination.index')->with('success', 'Data destination berhasil dihapus.');
    }
}

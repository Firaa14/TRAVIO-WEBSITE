<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DestinasiController extends Controller
{
    public function index()
    {
        $destinasi = Destinasi::latest()->paginate(10);
        return view('admin.destinasi.index', compact('destinasi'));
    }

    public function create()
    {
        return view('admin.destinasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'nullable|numeric|min:0',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('destinasi', 'public');
        }

        Destinasi::create($validated);

        return redirect()->route('admin.destinasi.index')->with('success', 'Data destinasi berhasil ditambahkan.');
    }

    public function show(Destinasi $destinasi)
    {
        return view('admin.destinasi.show', compact('destinasi'));
    }

    public function edit(Destinasi $destinasi)
    {
        return view('admin.destinasi.edit', compact('destinasi'));
    }

    public function update(Request $request, Destinasi $destinasi)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'nullable|numeric|min:0',
        ]);

        if ($request->hasFile('image')) {
            if ($destinasi->image) {
                Storage::disk('public')->delete($destinasi->image);
            }
            $validated['image'] = $request->file('image')->store('destinasi', 'public');
        }

        $destinasi->update($validated);

        return redirect()->route('admin.destinasi.index')->with('success', 'Data destinasi berhasil diperbarui.');
    }

    public function destroy(Destinasi $destinasi)
    {
        if ($destinasi->image) {
            Storage::disk('public')->delete($destinasi->image);
        }

        $destinasi->delete();

        return redirect()->route('admin.destinasi.index')->with('success', 'Data destinasi berhasil dihapus.');
    }
}
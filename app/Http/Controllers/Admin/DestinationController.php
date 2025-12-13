<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::all();
        return view('admin.destination.index', compact('destinations'));
    }
    public function create()
    {
        return view('admin.destination.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        Destination::create($data);
        return redirect()->route('admin.destination.index')->with('success', 'Destinasi berhasil ditambah.');
    }
    public function edit(Destination $destination)
    {
        return view('admin.destination.edit', compact('destination'));
    }
    public function update(Request $request, Destination $destination)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $destination->update($data);
        return redirect()->route('admin.destination.index')->with('success', 'Destinasi berhasil diupdate.');
    }
    public function destroy(Destination $destination)
    {
        $destination->delete();
        return redirect()->route('admin.destination.index')->with('success', 'Destinasi berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OpenTrip;
use Illuminate\Http\Request;

class OpenTripController extends Controller
{
    public function index()
    {
        $openTrips = OpenTrip::all();
        return view('admin.opentrip.index', compact('openTrips'));
    }
    public function create()
    {
        return view('admin.opentrip.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);
        OpenTrip::create($data);
        return redirect()->route('admin.opentrip.index')->with('success', 'Open Trip berhasil ditambah.');
    }
    public function edit(OpenTrip $openTrip)
    {
        return view('admin.opentrip.edit', compact('openTrip'));
    }
    public function update(Request $request, OpenTrip $openTrip)
    {
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);
        $openTrip->update($data);
        return redirect()->route('admin.opentrip.index')->with('success', 'Open Trip berhasil diupdate.');
    }
    public function destroy(OpenTrip $openTrip)
    {
        $openTrip->delete();
        return redirect()->route('admin.opentrip.index')->with('success', 'Open Trip berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::all();
        return view('admin.hotel.index', compact('hotels'));
    }
    public function create()
    {
        return view('admin.hotel.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'address' => 'required',
            // tambahkan field lain sesuai kebutuhan
        ]);
        Hotel::create($data);
        return redirect()->route('admin.hotel.index')->with('success', 'Data hotel berhasil ditambah.');
    }
    public function edit(Hotel $hotel)
    {
        return view('admin.hotel.edit', compact('hotel'));
    }
    public function update(Request $request, Hotel $hotel)
    {
        $data = $request->validate([
            'name' => 'required',
            'address' => 'required',
            // tambahkan field lain sesuai kebutuhan
        ]);
        $hotel->update($data);
        return redirect()->route('admin.hotel.index')->with('success', 'Data hotel berhasil diupdate.');
    }
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return redirect()->route('admin.hotel.index')->with('success', 'Data hotel berhasil dihapus.');
    }
}

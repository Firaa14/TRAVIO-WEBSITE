<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PlanningBooking;
use Illuminate\Http\Request;

class PlanningController extends Controller
{
    public function index()
    {
        $plannings = PlanningBooking::all();
        return view('admin.planning.index', compact('plannings'));
    }
    public function create()
    {
        return view('admin.planning.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|integer',
            'destination' => 'required',
            'date' => 'required|date',
        ]);
        PlanningBooking::create($data);
        return redirect()->route('admin.planning.index')->with('success', 'Planning berhasil ditambah.');
    }
    public function edit(PlanningBooking $planning)
    {
        return view('admin.planning.edit', compact('planning'));
    }
    public function update(Request $request, PlanningBooking $planning)
    {
        $data = $request->validate([
            'user_id' => 'required|integer',
            'destination' => 'required',
            'date' => 'required|date',
        ]);
        $planning->update($data);
        return redirect()->route('admin.planning.index')->with('success', 'Planning berhasil diupdate.');
    }
    public function destroy(PlanningBooking $planning)
    {
        $planning->delete();
        return redirect()->route('admin.planning.index')->with('success', 'Planning berhasil dihapus.');
    }
}

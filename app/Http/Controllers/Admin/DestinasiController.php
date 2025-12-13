<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use Illuminate\Http\Request;

class DestinasiController extends Controller
{
    public function index()
    {
        $destinasis = Destinasi::all();
        return view('admin.destinasi.index', compact('destinasis'));
    }
    public function create()
    {
        return view('admin.destinasi.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        Destinasi::create($data);
        return redirect()->route('admin.destinasi.index')->with('success', 'Destinasi berhasil ditambah.');
    }
    public function edit(Destinasi $destinasi)
    {
        return view('admin.destinasi.edit', compact('destinasi'));
    }
    public function update(Request $request, Destinasi $destinasi)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $destinasi->update($data);
        return redirect()->route('admin.destinasi.index')->with('success', 'Destinasi berhasil diupdate.');
    }
    public function destroy(Destinasi $destinasi)
    {
        $destinasi->delete();
        return redirect()->route('admin.destinasi.index')->with('success', 'Destinasi berhasil dihapus.');
    }
}

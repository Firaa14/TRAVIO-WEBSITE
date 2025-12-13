<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view('admin.package.index', compact('packages'));
    }
    public function create()
    {
        return view('admin.package.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);
        Package::create($data);
        return redirect()->route('admin.package.index')->with('success', 'Paket berhasil ditambah.');
    }
    public function edit(Package $package)
    {
        return view('admin.package.edit', compact('package'));
    }
    public function update(Request $request, Package $package)
    {
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);
        $package->update($data);
        return redirect()->route('admin.package.index')->with('success', 'Paket berhasil diupdate.');
    }
    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->route('admin.package.index')->with('success', 'Paket berhasil dihapus.');
    }
}

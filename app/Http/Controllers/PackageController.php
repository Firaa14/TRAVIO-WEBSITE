<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all()->toArray();
        return view('packages.index', compact('packages'));
    }

    public function show($id)
    {
        $package = Package::findOrFail($id);
        return view('packages.show', compact('package'));
    }
}

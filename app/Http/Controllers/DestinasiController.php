<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destinasi;

class DestinasiController extends Controller
{

    public function index()
    {
        // Dummy data destinasi wisata
        $destinations = Destinasi::all();

        return view('destinasi.index', compact('destinations'));
    }

    public function show($id)
    {
        $destination = Destinasi::findOrFail($id);
        return view('destinasi.show', ['destination' => $destination]);
    }
}

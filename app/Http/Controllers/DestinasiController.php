<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destinasi;

class DestinasiController extends Controller
{

    public function index()
    {
        // Menggunakan pagination seperti packages
        $destinations = Destinasi::paginate(12);

        return view('destinasi.index', compact('destinations'));
    }

    public function show($id)
    {
        $destination = Destinasi::findOrFail($id);
        return view('destinasi.show', ['destination' => $destination]);
    }
}

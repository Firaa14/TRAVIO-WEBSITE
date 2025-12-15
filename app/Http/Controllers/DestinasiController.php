<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destinasi;
use App\Models\Destination;

class DestinasiController extends Controller
{

    public function index()
    {
        // Menggunakan pagination seperti packages
        $destinations = Destinasi::paginate(12);

        return view('destinasi.index', compact('destinations'));
    }

    public function show($id, Request $request)
    {
        // Ambil data dari tabel destinasi
        $destinasi = Destinasi::findOrFail($id);
        
        // Ambil data detail dari tabel destination yang terkait
        $destination_detail = Destination::where('destinasi_id', $id)->first();
        
        // Gabungkan data untuk view
        $destination = (object) [
            'id' => $destinasi->id,
            'name' => $destinasi->name,
            'image' => str_replace('photos/', '', $destinasi->image), // Remove photos/ prefix if exists
            'price' => $destinasi->price,
            'description' => $destinasi->description,
            // Data dari tabel destination
            'detail' => $destination_detail ? $destination_detail->detail : $destinasi->description,
            'location' => $destination_detail ? $destination_detail->location : '',
            'itinerary' => $destination_detail ? $destination_detail->itinerary : [],
            'price_details' => $destination_detail ? $destination_detail->price_details : [],
        ];
        
        // Untuk kompatibilitas dengan view yang menggunakan array price
        if (is_array($destination->price_details) && !empty($destination->price_details)) {
            $destination->price = $destination->price_details;
        } else {
            $destination->price = [];
        }
        
        // Ambil tab aktif dari query parameter
        $activeTab = $request->query('tab', 'details');
        
        return view('destinasi.show', compact('destination', 'activeTab'));
    }
}

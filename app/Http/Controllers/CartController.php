<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        // Contoh data keranjang (bisa diganti dengan data dari database)
        $items = [
            [
                'id' => 1,
                'nama' => 'Wisata Bromo Sunrise',
                'tipe' => 'Paket Wisata',
                'harga' => 350000,
                'jumlah' => 1,
                'gambar' => 'photos/destination1.jpg',
            ],
            [
                'id' => 2,
                'nama' => 'Hotel Batu View',
                'tipe' => 'Penginapan',
                'harga' => 250000,
                'jumlah' => 1,
                'gambar' => 'photos/hotel1.jpg',
            ],
            [
                'id' => 3,
                'nama' => 'Sewa Mobil Avanza',
                'tipe' => 'Transportasi',
                'harga' => 200000,
                'jumlah' => 1,
                'gambar' => 'photos/mobil1.jpg',
            ],
        ];

        return view('cart', compact('items'));
    }

    public function update(Request $request)
    {
        // Logika update jumlah produk atau centang
        return response()->json(['success' => true]);
    }

    public function checkout(Request $request)
    {
        // Logika checkout
        return redirect()->route('cart.index')->with('success', 'Checkout berhasil!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Get cart items from database for authenticated user
        $cartItems = Cart::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        // Format items for display
        $items = $cartItems->map(function ($cartItem) {
            $data = [
                'id' => $cartItem->id,
                'tipe' => ucfirst($cartItem->item_type),
                'harga' => $cartItem->unit_price,
                'jumlah' => $cartItem->quantity,
                'total' => $cartItem->total_price,
                'created_at' => $cartItem->created_at,
            ];

            if ($cartItem->item_type === 'planning') {
                $itemData = $cartItem->item_data;
                $data['nama'] = 'Custom Travel Package';
                $data['gambar'] = 'photos/destination1.jpg';
                $data['description'] = 'Planning package for ' . $cartItem->guests . ' guests, ' .
                    $cartItem->start_date->format('d M') . ' - ' .
                    $cartItem->end_date->format('d M Y');

                // Add details about selected items
                $details = [];
                if (isset($itemData['destinations'])) {
                    $details[] = count($itemData['destinations']) . ' destinations';
                }
                if (isset($itemData['hotel'])) {
                    $details[] = $itemData['hotel']['hotel_name'];
                }
                if (isset($itemData['cars'])) {
                    $details[] = count($itemData['cars']) . ' cars';
                }
                $data['description'] .= ' | ' . implode(', ', $details);

            } else {
                // Handle other item types (existing logic)
                $data['nama'] = $cartItem->item_data['name'] ?? 'Unknown Item';
                $data['gambar'] = $cartItem->item_data['image'] ?? 'photos/default.jpg';
                $data['description'] = $cartItem->item_data['description'] ?? '';
            }

            return $data;
        });

        return view('cart', compact('items'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::where('id', $validated['cart_id'])
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $cartItem->update([
            'quantity' => $validated['quantity'],
            'total_price' => $cartItem->unit_price * $validated['quantity']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Cart updated successfully',
            'new_total' => $cartItem->total_price
        ]);
    }

    public function remove(Request $request)
    {
        $validated = $request->validate([
            'cart_id' => 'required|exists:carts,id',
        ]);

        Cart::where('id', $validated['cart_id'])
            ->where('user_id', Auth::id())
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart'
        ]);
    }

    public function checkout(Request $request)
    {
        $selectedItems = $request->input('selected_items', []);

        if (empty($selectedItems)) {
            return back()->with('error', 'Please select items to checkout.');
        }

        // Get selected cart items
        $cartItems = Cart::whereIn('id', $selectedItems)
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'No valid items found for checkout.');
        }

        // Calculate total
        $total = $cartItems->sum('total_price');

        // Store checkout data in session
        session([
            'checkout_cart_data' => [
                'items' => $cartItems->toArray(),
                'total' => $total
            ]
        ]);

        return redirect()->route('checkout.cart');
    }
    /**
     * Handle upload bukti pembayaran
     */
    public function uploadBukti(Request $request)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $file = $request->file('bukti_pembayaran');
        $path = $file->store('bukti_pembayaran');

        // Simulasi pembuatan invoice (bisa diganti dengan logika sesuai kebutuhan)
        $invoiceNumber = 'INV-' . strtoupper(uniqid());

        // Redirect ke halaman cart dengan pesan sukses dan nomor invoice
        return redirect()->route('cart.index')
            ->with('success', 'Bukti pembayaran berhasil diupload! Invoice: ' . $invoiceNumber);
    }
}

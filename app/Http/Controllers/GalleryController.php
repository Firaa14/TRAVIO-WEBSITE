<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    /**
     * Display a listing of gallery posts.
     */
    public function index()
    {
        $galleries = Gallery::with('user')
            ->latest()
            ->paginate(9);

        return view('gallery', compact('galleries'));
    }

    /**
     * Store a newly created gallery post.
     */
    public function store(Request $request)
    {
        $request->validate([
            'location' => 'required|string|max:255',
            'caption' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('photos/gallery'), $imageName);
            $imagePath = 'photos/gallery/' . $imageName;
        }

        // Create gallery post
        Gallery::create([
            'user_id' => Auth::id(),
            'location' => $request->location,
            'caption' => $request->caption,
            'image' => $imagePath,
        ]);

        return redirect()->route('gallery.index')->with('success', 'Post berhasil ditambahkan!');
    }

    /**
     * Remove the specified gallery post.
     */
    public function destroy(Gallery $gallery)
    {
        // Check if user is authorized to delete
        if ($gallery->user_id !== Auth::id()) {
            return redirect()->route('gallery.index')->with('error', 'Anda tidak memiliki akses untuk menghapus post ini.');
        }

        // Delete image file if exists
        if ($gallery->image && file_exists(public_path($gallery->image))) {
            unlink(public_path($gallery->image));
        }

        $gallery->delete();

        return redirect()->route('gallery.index')->with('success', 'Post berhasil dihapus!');
    }
}

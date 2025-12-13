<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::all();
        return view('admin.gallery.index', compact('galleries'));
    }
    public function create()
    {
        return view('admin.gallery.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'image' => 'required',
        ]);
        Gallery::create($data);
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery berhasil ditambah.');
    }
    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }
    public function update(Request $request, Gallery $gallery)
    {
        $data = $request->validate([
            'title' => 'required',
            'image' => 'required',
        ]);
        $gallery->update($data);
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery berhasil diupdate.');
    }
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery berhasil dihapus.');
    }
}

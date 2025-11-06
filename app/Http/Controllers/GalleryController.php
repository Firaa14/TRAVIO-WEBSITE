<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        // Dummy data (20 item untuk simulasi pagination)
        $posts = collect([]);
        for ($i = 1; $i <= 20; $i++) {
            $posts->push([
                'username' => 'User' . $i,
                'profile' => 'photos/profil' . (($i - 1) % 5 + 1) . '.jpg',
                // Use local gallery images in public/photos/gallery1.jpg ... gallery10.jpg (repeat if >10)
                'image' => 'photos/destination' . (($i - 1) % 10 + 1) . '.jpg',
                'location' => 'Tempat ' . $i,
                'caption' => 'Pengalaman menarik di tempat ke-' . $i,
                'date' => Carbon::now()->subDays($i)->format('d M Y'),
            ]);
        }

        // Urutkan terbaru ke terlama
        $posts = $posts->sortByDesc('date')->values();

        // Pagination manual (15 item per halaman)
        $perPage = 15;
        $page = $request->get('page', 1);
        $pagedData = new LengthAwarePaginator(
            $posts->forPage($page, $perPage),
            $posts->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('gallery', ['posts' => $pagedData]);
    }
}

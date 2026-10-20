<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Album;

class GalleryController extends Controller
{
    public function index()
    {
        $albums = Album::with('images')->has('images')->ordered()->get();

        return view('frontend.pages.gallery.index', compact('albums'));
    }

    /** /gallery/{slug}: pictures inside one folder. */
    public function show(string $slug)
    {
        $album = Album::with('images')->where('slug', $slug)->firstOrFail();

        return view('frontend.pages.gallery.album', compact('album'));
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::with('images')->ordered()->get();
        return view('backend.pages.albums.index', compact('albums'));
    }

    public function create()
    {
        return view('backend.pages.albums.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:120',
            'description' => 'nullable|string|max:500',
        ]);

        $data['slug'] = $this->uniqueSlug($data['title']);
        $data['sort_order'] = (Album::max('sort_order') ?? 0) + 1;

        $album = Album::create($data);

        notify()->success('Folder created. Now add pictures.');
        return redirect()->route('albums.edit', $album);
    }

    public function edit(Album $album)
    {
        $album->load('images');
        return view('backend.pages.albums.edit', compact('album'));
    }

    public function update(Request $request, Album $album)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:120',
            'description' => 'nullable|string|max:500',
        ]);

        $album->update($data);   // slug is kept, so old links and the upload folder do not break

        notify()->success('Folder updated successfully.');
        return redirect()->route('albums.edit', $album);
    }

    public function destroy(Album $album)
    {
        foreach ($album->images as $img) {
            imageDeleteManager($img->image);
        }
        $album->delete();   // album_images rows go with it (cascade)

        notify()->success('Folder deleted successfully.');
        return redirect()->route('albums.index');
    }

    /** Drag-and-drop order of folders. */
    public function reorder(Request $request)
    {
        $ids = $request->validate(['ids' => 'required|array', 'ids.*' => 'integer'])['ids'];

        DB::transaction(function () use ($ids) {
            foreach ($ids as $i => $id) {
                Album::where('id', $id)->update(['sort_order' => $i + 1]);
            }
        });

        return response()->json(['ok' => true]);
    }

    private function uniqueSlug(string $title): string
    {
        $base = Str::slug($title) ?: 'folder';
        $slug = $base;
        $n = 2;
        while (Album::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $n++;
        }
        return $slug;
    }
}

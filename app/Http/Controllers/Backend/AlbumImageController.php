<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\AlbumImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlbumImageController extends Controller
{
    /** One picture per request (the page uploads many in parallel and shows progress). */
    public function store(Request $request, Album $album)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:10240',   // 10 MB
        ]);

        $path = imageUploadManager($request->file('image'), $album->slug, 'gallery/' . $album->slug);

        $image = $album->images()->create([
            'image'      => $path,
            'sort_order' => (AlbumImage::where('album_id', $album->id)->max('sort_order') ?? 0) + 1,
        ]);

        return response()->json([
            'id'      => $image->id,
            'url'     => $image->url,
            'caption' => '',
        ]);
    }

    public function update(Request $request, AlbumImage $image)
    {
        $data = $request->validate(['caption' => 'nullable|string|max:150']);
        $image->update(['caption' => $data['caption'] ?? null]);

        return response()->json(['ok' => true]);
    }

    public function destroy(AlbumImage $image)
    {
        imageDeleteManager($image->image);
        $image->delete();

        return response()->json(['ok' => true]);
    }

    /** Drag-and-drop order of pictures inside one folder. */
    public function reorder(Request $request, Album $album)
    {
        $ids = $request->validate(['ids' => 'required|array', 'ids.*' => 'integer'])['ids'];

        DB::transaction(function () use ($ids, $album) {
            foreach ($ids as $i => $id) {
                AlbumImage::where('album_id', $album->id)->where('id', $id)->update(['sort_order' => $i + 1]);
            }
        });

        return response()->json(['ok' => true]);
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Concern;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ConcernController extends Controller
{
    private const IMAGES = ['image', 'image2', 'home_image'];

    public function index()
    {
        $concerns = Concern::whereNull('parent_id')->ordered()->with('childrenRecursive')->get();
        return view('backend.pages.concerns.index', compact('concerns'));
    }

    public function create(Request $request)
    {
        $concern = new Concern([
            'parent_id' => $request->integer('parent') ?: null,
            'layout'    => $request->integer('parent') ? 'brand' : 'feature',
        ]);
        $parents = $this->parentOptions();
        return view('backend.pages.concerns.create', compact('concern', 'parents'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->resolveSlug($data['slug'] ?? null, $data['title'], $data['parent_id'] ?? null);
        $data['sort_order'] = (Concern::where('parent_id', $data['parent_id'] ?? null)->max('sort_order') ?? 0) + 1;
                // the url path is needed at insert time (column is required)
        $parent = !empty($data['parent_id']) ? Concern::find($data['parent_id']) : null;
        $data['path'] = ($parent ? $parent->path . '/' : '') . $data['slug'];

        $this->saveFiles($request, $data, null);

        $concern = Concern::create($data);
        $concern->refreshPath();

        notify()->success('Concern created successfully.');
        return redirect()->route('concerns.index');
    }

    public function edit(Concern $concern)
    {
        $parents = $this->parentOptions($concern);
        return view('backend.pages.concerns.edit', compact('concern', 'parents'));
    }

    public function update(Request $request, Concern $concern)
    {
        $data = $this->validated($request, $concern);

        // an item can not be moved below itself
        if (!empty($data['parent_id']) && in_array((int) $data['parent_id'], $concern->selfAndDescendantIds(), true)) {
            return back()->withInput()->withErrors(['parent_id' => 'An item can not be placed under itself.']);
        }

        $data['slug'] = $this->resolveSlug($data['slug'] ?? null, $data['title'], $data['parent_id'] ?? null, $concern);

        if ((int) ($data['parent_id'] ?? 0) !== (int) $concern->parent_id) {
            $data['sort_order'] = (Concern::where('parent_id', $data['parent_id'] ?? null)->max('sort_order') ?? 0) + 1;
        }

        $this->saveFiles($request, $data, $concern);

        $concern->update($data);
        $concern->refreshPath();

        notify()->success('Concern updated successfully.');
        return redirect()->route('concerns.index');
    }

    public function destroy(Concern $concern)
    {
        $ids = $concern->selfAndDescendantIds();

        foreach (Concern::whereIn('id', $ids)->get() as $item) {
            foreach (array_merge(self::IMAGES, ['catalogue']) as $field) {
                if ($item->$field && !preg_match('#^https?://#i', $item->$field)) {
                    @unlink(public_path($item->$field));
                }
            }
        }

        $concern->delete();   // children are removed with it (cascade)
        Concern::flush();

        notify()->success('Concern deleted successfully.');
        return redirect()->route('concerns.index');
    }

    /** Drag-and-drop order (items of one list). */
    public function reorder(Request $request)
    {
        $ids = $request->validate(['ids' => 'required|array', 'ids.*' => 'integer'])['ids'];

        DB::transaction(function () use ($ids) {
            foreach ($ids as $i => $id) {
                Concern::where('id', $id)->update(['sort_order' => $i + 1]);
            }
        });
        Concern::flush();

        return response()->json(['ok' => true]);
    }

    /* ------------------------------------------------------------ */

    private function validated(Request $request, ?Concern $concern = null): array
    {
        $data = $request->validate([
            'title'             => 'required|string|max:150',
            'slug'              => ['nullable', 'string', 'max:150', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/'],
            'parent_id'         => 'nullable|integer|exists:concerns,id',
            'layout'            => 'required|in:feature,brand',
            'eyebrow'           => 'nullable|string|max:120',
            'heading'           => 'nullable|string|max:200',
            'heading_highlight' => 'nullable|string|max:100',
            'tagline'           => 'nullable|string|max:255',
            'body'              => 'nullable|string|max:8000',
            'features_text'     => 'nullable|string|max:3000',
            'cards'             => 'nullable|array|max:3',
            'cards.*.icon'      => 'nullable|string|max:10',
            'cards.*.title'     => 'nullable|string|max:100',
            'cards.*.text'      => 'nullable|string|max:300',
            'children_heading'  => 'nullable|string|max:120',
            'children_text'     => 'nullable|string|max:255',
            'home_icon'         => 'nullable|string|max:10',
            'home_text'         => 'nullable|string|max:300',
            'home_order'        => 'nullable|integer|min:1|max:99',
            'meta_title'        => 'nullable|string|max:150',
            'meta_description'  => 'nullable|string|max:300',
            'image'             => 'nullable|image|max:10240',
            'image2'            => 'nullable|image|max:10240',
            'home_image'        => 'nullable|image|max:10240',
            'catalogue'         => 'nullable|file|mimes:pdf|max:61440',
        ], [
            'slug.regex'       => 'The URL name may only contain small letters, numbers and hyphens.',
            'catalogue.mimes'  => 'The catalogue must be a PDF file.',
            'catalogue.max'    => 'The catalogue PDF must be 60 MB or smaller.',
        ]);

        // "What We Offer" list: one line = one point
        $lines = preg_split('/\R/', (string) ($data['features_text'] ?? ''));
        $data['features'] = array_values(array_filter(array_map('trim', $lines)));
        unset($data['features_text']);

        // cards: keep only rows that have a title
        $cards = [];
        foreach (($data['cards'] ?? []) as $card) {
            if (!empty($card['title'])) {
                $cards[] = [
                    'icon'  => $card['icon'] ?? '',
                    'title' => $card['title'],
                    'text'  => $card['text'] ?? '',
                ];
            }
        }
        $data['cards'] = $cards;

        // home position is only for top-level items
        if (!empty($data['parent_id'])) {
            $data['home_order'] = null;
        }

        return $data;
    }

    /** Unique url name among the items under the same parent. */
    private function resolveSlug(?string $slug, string $title, $parentId, ?Concern $self = null): string
    {
        $base = $slug ?: (Str::slug($title) ?: 'item');
        $slug = $base;
        $n = 2;

        while (
            Concern::where('parent_id', $parentId)
                ->where('slug', $slug)
                ->when($self, fn ($q) => $q->where('id', '!=', $self->id))
                ->exists()
        ) {
            $slug = $base . '-' . $n++;
        }
        return $slug;
    }

    /** Pictures and the catalogue PDF. */
    private function saveFiles(Request $request, array &$data, ?Concern $old): void
    {
        $name = Str::slug($data['title']) ?: 'concern';

        foreach (self::IMAGES as $field) {
            unset($data[$field]);

            if ($request->hasFile($field)) {
                $data[$field] = ($old && $old->$field)
                    ? imageUpdateManager($request->file($field), $name, 'concerns', $old->$field)
                    : imageUploadManager($request->file($field), $name, 'concerns');
            } elseif ($old && $request->boolean('remove_' . $field)) {
                if ($old->$field) {
                    imageDeleteManager($old->$field);
                }
                $data[$field] = null;
            }
        }

        unset($data['catalogue']);

        if ($request->hasFile('catalogue')) {
            $dir = public_path('uploads/catalogues');
            if (!is_dir($dir)) {
                mkdir($dir, 0775, true);
            }
            $file = $name . '_' . time() . '.pdf';
            $request->file('catalogue')->move($dir, $file);

            if ($old && $old->catalogue) {
                @unlink(public_path($old->catalogue));
            }
            $data['catalogue'] = 'uploads/catalogues/' . $file;
        } elseif ($old && $request->boolean('remove_catalogue')) {
            if ($old->catalogue) {
                @unlink(public_path($old->catalogue));
            }
            $data['catalogue'] = null;
        }
    }

    /** Flat list for the "Parent" dropdown (indented), leaving out the item itself and its children. */
    private function parentOptions(?Concern $except = null): array
    {
        $skip = $except ? $except->selfAndDescendantIds() : [];
        $list = [];

        $walk = function ($nodes, $depth) use (&$walk, &$list, $skip) {
            foreach ($nodes as $node) {
                if (in_array($node->id, $skip, true)) {
                    continue;
                }
                $list[$node->id] = str_repeat('— ', $depth) . $node->title;
                $walk($node->childrenRecursive, $depth + 1);
            }
        };

        $walk(Concern::whereNull('parent_id')->ordered()->with('childrenRecursive')->get(), 0);
        return $list;
    }
}

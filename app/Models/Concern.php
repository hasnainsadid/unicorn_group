<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\HtmlString;

class Concern extends Model
{
    protected $guarded = [];

    protected $casts = [
        'features' => 'array',
        'cards'    => 'array',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => self::flush());
        static::deleted(fn () => self::flush());
    }

    public static function flush(): void
    {
        Cache::forget('concerns.tree');
    }

    /** Whole menu tree (top-level items with all children), cached. */
    public static function tree()
    {
        return Cache::rememberForever('concerns.tree', function () {
            return static::whereNull('parent_id')->ordered()->with('childrenRecursive')->get();
        });
    }

    /* ---------- relations ---------- */

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')->ordered();
    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }

    /* ---------- scopes ---------- */

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    /** Concerns shown on the home page (top-level, with a home position). */
    public function scopeHome($query)
    {
        return $query->whereNull('parent_id')->whereNotNull('home_order')->orderBy('home_order')->orderBy('id');
    }

    /* ---------- helpers ---------- */

    /** Rebuild the url path of this item and all items below it. */
    public function refreshPath(): void
    {
        $parent = $this->parent_id ? self::find($this->parent_id) : null;
        $this->path = ($parent ? $parent->path . '/' : '') . $this->slug;
        $this->saveQuietly();

        foreach (self::where('parent_id', $this->id)->get() as $child) {
            $child->refreshPath();
        }
    }

    /** Ids of this item and everything below it. */
    public function selfAndDescendantIds(): array
    {
        $ids = [$this->id];
        foreach (self::where('parent_id', $this->id)->get() as $child) {
            $ids = array_merge($ids, $child->selfAndDescendantIds());
        }
        return $ids;
    }

    /** Parents from the top down (not including this item). */
    public function ancestors()
    {
        $list = collect();
        $node = $this->parent_id ? self::find($this->parent_id) : null;
        while ($node) {
            $list->prepend($node);
            $node = $node->parent_id ? self::find($node->parent_id) : null;
        }
        return $list;
    }

    public function root(): self
    {
        return $this->ancestors()->first() ?? $this;
    }

    public function isActive(): bool
    {
        return request()->is('concerns/' . $this->path) || request()->is('concerns/' . $this->path . '/*');
    }

    /* ---------- accessors ---------- */

    private function media(?string $value): string
    {
        if ($value && preg_match('#^https?://#i', $value)) {
            return $value;
        }
        return imageShow($value);
    }

    public function getUrlAttribute(): string
    {
        return route('concern.show', $this->path);
    }

    public function getImageUrlAttribute(): string
    {
        return $this->media($this->image);
    }

    public function getImage2UrlAttribute(): string
    {
        return $this->media($this->image2 ?: $this->image);
    }

    public function getHomeImageUrlAttribute(): string
    {
        return $this->media($this->home_image ?: $this->image);
    }

    public function getHomeTextShortAttribute(): string
    {
        return $this->home_text ?: (string) $this->tagline;
    }

    public function getCatalogueUrlAttribute(): ?string
    {
        return $this->catalogue ? asset($this->catalogue) : null;
    }

    public function getParagraphsAttribute(): array
    {
        return array_values(array_filter(array_map('trim', preg_split('/\R\s*\R/', (string) $this->body))));
    }

    public function getFeaturesTextAttribute(): string
    {
        return implode("\n", $this->features ?? []);
    }

    /** Heading with the highlighted word wrapped in <span>. */
    public function getHeadingHtmlAttribute(): HtmlString
    {
        $text = e($this->heading ?: $this->title);
        $word = e((string) $this->heading_highlight);

        if ($word !== '' && str_contains($text, $word)) {
            $text = str_replace($word, '<span>' . $word . '</span>', $text);
        }
        return new HtmlString($text);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $guarded = [];

    public function images()
    {
        return $this->hasMany(AlbumImage::class)->orderBy('sort_order')->orderBy('id');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    /** Cover = the first picture (drag a picture to the first place to change it). */
    public function getCoverUrlAttribute(): string
    {
        return imageShow($this->images->first()?->image);
    }
}

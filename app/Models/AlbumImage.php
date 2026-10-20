<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlbumImage extends Model
{
    protected $guarded = [];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function getUrlAttribute(): string
    {
        return imageShow($this->image);
    }
}

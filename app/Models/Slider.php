<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $guarded = [];

    protected $casts = ['status' => 'boolean'];

    // Frontend e sudhu active slide, order onujayi
    public function scopeActive($query)
    {
        return $query->where('status', true)->orderBy('sort_order')->orderBy('id');
    }

    // Title er highlight shobdo ta <em> er bhitore boshay (XSS safe)
    public function getTitleHtmlAttribute(): string
    {
        $title = e($this->title);
        $hl = e((string) $this->highlight);

        if ($hl !== '' && ($pos = mb_stripos($title, $hl)) !== false) {
            $len = mb_strlen($hl);
            $title = mb_substr($title, 0, $pos)
                . '<em>' . mb_substr($title, $pos, $len) . '</em>'
                . mb_substr($title, $pos + $len);
        }

        return $title;
    }
}
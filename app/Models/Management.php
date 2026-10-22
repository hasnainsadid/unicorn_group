<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    protected $table = 'managements';

    protected $guarded = [];

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    /** Message paragraph e bhag kora (faka line = notun paragraph). */
    public function getParagraphsAttribute(): array
    {
        $text = trim((string) $this->message);
        return $text === '' ? [] : preg_split('/\R\s*\R/', $text);
    }

    /** Photo na thakle portrait box e naam er prothom okkhor gulo (max 3). */
    public function getInitialsAttribute(): string
    {
        $letters = '';
        foreach (preg_split('/\s+/', trim((string) $this->name)) as $word) {
            $letters .= mb_strtoupper(mb_substr($word, 0, 1));
        }
        return mb_substr($letters, 0, 3);
    }

    public function getPhotoUrlAttribute(): ?string
    {
        if (!$this->photo) {
            return null;
        }
        return str_starts_with($this->photo, 'http') ? $this->photo : imageShow($this->photo);
    }
}
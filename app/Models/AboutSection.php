<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    protected $guarded = [];

    public static function byKey(string $key): ?self
    {
        return static::where('key', $key)->first();
    }

    /** Title er highlight word ta <span> e (age sob escape kora hoy, tai safe). */
    public function getTitleHtmlAttribute(): string
    {
        $title = e($this->title);
        $word  = trim((string) $this->highlight);
        if ($word === '') {
            return $title;
        }

        $word = e($word);
        $pos  = mb_stripos($title, $word);
        if ($pos === false) {
            return $title;
        }

        return mb_substr($title, 0, $pos)
            . '<span>' . mb_substr($title, $pos, mb_strlen($word)) . '</span>'
            . mb_substr($title, $pos + mb_strlen($word));
    }

    /** Body paragraph e bhag kora (faka line = notun paragraph). */
    public function getParagraphsAttribute(): array
    {
        $body = trim((string) $this->body);
        return $body === '' ? [] : preg_split('/\R\s*\R/', $body);
    }

    public function getMainUrlAttribute(): string
    {
        return $this->resolve($this->image_main);
    }

    public function getSubUrlAttribute(): string
    {
        return $this->resolve($this->image_sub);
    }

    private function resolve(?string $img): string
    {
        return $img && str_starts_with($img, 'http') ? $img : imageShow($img);
    }
}
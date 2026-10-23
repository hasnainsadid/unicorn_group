<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Support\Facades\Route;

class SeoController extends Controller
{
    public function sitemap()
    {
        $urls = [];
        $add = function (string $loc, $lastmod = null, string $freq = 'monthly', string $priority = '0.6') use (&$urls) {
            $urls[$loc] = compact('loc', 'lastmod', 'freq', 'priority');
        };

        // Main pages
        foreach (['home' => ['weekly', '1.0'], 'about' => ['monthly', '0.8'], 'management' => ['monthly', '0.6'],
                  'gallery' => ['weekly', '0.7'], 'contact' => ['yearly', '0.7']] as $name => [$freq, $prio]) {
            if (Route::has($name)) {
                $add(route($name), null, $freq, $prio);
            }
        }

        // Concern pages (route name "concern.*", parameter chara GET route gulo automatic)
        foreach (Route::getRoutes() as $r) {
            $name = $r->getName();
            if ($name && str_starts_with($name, 'concern.') && in_array('GET', $r->methods(), true) && !str_contains($r->uri(), '{')) {
                $add(url($r->uri()), null, 'monthly', '0.8');
            }
        }

        // Gallery folders
        if (class_exists(Album::class) && Route::has('gallery.album')) {
            foreach (Album::has('images')->get() as $album) {
                $add(route('gallery.album', $album->slug), $album->updated_at?->toAtomString(), 'monthly', '0.5');
            }
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n" . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ($urls as $u) {
            $xml .= "  <url>\n    <loc>" . e($u['loc']) . "</loc>\n";
            if ($u['lastmod']) {
                $xml .= '    <lastmod>' . $u['lastmod'] . "</lastmod>\n";
            }
            $xml .= '    <changefreq>' . $u['freq'] . "</changefreq>\n    <priority>" . $u['priority'] . "</priority>\n  </url>\n";
        }
        $xml .= '</urlset>';

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }

    public function robots()
    {
        if (setting('allow_indexing', '1') !== '1') {
            $txt = "User-agent: *\nDisallow: /\n";
        } else {
            $txt = "User-agent: *\n";
            foreach (['dashboard', 'user', 'contacts', 'sliders', 'clients', 'albums', 'about-sections', 'managements', 'settings',
                      'login', 'register', 'forgot-password', 'reset-password', 'two-factor-challenge',
                      'migrate', 'composer', 'clear', 'iseed'] as $path) {
                $txt .= "Disallow: /{$path}\n";
            }
            $txt .= "\nSitemap: " . url('/sitemap.xml') . "\n";
        }

        return response($txt, 200, ['Content-Type' => 'text/plain; charset=UTF-8']);
    }
}
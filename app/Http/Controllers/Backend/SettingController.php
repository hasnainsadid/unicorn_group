<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    /** [key, label, type, help, (column width)] */
    private function groups(): array
    {
        return [
            'General' => [
                ['site_name', 'Website Name', 'text', 'Shown in the browser tab, footer and Google results.'],
                ['tagline', 'Tagline', 'text', 'Used in the Home page title, e.g. "Unicorn Group | Your tagline".'],
                ['working_hours', 'Working Hours', 'text', ''],
            ],
            'Contact' => [
                ['phone', 'Phone (main)', 'text', 'Used in the top bar, footer and contact page.'],
                ['phone2', 'Phone 2 (24/7 support)', 'text', ''],
                ['email', 'Email (main)', 'email', ''],
                ['email2', 'Email 2', 'email', ''],
                ['address', 'Address', 'text', ''],
            ],
            'Map' => [
                ['map_query', 'Map Location', 'text', 'Type the address (or "latitude,longitude"). Leave empty to use the Address above.'],
            ],
            'Social & Chat' => [
                ['facebook', 'Facebook Page Link', 'url', 'Full link, e.g. https://facebook.com/yourpage. Empty = icon is hidden.'],
                ['youtube', 'YouTube Channel Link', 'url', ''],
                ['twitter', 'X (Twitter) Link', 'url', ''],
                ['linkedin', 'LinkedIn Link', 'url', ''],
                ['instagram', 'Instagram Link', 'url', ''],
                ['whatsapp', 'WhatsApp Number', 'text', 'With country code, e.g. 8801335106960. Empty = WhatsApp button is hidden.'],
                ['wechat', 'WeChat Link', 'text', 'Empty = WeChat button is hidden.'],
            ],
            'Home Page Numbers' => $this->statFields(),
            'SEO (Google)' => [
                ['meta_description', 'Default Meta Description', 'textarea', 'About 150 characters. Shown under your site name in Google. Pages without their own description use this.'],
                ['meta_keywords', 'Meta Keywords', 'text', 'Optional. Google ignores this, some other search engines use it.'],
                ['og_image', 'Share Image', 'file', 'Picture shown when the site is shared on Facebook / WhatsApp. Best size 1200 x 630.'],
                ['google_verification', 'Google Search Console Verification Code', 'text', 'Only the code from: <meta name="google-site-verification" content="CODE">'],
                ['ga_id', 'Google Analytics ID', 'text', 'e.g. G-XXXXXXXXXX. Empty = no tracking.'],
                ['allow_indexing', 'Let Google index this website', 'switch', 'Turn OFF while the site is under construction.'],
            ],
        ];
    }

    private function rules(): array
    {
        $rules = [
            'site_name'           => 'required|string|max:100',
            'tagline'             => 'nullable|string|max:150',
            'working_hours'       => 'nullable|string|max:100',
            'phone'               => 'nullable|string|max:40',
            'phone2'              => 'nullable|string|max:40',
            'email'               => 'nullable|email|max:150',
            'email2'              => 'nullable|email|max:150',
            'address'             => 'nullable|string|max:255',
            'map_query'           => 'nullable|string|max:255',
            'facebook'            => 'nullable|url|max:255',
            'youtube'             => 'nullable|url|max:255',
            'twitter'             => 'nullable|url|max:255',
            'linkedin'            => 'nullable|url|max:255',
            'instagram'           => 'nullable|url|max:255',
            'whatsapp'            => 'nullable|string|max:30',
            'wechat'              => 'nullable|string|max:255',
            'meta_description'    => 'nullable|string|max:300',
            'meta_keywords'       => 'nullable|string|max:255',
            'google_verification' => 'nullable|string|max:120',
            'ga_id'               => ['nullable', 'string', 'max:30', 'regex:/^(G|GTM|UA|AW)-[A-Za-z0-9-]+$/'],
            'og_image'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:30720',
        ];

        for ($i = 1; $i <= 5; $i++) {
            $rules["stat{$i}_icon"]   = 'nullable|string|max:10';
            $rules["stat{$i}_value"]  = 'nullable|integer|min:0|max:99999999';
            $rules["stat{$i}_suffix"] = 'nullable|string|max:5';
            $rules["stat{$i}_label"]  = 'nullable|string|max:60';
        }

        return $rules + [
            'stats_eyebrow'   => 'nullable|string|max:80',
            'stats_title'     => 'nullable|string|max:200',
            'stats_highlight' => 'nullable|string|max:80',
        ];
    }

    /** Home page er "By the numbers" section: heading + 5 ta number. */
    private function statFields(): array
    {
        $fields = [
            ['stats_eyebrow', 'Small text above the title', 'text', '', 4],
            ['stats_title', 'Title', 'text', '', 5],
            ['stats_highlight', 'Golden Highlight Word (a word that already appears in the title)', 'text', '', 3],
        ];

        for ($i = 1; $i <= 5; $i++) {
            $fields[] = ["stat{$i}_icon", "Number {$i}: Icon (emoji)", 'text', '', 2];
            $fields[] = ["stat{$i}_value", 'Number', 'number', '', 3];
            $fields[] = ["stat{$i}_suffix", 'After number (e.g. +)', 'text', '', 2];
            $fields[] = ["stat{$i}_label", 'Label', 'text', '', 5];
        }

        return $fields;
    }

    public function index()
    {
        return view('backend.pages.settings.index', ['groups' => $this->groups()]);
    }

    public function update(Request $request)
    {
        $data = $request->validate($this->rules(), [
            'ga_id.regex' => 'Google Analytics ID looks like G-XXXXXXXXXX.',
        ]);

        // Text fields
        foreach ($data as $key => $value) {
            if ($key === 'og_image') {
                continue;
            }
            $value = is_string($value) ? trim($value) : $value;
            if ($key === 'whatsapp') {
                $value = preg_replace('/\D/', '', (string) $value);   // shudhu digit
            }
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // Share image
        if ($request->hasFile('og_image')) {
            $path = imageUpdateManager($request->file('og_image'), 'share-image', 'settings', setting('og_image') ?? '');
            Setting::updateOrCreate(['key' => 'og_image'], ['value' => $path]);
        }

        // Switch (unchecked checkbox kichu pathay na)
        Setting::updateOrCreate(['key' => 'allow_indexing'], ['value' => $request->boolean('allow_indexing') ? '1' : '0']);

        Cache::forget('settings');

        notify()->success('Settings saved successfully.');
        return redirect()->route('settings.index');
    }
}
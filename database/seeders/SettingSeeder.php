<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            // General
            'site_name'     => 'Unicorn Group',
            'tagline'       => 'Engineering Solutions & Modern Infrastructure',
            'working_hours' => 'Sat – Thu · 9:00 AM – 6:00 PM',

            // Contact
            'phone'   => '+880 1335-106960',
            'phone2'  => '+880 1743-389578',
            'email'   => 'unicornventureltd@gmail.com',
            'email2'  => 'pialtp4@gmail.com',
            'address' => 'Ujjal Tower, L-5, 362, DIT Road, East Rampura, Dhaka 1219',

            // Map
            'map_query' => 'Ujjal Tower, L-5, 362, DIT Road, East Rampura Dhaka 1219',

            // Social & chat
            'facebook' => 'https://www.facebook.com/share/1CYrcJ9qZZ/',
            'whatsapp' => '8801335106960',

            // Home page numbers
            'stats_eyebrow'   => 'By the numbers',
            'stats_title'     => 'Engineering that moves cities, quietly and safely.',
            'stats_highlight' => 'moves',

            'stat1_icon' => '🏆', 'stat1_value' => '25',   'stat1_suffix' => '+', 'stat1_label' => 'Years Experience',
            'stat2_icon' => '👷', 'stat2_value' => '150',  'stat2_suffix' => '+', 'stat2_label' => 'Employees',
            'stat3_icon' => '🤝', 'stat3_value' => '320',  'stat3_suffix' => '+', 'stat3_label' => 'Happy Clients',
            'stat4_icon' => '🏢', 'stat4_value' => '540',  'stat4_suffix' => '+', 'stat4_label' => 'Projects Done',
            'stat5_icon' => '🛗', 'stat5_value' => '2800', 'stat5_suffix' => '+', 'stat5_label' => 'Units Installed',

            // SEO
            'meta_description' => 'Unicorn Group is a diversified business group in Bangladesh: lifts and elevators, generators, substations, engineering solutions, real estate and technical support.',
            'meta_keywords'    => 'Unicorn Group, lift, elevator, generator, substation, engineering, Dhaka, Bangladesh',
            'allow_indexing'   => '1',
        ];

        foreach ($defaults as $key => $value) {
            // je setting age-i ache seta bodlay na, shudhu notun key gulo jog hoy
            Setting::firstOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
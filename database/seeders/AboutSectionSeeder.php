<?php

namespace Database\Seeders;

use App\Models\AboutSection;
use Illuminate\Database\Seeder;

class AboutSectionSeeder extends Seeder
{
    public function run(): void
    {
        $main = 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1000&q=60';
        $sub  = 'https://images.unsplash.com/photo-1581094288338-2314dddb7ece?auto=format&fit=crop&w=600&q=60';

        AboutSection::firstOrCreate(['key' => 'home_about'], [
            'label'      => 'Home page: Welcome section',
            'eyebrow'    => 'Welcome to',
            'title'      => 'Unicorn Group — innovation guided by integrity',
            'highlight'  => 'innovation',
            'body'       => "Unicorn Group is a diversified business organization committed to excellence, innovation and reliability across multiple industries — from engineering solutions to modern infrastructure and strategic ventures.\n\nEach of our specialized divisions delivers high-quality products and services while maintaining the highest standards of professionalism and customer satisfaction.",
            'image_main' => $main,
            'image_sub'  => $sub,
            'btn_text'   => 'Read More →',
            'btn_url'    => '/about',
        ]);

        AboutSection::firstOrCreate(['key' => 'about_who'], [
            'label'      => 'About page: Who We Are section',
            'eyebrow'    => 'Who We Are',
            'title'      => 'A group built on trust, faith & service',
            'highlight'  => 'trust, faith & service',
            'body'       => "Unicorn Group is a dynamic and diversified business organization committed to delivering excellence, innovation and reliability across multiple industries. With a strong vision for growth and quality, we have become a trusted name in engineering solutions, modern infrastructure and strategic ventures.\n\nOur group operates through several specialized concerns. Each division is dedicated to high-quality products and services while maintaining the highest standards of professionalism and customer satisfaction.\n\nDriven by innovation and guided by integrity, we create sustainable solutions that contribute to modern development and improved living standards.",
            'image_main' => $main,
            'image_sub'  => $sub,
        ]);
    }
}
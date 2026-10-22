<?php

namespace Database\Seeders;

use App\Models\Management;
use Illuminate\Database\Seeder;

class ManagementSeeder extends Seeder
{
    public function run(): void
    {
        Management::truncate();

        Management::create([
            'role_title'  => "Chairman's Message",
            'name'        => 'Masrur Rahman Pial',
            'designation' => 'Chairman, Unicorn Group',
            'quote'       => 'Growing from a single goal into five specialised companies, on vision and integrity.',
            'message'     => "Welcome to Unicorn Group.\n\nOur journey began with a simple yet powerful vision — to build an organization defined by excellence, trust, and innovation. Today, Unicorn Group stands as a dynamic and diversified enterprise, delivering value through our specialized concerns including Unicorn Elevator, Unicorn Interior, Unicorn Venture Ltd, Unicorn Landmark, and Unicorn Care. At Unicorn Group, we believe progress is driven by vision and sustained by integrity. Every project we undertake reflects our commitment to superior quality, modern innovation, and long-term reliability. Our goal is not only to meet expectations but to consistently exceed them.\n\nAs industries evolve and new opportunities emerge, we remain focused on building solutions that contribute to modern infrastructure, refined living spaces, and sustainable development. With a dedicated team, trusted partners, and valued clients, we continue to grow with confidence and purpose.\n\nThe future of Unicorn Group is guided by ambition, responsibility, and a relentless pursuit of excellence. We are proud of what we have built, and even more excited about what lies ahead.\n\nThank you for being part of our journey.",
            'photo'       => 'https://unicorngroupbd.com/wp-content/uploads/2026/03/WhatsApp-Image-2026-03-09-at-2.58.08-PM.jpeg',
            'sort_order'  => 1,
        ]);

        Management::create([
            'role_title'  => "Managing Director's Message",
            'name'        => 'Mamunur Rashid Raz',
            'designation' => 'Managing Director, Unicorn Group',
            'quote'       => 'Delivering results through new ideas, dependability and ethical conduct.',
            'message'     => "At Unicorn Group, our mission is to deliver excellence through innovation, reliability, and professional integrity. We are committed to creating sustainable value for our clients and partners while continuously improving the quality of our services.\n\nThrough our specialized concerns—Unicorn Elevator, Unicorn Interior, Unicorn Venture Ltd, Unicorn Landmark, and Unicorn Care—we strive to deliver innovative solutions that meet the evolving needs of modern infrastructure and development.\n\nWith a dedicated team and a forward-looking vision, we remain focused on maintaining the highest standards of quality and service as we continue to grow and build a stronger future.",
            'photo'       => null,
            'sort_order'  => 2,
        ]);

        Management::create([
            'role_title'  => "Deputy Managing Director's Message",
            'name'        => 'Ahosan Habib Fahim',
            'designation' => 'Deputy Managing Director, Unicorn Group',
            'quote'       => 'Dependable, innovative work that upholds professional ethics.',
            'message'     => "At Unicorn Group, our mission is to deliver excellence through innovation, reliability, and professional integrity. We are committed to creating sustainable value for our clients and partners while continuously improving the quality of our services.\n\nThrough our specialized concerns—Unicorn Elevator, Unicorn Interior, Unicorn Venture Ltd, Unicorn Landmark, and Unicorn Care—we strive to deliver innovative solutions that meet the evolving needs of modern infrastructure and development.\n\nWith a dedicated team and a forward-looking vision, we remain focused on maintaining the highest standards of quality and service as we continue to grow and build a stronger future.",
            'photo'       => 'https://unicorngroupbd.com/wp-content/uploads/2026/04/WhatsApp-Image-2026-04-11-at-2.02.36-AM.jpeg',
            'sort_order'  => 3,
        ]);
    }
}
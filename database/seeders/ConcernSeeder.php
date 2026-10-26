<?php

namespace Database\Seeders;

use App\Models\Concern;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ConcernSeeder extends Seeder
{
    public function run(): void
    {
        if (Concern::exists()) {
            return;   // never overwrite what the admin already entered
        }

        foreach ($this->data() as $i => $item) {
            $this->make($item, null, $i);
        }
    }

    private function make(array $d, ?Concern $parent, int $i): void
    {
        $children = $d['children'] ?? [];
        unset($d['children']);

        $d['slug']       = $d['slug'] ?? Str::slug($d['title']);
        $d['parent_id']  = $parent?->id;
        $d['path']       = ($parent ? $parent->path . '/' : '') . $d['slug'];
        $d['sort_order'] = $i + 1;

        $concern = Concern::create($d);

        foreach ($children as $k => $child) {
            $this->make($child, $concern, $k);
        }
    }

    private function img(string $id, int $w = 1000): string
    {
        return "https://images.unsplash.com/photo-{$id}?auto=format&fit=crop&w={$w}&q=60";
    }

    private function elevatorBrand(string $title, string $series, string $a, string $b): array
    {
        return [
            'title'    => $title,
            'layout'   => 'brand',
            'eyebrow'  => "Unicorn Elevator · {$series} Series",
            'tagline'  => "{$title} elevators supplied and serviced by Unicorn.",
            'body'     => "Unicorn Elevator supplies and installs {$title} elevators from its {$series} series for buildings that need dependable daily performance.\n\nOur team handles delivery, installation, testing and the service that follows, so the customer deals with one company only.",
            'features' => ['Supply and installation', 'Site survey and shaft check', 'Safety testing and handover', 'Annual maintenance contracts', 'Genuine spare parts', '24/7 breakdown support'],
            'image'    => $this->img($a),
            'image2'   => $this->img($b, 600),
        ];
    }

    private function series(string $title, string $a, string $b, array $brands): array
    {
        return [
            'title'            => $title,
            'layout'           => 'feature',
            'eyebrow'          => 'Unicorn Elevator',
            'heading'          => "The {$title} series",
            'heading_highlight' => $title,
            'tagline'          => "{$title} series elevators supplied and serviced by Unicorn.",
            'body'             => "The {$title} series brings together the elevator brands we supply for this class of building.\n\nEvery brand is installed, tested and serviced by our own technicians.",
            'children_heading' => "Brands in the {$title} series",
            'image'            => $this->img($a),
            'image2'           => $this->img($b, 600),
            'children'         => $brands,
        ];
    }

    private function engine(string $title, string $a, string $b): array
    {
        return [
            'title'    => $title,
            'layout'   => 'brand',
            'eyebrow'  => 'Unicorn Engineering · Generator',
            'tagline'  => "{$title} powered generator sets supplied and serviced by Unicorn.",
            'body'     => "Unicorn Engineering supplies generator sets with {$title} engines for banks, hospitals, factories, supermarkets and residential buildings that cannot afford a power cut.\n\nCapacity, fuel type and canopy are selected to suit the site. Installation, commissioning, after-sales support and maintenance contracts come with every supply.",
            'features' => ['Standby and prime power sets', 'Silent and open types', 'Site survey and load calculation', 'Installation and commissioning', 'Genuine spare parts', 'Maintenance contracts'],
            'image'    => $this->img($a),
            'image2'   => $this->img($b, 600),
        ];
    }

    private function data(): array
    {
        $e1 = '1545259741-2ea3ebf61fa3';
        $e2 = '1600585154340-be6161a56a0c';
        $e3 = '1519501025264-65ba15a82390';
        $e4 = '1486406146926-c627a92ad1ab';
        $g1 = '1581092160562-40aa08e78837';
        $g2 = '1581092918056-0c4c3acd3789';

        return [
            // ---------------------------------------------------------- Venture
            [
                'title' => 'Unicorn Venture Ltd', 'slug' => 'venture', 'layout' => 'feature', 'eyebrow' => 'Our Concern',
                'heading' => 'Imported power and vertical transport equipment', 'heading_highlight' => 'vertical transport',
                'tagline' => 'Importer and service partner for substations, escalators and generators.',
                'body' => "Unicorn Venture Ltd is a Bangladesh-based importer and service partner for substations, escalators and generators.\n\nWe bring in reliable equipment from international makers, supply it to buildings, factories and institutions, and stay with the customer after delivery with installation and service support.\n\nOur aim is simple: dependable products, honest dealings and a team that answers when you call.",
                'cards' => [
                    ['icon' => '🛗', 'title' => 'Escalators', 'text' => 'Supply of escalators and moving walkways for malls, hospitals and public buildings.'],
                    ['icon' => '⚙', 'title' => 'Generators', 'text' => "Standby and prime power generator sets sized to the customer's load."],
                    ['icon' => '⚡', 'title' => 'Substations', 'text' => 'Substation packages with transformers, switchgear and commissioning support.'],
                ],
                'image' => $this->img($g2), 'image2' => $this->img('1581094288338-2314dddb7ece', 600),
                'home_icon' => '⚡', 'home_image' => $this->img('1473341304170-971dccb5ac1e'), 'home_order' => 4,
                'home_text' => 'Importer and service partner for substations, escalators and generators.',
            ],
            // ---------------------------------------------------------- Elevator
            [
                'title' => 'Unicorn Elevator', 'slug' => 'elevator', 'layout' => 'feature', 'eyebrow' => 'Our Concern',
                'heading' => 'Elevators built on quality & safety', 'heading_highlight' => 'quality & safety',
                'tagline' => 'Elevators and escalators from leading makers.',
                'body' => "Unicorn Elevator supplies elevators and escalators sourced from leading makers in China, Turkey, Japan and Korea.\n\nEach brand we work with is installed, tested and serviced by our own technicians, so one team is responsible from delivery to long-term maintenance.",
                'children_heading' => 'Our Brands', 'children_text' => 'The elevator series and brands we supply, install and service.',
                'cards' => [
                    ['icon' => '🛡', 'title' => 'Safety first', 'text' => 'Every installation is load-tested and safety-checked before handover.'],
                    ['icon' => '👷', 'title' => 'Our own technicians', 'text' => 'The same team installs, tests and services every elevator.'],
                    ['icon' => '🔧', 'title' => 'After-sales service', 'text' => 'Maintenance contracts and genuine spare parts.'],
                ],
                'image' => $this->img($e2), 'image2' => $this->img($e1, 600),
                'home_icon' => '🛗', 'home_image' => $this->img($e2), 'home_order' => 1,
                'home_text' => 'Elevators and escalators from leading makers, supplied and serviced with a focus on safety.',
                'children' => [
                    $this->series('Premium', $e1, $e3, [
                        $this->elevatorBrand('Hidoks', 'Premium', $e1, $e3),
                        $this->elevatorBrand('Marsha', 'Premium', $e3, $e4),
                    ]),
                    $this->series('Signature', $e2, $e4, [
                        $this->elevatorBrand('BLT', 'Signature', $e2, $e4),
                        $this->elevatorBrand('IFE', 'Signature', $e4, $e1),
                        $this->elevatorBrand('Xizi', 'Signature', $e1, $e2),
                    ]),
                    $this->series('Essential', $e3, $e1, [
                        $this->elevatorBrand('Fuji SJ', 'Essential', $e3, $e2),
                        $this->elevatorBrand('Ningbo', 'Essential', $e2, $e3),
                        $this->elevatorBrand('Sigma', 'Essential', $e4, $e3),
                    ]),
                    $this->series('Comfort', $e4, $e2, [
                        $this->elevatorBrand('MRF', 'Comfort', $e4, $e1),
                    ]),
                ],
            ],
            // ---------------------------------------------------------- Energy
            [
                'title' => 'Unicorn Energy', 'slug' => 'energy', 'layout' => 'feature', 'eyebrow' => 'Our Concern',
                'heading' => 'Clean power from solar energy', 'heading_highlight' => 'solar energy',
                'tagline' => 'Solar energy solutions for homes, factories and commercial buildings.',
                'body' => "Unicorn Energy works on solar power solutions that cut electricity bills and reduce dependence on the grid.\n\nWe plan, supply and install solar systems for homes, factories and commercial buildings, and support them after installation.",
                'cards' => [
                    ['icon' => '🏠', 'title' => 'Residential', 'text' => 'Rooftop solar for homes and apartment buildings.'],
                    ['icon' => '🏭', 'title' => 'Industrial', 'text' => 'Larger systems that lower running costs for factories.'],
                    ['icon' => '🛠', 'title' => 'After-sales support', 'text' => 'Inspection and maintenance to keep output steady.'],
                ],
                'image' => $this->img('1509391366360-2e959784a276'), 'image2' => $this->img('1508514177221-188b1cf16e9d', 600),
                'home_icon' => '☀', 'home_image' => $this->img('1509391366360-2e959784a276'), 'home_order' => 6,
                'home_text' => 'Solar energy solutions for homes, factories and commercial buildings.',
            ],
            // ---------------------------------------------------------- Care
            [
                'title' => 'Unicorn Care', 'slug' => 'care', 'layout' => 'feature', 'eyebrow' => 'Our Concern',
                'heading' => 'The best technical support', 'heading_highlight' => 'technical support',
                'tagline' => 'The best technical support for elevators, escalators and generators.',
                'body' => "At Unicorn Care we provide the best technical support for elevators, escalators and generators.\n\nOur trained engineers handle installation, regular maintenance and emergency repairs, and we keep the right spare parts ready so equipment is back in service fast.",
                'cards' => [
                    ['icon' => '📞', 'title' => '24/7 response', 'text' => 'A support line that is answered day and night.'],
                    ['icon' => '🧰', 'title' => 'Preventive maintenance', 'text' => 'Scheduled visits that find problems before they stop your building.'],
                    ['icon' => '🔩', 'title' => 'Spare support', 'text' => 'Replacement parts and repair for lifts, escalators and generators.'],
                ],
                'image' => $this->img('1581094288338-2314dddb7ece'), 'image2' => $this->img('1504307651254-35680f356dfd', 600),
                'home_icon' => '🔧', 'home_image' => $this->img('1581094288338-2314dddb7ece'), 'home_order' => 7,
                'home_text' => 'The best technical support for elevators, escalators and generators.',
            ],
            // ---------------------------------------------------------- Interior
            [
                'title' => 'Unicorn Interior', 'slug' => 'interior', 'layout' => 'feature', 'eyebrow' => 'Our Concern',
                'heading' => 'Spaces designed to live and work in', 'heading_highlight' => 'live and work',
                'tagline' => 'Interior design, furniture and fit-out for homes, offices and commercial spaces.',
                'body' => "Unicorn Interior designs and builds interiors for homes, offices, shops and commercial buildings.\n\nFrom the first concept and 3D visual to furniture, finishing and handover, one team looks after the whole job so the finished space matches the design.",
                'cards' => [
                    ['icon' => '✏', 'title' => 'Interior design', 'text' => 'Layout planning, material selection and 3D visuals before work starts.'],
                    ['icon' => '🛋', 'title' => 'Furniture & fit-out', 'text' => 'Custom furniture, partitions, ceilings and lighting made to the design.'],
                    ['icon' => '🏠', 'title' => 'Turnkey delivery', 'text' => 'Supervision, finishing and handover handled by a single team.'],
                ],
                'image' => $this->img('1618221195710-dd6b41faaea6'), 'image2' => $this->img('1616486338812-3dadae4b4ace', 600),
                'home_icon' => '🛋', 'home_image' => $this->img('1618221195710-dd6b41faaea6'), 'home_order' => 5,
                'home_text' => 'Interior design, furniture and fit-out for homes, offices and commercial spaces.',
            ],
            // ---------------------------------------------------------- Engineering
            [
                'title' => 'Unicorn Engineering', 'slug' => 'engineering', 'layout' => 'feature', 'eyebrow' => 'Our Concern',
                'heading' => 'Engineering for power & design', 'heading_highlight' => 'power & design',
                'tagline' => 'Generators, sub-stations and 2D-3D design drawing consultancy.',
                'body' => "Unicorn Engineering covers power equipment and technical design: generators, sub-stations and design drawing consultancy in 2D and 3D.\n\nOne engineering team can plan the system, supply the equipment and support it afterwards.",
                'children_heading' => 'What We Do', 'children_text' => 'Our engineering services.',
                'cards' => [
                    ['icon' => '⚙', 'title' => 'Generators', 'text' => 'Standby and prime power sets, 20 kVA to 3,000 kVA.'],
                    ['icon' => '⚡', 'title' => 'Sub-stations', 'text' => 'Transformer, switchgear and protection packages.'],
                    ['icon' => '📐', 'title' => 'Design drawing', 'text' => '2D and 3D drawings and consultancy.'],
                ],
                'image' => $this->img($g2), 'image2' => $this->img('1473341304170-971dccb5ac1e', 600),
                'home_icon' => '⚙', 'home_image' => $this->img($g2), 'home_order' => 2,
                'home_text' => 'Generators, sub-stations and 2D-3D design drawing consultancy.',
                'children' => [
                    [
                        'title' => 'Generator', 'layout' => 'brand', 'eyebrow' => 'Unicorn Engineering',
                        'tagline' => 'Standby and prime power generator sets, 20 kVA to 3,000 kVA.',
                        'body' => "Banks, hospitals, factories and supermarkets all depend on uninterrupted power. We supply genuine generators from small residential units to large industrial sets.\n\nPrices depend on capacity, engine brand, fuel type and whether the set is silent. After-sales support and maintenance contracts come with every supply.",
                        'features' => ['Capacity from 20 kVA to 3,000 kVA', 'Engines: Cummins, Perkins, Ricardo', 'Alternators: Leroy Somer, Stamford', 'Silent and open types', 'After-sales support', 'Maintenance contracts'],
                        'image' => $this->img($g1), 'image2' => $this->img($g2, 600),
                        'children_heading' => 'Engine brands', 'children_text' => 'Generator sets by engine maker.',
                        'children' => [
                            $this->engine('Cummins', $g1, $g2),
                            $this->engine('Perkins', $g2, $g1),
                            $this->engine('Ricardo', $g1, $g2),
                        ],
                    ],
                    [
                        'title' => 'Sub-station', 'layout' => 'brand', 'eyebrow' => 'Unicorn Engineering',
                        'tagline' => 'Sub-station packages with transformers, switchgear and protection.',
                        'body' => "A sub-station sits between the power plant and the consumer: it steps high voltage down to a usable level, improves power factor and feeds power out through multiple feeders.\n\nWe supply, install and commission sub-stations with transformers, switchgear, protection and metering, backed by local after-sales support in Dhaka.",
                        'features' => ['Transformer and switchgear packages', 'Protection and metering', 'Indoor and outdoor types', 'Testing before handover', 'Commissioning support', 'Local after-sales support'],
                        'image' => $this->img('1473341304170-971dccb5ac1e'), 'image2' => $this->img('1558618666-fcd25c85cd64', 600),
                    ],
                    [
                        'title' => 'Design Drawing Consultancy (2D-3D)', 'slug' => 'design-drawing', 'layout' => 'brand', 'eyebrow' => 'Unicorn Engineering',
                        'tagline' => '2D and 3D design drawings and consultancy.',
                        'body' => "We prepare 2D drawings and 3D models so that owners, architects and contractors can see a plan clearly before work starts.\n\nOur consultancy helps catch clashes and mistakes on paper, where they cost far less to fix than on site.",
                        'features' => ['2D working drawings', '3D models and visualisation', 'Layout and shaft planning', 'Design review and advice', 'Revisions with the client', 'Drawings ready for approval'],
                        'image' => $this->img('1503387762-592deb58ef4e'), 'image2' => $this->img($e4, 600),
                    ],
                ],
            ],
            // ---------------------------------------------------------- Landmark
            [
                'title' => 'Unicorn Landmark', 'slug' => 'landmark', 'layout' => 'feature', 'eyebrow' => 'Our Concern',
                'heading' => 'Building landmarks with trust', 'heading_highlight' => 'landmarks',
                'tagline' => 'Land development, construction, architecture, 3D design and real-estate solutions.',
                'body' => "Unicorn Landmark offers land development, construction, architecture, 3D design and real-estate solutions.\n\nWe are a trusted, innovative and professional team that turns land and ideas into finished buildings.",
                'cards' => [
                    ['icon' => '🗺', 'title' => 'Land development', 'text' => 'Planning and developing land for residential and commercial use.'],
                    ['icon' => '🏗', 'title' => 'Construction', 'text' => 'Quality building work delivered to plan.'],
                    ['icon' => '🏙', 'title' => 'Architecture & 3D', 'text' => 'Architectural design and 3D visuals before construction begins.'],
                ],
                'image' => $this->img($e4), 'image2' => $this->img('1486325212027-8081e485255e', 600),
                'home_icon' => '🏗', 'home_image' => $this->img($e4), 'home_order' => 3,
                'home_text' => 'Land development, construction, architecture, 3D design and real-estate solutions.',
            ],
        ];
    }
}

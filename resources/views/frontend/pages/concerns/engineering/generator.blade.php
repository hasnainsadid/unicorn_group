@extends('frontend.layouts.app')
@section('title', 'Generator')

@section('crumbs')
    <span class="sep">/</span><a href="{{ route('about') }}#concerns">Concerns</a>
    <span class="sep">/</span><a href="{{ route('concern.engineering') }}">Unicorn Engineering</a>
@endsection

@section('content')
    @include('frontend.layouts.partials.breadcrumb')

    <section>
        <div class="container detail-grid">
            <div class="detail">
                <div class="detail-img reveal" style="background-image:url('https://images.unsplash.com/photo-1581092160562-40aa08e78837?auto=format&fit=crop&w=1000&q=60')"></div>
                <span class="eyebrow">Unicorn Engineering</span>
                <h2>Generator</h2>
                <p style="font-weight:600;color:var(--text)">Standby and prime power generator sets, 20 kVA to 3,000 kVA.</p>
                <p>Banks, hospitals, factories and supermarkets all depend on uninterrupted power. We supply genuine generators from small residential units to large industrial sets.</p>
                <p>Prices depend on capacity, engine brand, fuel type and whether the set is silent. After-sales support and maintenance contracts come with every supply.</p>

                <h3>What We Offer</h3>
                <ul class="feat">
                    <li>Capacity from 20 kVA to 3,000 kVA</li>
                    <li>Engines: Cummins, Perkins, Deutz, Volvo</li>
                    <li>Alternators: Leroy Somer, Stamford</li>
                    <li>Silent and open types</li>
                    <li>After-sales support</li>
                    <li>Maintenance contracts</li>
                </ul>

                <div class="detail-img reveal" style="height:300px;margin-top:30px;background-image:url('https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?auto=format&fit=crop&w=600&q=60')"></div>
            </div>

            <aside class="side">
                <div class="side-card">
                    <h4>What We Do</h4>
                    <div class="side-menu">
                        <a href="{{ route('concern.engineering.generator') }}" class="{{ Route::is('concern.engineering.generator') ? 'active' : '' }}">Generator</a>
                        <a href="{{ route('concern.engineering.substation') }}" class="{{ Route::is('concern.engineering.substation') ? 'active' : '' }}">Sub-station</a>
                        <a href="{{ route('concern.engineering.design') }}" class="{{ Route::is('concern.engineering.design') ? 'active' : '' }}">Design Drawing Consultancy (2D-3D)</a>
                    </div>
                </div>
                <div class="cta-box">
                    <h4>Need more details?</h4>
                    <p>Talk to our team about Generator.</p>
                    <a class="btn btn-primary" href="{{ route('contact') }}">Contact Us →</a>
                </div>
            </aside>
        </div>
    </section>
@endsection

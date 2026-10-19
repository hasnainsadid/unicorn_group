@extends('frontend.layouts.app')
@section('title', 'Unicorn Venture Ltd')

@section('crumbs')
    <span class="sep">/</span><a href="{{ route('about') }}#concerns">Concerns</a>
@endsection

@section('content')
    @include('frontend.layouts.partials.breadcrumb')

    <section>
        <div class="container about-grid">
            <div class="about-media reveal">
                <div class="img-main" style="background-image:url('https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?auto=format&fit=crop&w=1000&q=60')"></div>
            <div class="img-sub" style="background-image:url('https://images.unsplash.com/photo-1581094288338-2314dddb7ece?auto=format&fit=crop&w=600&q=60')"></div>
            </div>
            <div class="about-text reveal d2">
                <span class="eyebrow">Our Concern</span>
                <h2 class="section-title">Imported power and <span>vertical transport</span> equipment</h2>
                <p>Unicorn Venture Ltd is a Bangladesh-based importer and service partner for substations, escalators and generators.</p>
                <p>We bring in reliable equipment from international makers, supply it to buildings, factories and institutions, and stay with the customer after delivery with installation and service support.</p>
                <p>Our aim is simple: dependable products, honest dealings and a team that answers when you call.</p>
            </div>
        </div>
    </section>

    <section class="alt">
        <div class="container">
            <div class="mv-grid">
                <div class="mv reveal d0">
                    <div class="ic">🛗</div>
                    <h3>Escalators</h3>
                    <p>Supply of escalators and moving walkways for malls, hospitals and public buildings.</p>
                </div>
                <div class="mv reveal d1">
                    <div class="ic">⚙</div>
                    <h3>Generators</h3>
                    <p>Standby and prime power generator sets sized to the customer's load.</p>
                </div>
                <div class="mv reveal d2">
                    <div class="ic">⚡</div>
                    <h3>Substations</h3>
                    <p>Substation packages with transformers, switchgear and commissioning support.</p>
                </div>
            </div>
        </div>
    </section>
@endsection

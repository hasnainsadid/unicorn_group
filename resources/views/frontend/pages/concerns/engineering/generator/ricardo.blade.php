@extends('frontend.layouts.app')
@section('title', 'Ricardo Generator')

@section('crumbs')
    <span class="sep">/</span><a href="{{ route('about') }}#concerns">Concerns</a>
    <span class="sep">/</span><a href="{{ route('concern.engineering') }}">Unicorn Engineering</a>
    <span class="sep">/</span><a href="{{ route('concern.engineering.generator') }}">Generator</a>
@endsection

@section('content')
    @include('frontend.layouts.partials.breadcrumb')

    <section>
        <div class="container detail-grid">
            <div class="detail">
                <div class="detail-img reveal" style="background-image:url('https://images.unsplash.com/photo-1581092160562-40aa08e78837?auto=format&fit=crop&w=1000&q=60')"></div>
                <span class="eyebrow">Unicorn Engineering &middot; Generator</span>
                <h2>Ricardo</h2>
                <p style="font-weight:600;color:var(--text)">Ricardo powered generator sets supplied and serviced by Unicorn.</p>
                <p>Unicorn Engineering supplies generator sets with Ricardo engines for banks, hospitals, factories, supermarkets and residential buildings that cannot afford a power cut.</p>
                <p>Capacity, fuel type and canopy are selected to suit the site. Installation, commissioning, after-sales support and maintenance contracts come with every supply.</p>

                <h3>What We Offer</h3>
                <ul class="feat">
                    <li>Standby and prime power sets</li>
                    <li>Silent and open types</li>
                    <li>Site survey and load calculation</li>
                    <li>Installation and commissioning</li>
                    <li>Genuine spare parts</li>
                    <li>Maintenance contracts</li>
                </ul>

                <div class="detail-img reveal" style="height:300px;margin-top:30px;background-image:url('https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?auto=format&fit=crop&w=600&q=60')"></div>
            </div>

            <aside class="side">
                @include('frontend.pages.concerns.partials.engineering-menu')
                <div class="cta-box">
                    <h4>Need more details?</h4>
                    <p>Talk to our team about Ricardo generators.</p>
                    <a class="btn btn-primary" href="{{ route('contact') }}">Contact Us &rarr;</a>
                </div>
            </aside>
        </div>
    </section>

    @include('frontend.pages.concerns.partials.catalogue', ['pdf' => 'frontend/catalogs/ricardo.pdf', 'title' => 'Ricardo'])
@endsection

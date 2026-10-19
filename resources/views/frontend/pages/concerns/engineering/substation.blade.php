@extends('frontend.layouts.app')
@section('title', 'Sub-station')

@section('crumbs')
    <span class="sep">/</span><a href="{{ route('about') }}#concerns">Concerns</a>
    <span class="sep">/</span><a href="{{ route('concern.engineering') }}">Unicorn Engineering</a>
@endsection

@section('content')
    @include('frontend.layouts.partials.breadcrumb')

    <section>
        <div class="container detail-grid">
            <div class="detail">
                <div class="detail-img reveal" style="background-image:url('https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?auto=format&fit=crop&w=1000&q=60')"></div>
                <span class="eyebrow">Unicorn Engineering</span>
                <h2>Sub-station</h2>
                <p style="font-weight:600;color:var(--text)">Sub-station packages with transformers, switchgear and protection.</p>
                <p>A sub-station sits between the power plant and the consumer: it steps high voltage down to a usable level, improves power factor and feeds power out through multiple feeders.</p>
                <p>We supply, install and commission sub-stations with transformers, switchgear, protection and metering, backed by local after-sales support in Dhaka.</p>

                <h3>What We Offer</h3>
                <ul class="feat">
                    <li>Transformer and switchgear packages</li>
                    <li>Protection and metering</li>
                    <li>Indoor and outdoor types</li>
                    <li>Testing before handover</li>
                    <li>Commissioning support</li>
                    <li>Local after-sales support</li>
                </ul>

                <div class="detail-img reveal" style="height:300px;margin-top:30px;background-image:url('https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=600&q=60')"></div>
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
                    <p>Talk to our team about Sub-station.</p>
                    <a class="btn btn-primary" href="{{ route('contact') }}">Contact Us →</a>
                </div>
            </aside>
        </div>
    </section>
@endsection

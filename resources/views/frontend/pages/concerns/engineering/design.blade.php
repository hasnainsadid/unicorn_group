@extends('frontend.layouts.app')
@section('title', 'Design Drawing Consultancy (2D-3D)')

@section('crumbs')
    <span class="sep">/</span><a href="{{ route('about') }}#concerns">Concerns</a>
    <span class="sep">/</span><a href="{{ route('concern.engineering') }}">Unicorn Engineering</a>
@endsection

@section('content')
    @include('frontend.layouts.partials.breadcrumb')

    <section>
        <div class="container detail-grid">
            <div class="detail">
                <div class="detail-img reveal" style="background-image:url('https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&w=1000&q=60')"></div>
                <span class="eyebrow">Unicorn Engineering</span>
                <h2>Design Drawing Consultancy (2D-3D)</h2>
                <p style="font-weight:600;color:var(--text)">2D and 3D design drawings and consultancy.</p>
                <p>We prepare 2D drawings and 3D models so that owners, architects and contractors can see a plan clearly before work starts.</p>
                <p>Our consultancy helps catch clashes and mistakes on paper, where they cost far less to fix than on site.</p>

                <h3>What We Offer</h3>
                <ul class="feat">
                    <li>2D working drawings</li>
                    <li>3D models and visualisation</li>
                    <li>Layout and shaft planning</li>
                    <li>Design review and advice</li>
                    <li>Revisions with the client</li>
                    <li>Drawings ready for approval</li>
                </ul>

                <div class="detail-img reveal" style="height:300px;margin-top:30px;background-image:url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=600&q=60')"></div>
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
                    <p>Talk to our team about Design Drawing Consultancy (2D-3D).</p>
                    <a class="btn btn-primary" href="{{ route('contact') }}">Contact Us →</a>
                </div>
            </aside>
        </div>
    </section>
@endsection

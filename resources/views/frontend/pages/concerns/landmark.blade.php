@extends('frontend.layouts.app')
@section('title', 'Unicorn Landmark')

@section('crumbs')
    <span class="sep">/</span><a href="{{ route('about') }}#concerns">Concerns</a>
@endsection

@section('content')
    @include('frontend.layouts.partials.breadcrumb')

    <section>
        <div class="container about-grid">
            <div class="about-media reveal">
                <div class="img-main" style="background-image:url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1000&q=60')"></div>
            <div class="img-sub" style="background-image:url('https://images.unsplash.com/photo-1486325212027-8081e485255e?auto=format&fit=crop&w=600&q=60')"></div>
            </div>
            <div class="about-text reveal d2">
                <span class="eyebrow">Our Concern</span>
                <h2 class="section-title">Building <span>landmarks</span> with trust</h2>
                <p>Unicorn Landmark offers land development, construction, architecture, 3D design and real-estate solutions.</p>
                <p>We are a trusted, innovative and professional team that turns land and ideas into finished buildings.</p>
            </div>
        </div>
    </section>

    <section class="alt">
        <div class="container">
            <div class="mv-grid">
                <div class="mv reveal d0">
                    <div class="ic">🗺</div>
                    <h3>Land development</h3>
                    <p>Planning and developing land for residential and commercial use.</p>
                </div>
                <div class="mv reveal d1">
                    <div class="ic">🏗</div>
                    <h3>Construction</h3>
                    <p>Quality building work delivered to plan.</p>
                </div>
                <div class="mv reveal d2">
                    <div class="ic">🏙</div>
                    <h3>Architecture & 3D</h3>
                    <p>Architectural design and 3D visuals before construction begins.</p>
                </div>
            </div>
        </div>
    </section>
@endsection

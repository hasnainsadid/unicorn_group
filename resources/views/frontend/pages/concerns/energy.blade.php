@extends('frontend.layouts.app')
@section('title', 'Unicorn Energy')

@section('crumbs')
    <span class="sep">/</span><a href="{{ route('about') }}#concerns">Concerns</a>
@endsection

@section('content')
    @include('frontend.layouts.partials.breadcrumb')

    <section>
        <div class="container about-grid">
            <div class="about-media reveal">
                <div class="img-main" style="background-image:url('https://images.unsplash.com/photo-1509391366360-2e959784a276?auto=format&fit=crop&w=1000&q=60')"></div>
            <div class="img-sub" style="background-image:url('https://images.unsplash.com/photo-1508514177221-188b1cf16e9d?auto=format&fit=crop&w=600&q=60')"></div>
            </div>
            <div class="about-text reveal d2">
                <span class="eyebrow">Our Concern</span>
                <h2 class="section-title">Clean power from <span>solar energy</span></h2>
                <p>Unicorn Energy works on solar power solutions that cut electricity bills and reduce dependence on the grid.</p>
                <p>We plan, supply and install solar systems for homes, factories and commercial buildings, and support them after installation.</p>
            </div>
        </div>
    </section>

    <section class="alt">
        <div class="container">
            <div class="mv-grid">
                <div class="mv reveal d0">
                    <div class="ic">🏠</div>
                    <h3>Residential</h3>
                    <p>Rooftop solar for homes and apartment buildings.</p>
                </div>
                <div class="mv reveal d1">
                    <div class="ic">🏭</div>
                    <h3>Industrial</h3>
                    <p>Larger systems that lower running costs for factories.</p>
                </div>
                <div class="mv reveal d2">
                    <div class="ic">🛠</div>
                    <h3>After-sales support</h3>
                    <p>Inspection and maintenance to keep output steady.</p>
                </div>
            </div>
        </div>
    </section>
@endsection

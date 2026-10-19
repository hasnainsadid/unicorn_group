@extends('frontend.layouts.app')
@section('title', 'Unicorn Care')

@section('crumbs')
    <span class="sep">/</span><a href="{{ route('about') }}#concerns">Concerns</a>
@endsection

@section('content')
    @include('frontend.layouts.partials.breadcrumb')

    <section>
        <div class="container about-grid">
            <div class="about-media reveal">
                <div class="img-main" style="background-image:url('https://images.unsplash.com/photo-1581094288338-2314dddb7ece?auto=format&fit=crop&w=1000&q=60')"></div>
            <div class="img-sub" style="background-image:url('https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=600&q=60')"></div>
            </div>
            <div class="about-text reveal d2">
                <span class="eyebrow">Our Concern</span>
                <h2 class="section-title">The best <span>technical support</span></h2>
                <p>At Unicorn Care we provide the best technical support for elevators, escalators and generators.</p>
                <p>Our trained engineers handle installation, regular maintenance and emergency repairs, and we keep the right spare parts ready so equipment is back in service fast.</p>
            </div>
        </div>
    </section>

    <section class="alt">
        <div class="container">
            <div class="mv-grid">
                <div class="mv reveal d0">
                    <div class="ic">📞</div>
                    <h3>24/7 response</h3>
                    <p>A support line that is answered day and night.</p>
                </div>
                <div class="mv reveal d1">
                    <div class="ic">🧰</div>
                    <h3>Preventive maintenance</h3>
                    <p>Scheduled visits that find problems before they stop your building.</p>
                </div>
                <div class="mv reveal d2">
                    <div class="ic">🔩</div>
                    <h3>Spare support</h3>
                    <p>Replacement parts and repair for lifts, escalators and generators.</p>
                </div>
            </div>
        </div>
    </section>
@endsection

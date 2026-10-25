@extends('frontend.layouts.app')
@section('title', 'Hidoks')

@section('crumbs')
    <span class="sep">/</span><a href="{{ route('about') }}#concerns">Concerns</a>
    <span class="sep">/</span><a href="{{ route('concern.elevator') }}">Unicorn Elevator</a>
@endsection

@section('content')
    @include('frontend.layouts.partials.breadcrumb')

    <section>
        <div class="container detail-grid">
            <div class="detail">
                <div class="detail-img reveal" style="background-image:url('https://images.unsplash.com/photo-1545259741-2ea3ebf61fa3?auto=format&fit=crop&w=1000&q=60')"></div>
                <span class="eyebrow">Unicorn Elevator</span>
                <h2>Hidoks</h2>
                <p style="font-weight:600;color:var(--text)">Hidoks elevators supplied and serviced by Unicorn.</p>
                <p>Unicorn Elevator supplies and installs Hidoks elevators for buildings that need dependable daily performance.</p>
                <p>Our team handles delivery, installation, testing and the service that follows, so the customer deals with one company only.</p>

                <h3>What We Offer</h3>
                <ul class="feat">
                    <li>Supply and installation</li>
                    <li>Site survey and shaft check</li>
                    <li>Safety testing and handover</li>
                    <li>Annual maintenance contracts</li>
                    <li>Genuine spare parts</li>
                    <li>24/7 breakdown support</li>
                </ul>

                <div class="detail-img reveal" style="height:300px;margin-top:30px;background-image:url('https://images.unsplash.com/photo-1519501025264-65ba15a82390?auto=format&fit=crop&w=600&q=60')"></div>
            </div>

            <aside class="side">
                <div class="side-card">
                    <h4>Our Brands</h4>
                    <div class="side-menu">
                        <a href="{{ route('concern.elevator.blt') }}" class="{{ Route::is('concern.elevator.blt') ? 'active' : '' }}">BLT</a>
                        <a href="{{ route('concern.elevator.hidoks') }}" class="{{ Route::is('concern.elevator.hidoks') ? 'active' : '' }}">Hidoks</a>
                        <a href="{{ route('concern.elevator.sigma') }}" class="{{ Route::is('concern.elevator.sigma') ? 'active' : '' }}">Sigma</a>
                    </div>
                </div>
                <div class="cta-box">
                    <h4>Need more details?</h4>
                    <p>Talk to our team about Hidoks.</p>
                    <a class="btn btn-primary" href="{{ route('contact') }}">Contact Us →</a>
                </div>
            </aside>
        </div>
    </section>
    @include('frontend.pages.concerns.partials.catalogue', ['pdf' => 'frontend/catalogs/hidoks.pdf', 'title' => 'Hidoks'])
@endsection

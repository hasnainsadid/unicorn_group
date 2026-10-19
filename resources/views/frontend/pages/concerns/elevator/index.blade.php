@extends('frontend.layouts.app')
@section('title', 'Unicorn Elevator')

@section('crumbs')
    <span class="sep">/</span><a href="{{ route('about') }}#concerns">Concerns</a>
@endsection

@section('content')
    @include('frontend.layouts.partials.breadcrumb')

    <section>
        <div class="container about-grid">
            <div class="about-media reveal">
                <div class="img-main" style="background-image:url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1000&q=60')"></div>
            <div class="img-sub" style="background-image:url('https://images.unsplash.com/photo-1545259741-2ea3ebf61fa3?auto=format&fit=crop&w=600&q=60')"></div>
            </div>
            <div class="about-text reveal d2">
                <span class="eyebrow">Our Concern</span>
                <h2 class="section-title">Elevators built on <span>quality &amp; safety</span></h2>
                <p>Unicorn Elevator supplies elevators and escalators sourced from leading makers in China, Turkey, Japan and Korea.</p>
                <p>Each brand we work with is installed, tested and serviced by our own technicians, so one team is responsible from delivery to long-term maintenance.</p>
            </div>
        </div>
    </section>

    <section class="alt">
        <div class="container">
            <div class="section-head center reveal"><span class="eyebrow">Unicorn Elevator</span>
                <h2 class="section-title">Our Brands</h2>
                <p class="section-sub">The elevator brands we supply, install and service.</p>
            </div>
            <div class="grid-3">
                    <div class="item">
                        <article class="p-card tilt">
                            <div class="p-img">
                                <div style="background-image:url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1000&q=60')"></div>
                                <span class="tag">Unicorn Elevator</span>
                            </div>
                            <div class="p-body">
                                <h3>BLT</h3>
                                <p>BLT elevators supplied and serviced by Unicorn.</p>
                                <a class="more" href="{{ route('concern.elevator.blt') }}">Learn more <span>→</span></a>
                            </div>
                        </article>
                    </div>
                    <div class="item">
                        <article class="p-card tilt">
                            <div class="p-img">
                                <div style="background-image:url('https://images.unsplash.com/photo-1545259741-2ea3ebf61fa3?auto=format&fit=crop&w=1000&q=60')"></div>
                                <span class="tag">Unicorn Elevator</span>
                            </div>
                            <div class="p-body">
                                <h3>Hidoks</h3>
                                <p>Hidoks elevators supplied and serviced by Unicorn.</p>
                                <a class="more" href="{{ route('concern.elevator.hidoks') }}">Learn more <span>→</span></a>
                            </div>
                        </article>
                    </div>
                    <div class="item">
                        <article class="p-card tilt">
                            <div class="p-img">
                                <div style="background-image:url('https://images.unsplash.com/photo-1486325212027-8081e485255e?auto=format&fit=crop&w=1000&q=60')"></div>
                                <span class="tag">Unicorn Elevator</span>
                            </div>
                            <div class="p-body">
                                <h3>Sigma</h3>
                                <p>Sigma elevators supplied and serviced by Unicorn.</p>
                                <a class="more" href="{{ route('concern.elevator.sigma') }}">Learn more <span>→</span></a>
                            </div>
                        </article>
                    </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="mv-grid">
                <div class="mv reveal d0">
                    <div class="ic">🛡</div>
                    <h3>Safety first</h3>
                    <p>Every installation is load-tested and safety-checked before handover.</p>
                </div>
                <div class="mv reveal d1">
                    <div class="ic">🔧</div>
                    <h3>Own service team</h3>
                    <p>Installation, maintenance and spare support from the same company.</p>
                </div>
                <div class="mv reveal d2">
                    <div class="ic">🏢</div>
                    <h3>Every building type</h3>
                    <p>Passenger, hospital, freight, panoramic and villa lifts.</p>
                </div>
            </div>
        </div>
    </section>
@endsection

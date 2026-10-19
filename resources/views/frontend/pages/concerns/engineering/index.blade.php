@extends('frontend.layouts.app')
@section('title', 'Unicorn Engineering')

@section('crumbs')
    <span class="sep">/</span><a href="{{ route('about') }}#concerns">Concerns</a>
@endsection

@section('content')
    @include('frontend.layouts.partials.breadcrumb')

    <section>
        <div class="container about-grid">
            <div class="about-media reveal">
                <div class="img-main" style="background-image:url('https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?auto=format&fit=crop&w=1000&q=60')"></div>
            <div class="img-sub" style="background-image:url('https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?auto=format&fit=crop&w=600&q=60')"></div>
            </div>
            <div class="about-text reveal d2">
                <span class="eyebrow">Our Concern</span>
                <h2 class="section-title">Engineering for <span>power &amp; design</span></h2>
                <p>Unicorn Engineering covers power equipment and technical design: generators, sub-stations and design drawing consultancy in 2D and 3D.</p>
                <p>One engineering team can plan the system, supply the equipment and support it afterwards.</p>
            </div>
        </div>
    </section>

    <section class="alt">
        <div class="container">
            <div class="section-head center reveal"><span class="eyebrow">Unicorn Engineering</span>
                <h2 class="section-title">What We Do</h2>
                <p class="section-sub">Our engineering services.</p>
            </div>
            <div class="grid-3">
                    <div class="item">
                        <article class="p-card tilt">
                            <div class="p-img">
                                <div style="background-image:url('https://images.unsplash.com/photo-1581092160562-40aa08e78837?auto=format&fit=crop&w=1000&q=60')"></div>
                                <span class="tag">Unicorn Engineering</span>
                            </div>
                            <div class="p-body">
                                <h3>Generator</h3>
                                <p>Standby and prime power generator sets, 20 kVA to 3,000 kVA.</p>
                                <a class="more" href="{{ route('concern.engineering.generator') }}">Learn more <span>→</span></a>
                            </div>
                        </article>
                    </div>
                    <div class="item">
                        <article class="p-card tilt">
                            <div class="p-img">
                                <div style="background-image:url('https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?auto=format&fit=crop&w=1000&q=60')"></div>
                                <span class="tag">Unicorn Engineering</span>
                            </div>
                            <div class="p-body">
                                <h3>Sub-station</h3>
                                <p>Sub-station packages with transformers, switchgear and protection.</p>
                                <a class="more" href="{{ route('concern.engineering.substation') }}">Learn more <span>→</span></a>
                            </div>
                        </article>
                    </div>
                    <div class="item">
                        <article class="p-card tilt">
                            <div class="p-img">
                                <div style="background-image:url('https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&w=1000&q=60')"></div>
                                <span class="tag">Unicorn Engineering</span>
                            </div>
                            <div class="p-body">
                                <h3>Design Drawing Consultancy (2D-3D)</h3>
                                <p>2D and 3D design drawings and consultancy.</p>
                                <a class="more" href="{{ route('concern.engineering.design') }}">Learn more <span>→</span></a>
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
                    <div class="ic">⚙</div>
                    <h3>Generators</h3>
                    <p>Standby and prime power sets, 20 kVA to 3,000 kVA.</p>
                </div>
                <div class="mv reveal d1">
                    <div class="ic">⚡</div>
                    <h3>Sub-stations</h3>
                    <p>Design, supply and commissioning of sub-station packages.</p>
                </div>
                <div class="mv reveal d2">
                    <div class="ic">📐</div>
                    <h3>Design drawing</h3>
                    <p>2D and 3D drawings and consultancy for buildings and plants.</p>
                </div>
            </div>
        </div>
    </section>
@endsection

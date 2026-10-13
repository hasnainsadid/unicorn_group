@extends('frontend.layouts.app')
@section('title', 'Products')
@section('content')
    @include('frontend.layouts.partials.breadcrumb')
    {{-- @include('frontend.pages.project.sections.project') --}}
    <section>
        <div class="container">
            <div class="section-head center reveal"><span class="eyebrow">Our Products</span>
                <h2 class="section-title">Safety, Comfort &amp; <span>Fast Support</span></h2>
                <p class="section-sub">A complete range of engineered systems built for performance, durability and peace of
                    mind.</p>
            </div>
            <div class="grid-3" id="prodGrid">
                <div class="item" data-cat="lift">
                    <article class="p-card tilt">
                        <div class="p-img">
                            <div
                                style="background-image:url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=60')">
                            </div><span class="tag">Lift</span><span class="p-icon">🛗</span>
                        </div>
                        <div class="p-body">
                            <h3>Passenger Lift</h3>
                            <p>Smooth, silent and energy-efficient lifts for offices, apartments and commercial towers.</p>
                            <a class="more" href="passenger-lift.html">Learn more <span>→</span></a>
                        </div>
                    </article>
                </div>
                <div class="item" data-cat="lift">
                    <article class="p-card tilt">
                        <div class="p-img">
                            <div
                                style="background-image:url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=800&q=60')">
                            </div><span class="tag">Lift</span><span class="p-icon">🏥</span>
                        </div>
                        <div class="p-body">
                            <h3>Hospital / Bed Lift</h3>
                            <p>Spacious, hygienic cabins with precise levelling for patient transport.</p><a class="more"
                                href="hospital-bed-lift.html">Learn more <span>→</span></a>
                        </div>
                    </article>
                </div>
                <div class="item" data-cat="lift">
                    <article class="p-card tilt">
                        <div class="p-img">
                            <div
                                style="background-image:url('https://images.unsplash.com/photo-1486325212027-8081e485255e?auto=format&fit=crop&w=800&q=60')">
                            </div><span class="tag">Lift</span><span class="p-icon">🚗</span>
                        </div>
                        <div class="p-body">
                            <h3>Car Lift</h3>
                            <p>Heavy-duty car lifts for basements, parking structures and showrooms.</p><a class="more"
                                href="car-lift.html">Learn more <span>→</span></a>
                        </div>
                    </article>
                </div>
                <div class="item" data-cat="lift">
                    <article class="p-card tilt">
                        <div class="p-img">
                            <div
                                style="background-image:url('https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=800&q=60')">
                            </div><span class="tag">Lift</span><span class="p-icon">📦</span>
                        </div>
                        <div class="p-body">
                            <h3>Freight / Cargo Lift</h3>
                            <p>Rugged goods lifts for factories, warehouses and commercial kitchens.</p><a class="more"
                                href="freight-cargo-lift.html">Learn more <span>→</span></a>
                        </div>
                    </article>
                </div>
                <div class="item" data-cat="lift">
                    <article class="p-card tilt">
                        <div class="p-img">
                            <div
                                style="background-image:url('https://images.unsplash.com/photo-1545259741-2ea3ebf61fa3?auto=format&fit=crop&w=800&q=60')">
                            </div><span class="tag">Lift</span><span class="p-icon">🔭</span>
                        </div>
                        <div class="p-body">
                            <h3>Observation Lift</h3>
                            <p>Glass-walled lifts that turn every ride into a view.</p><a class="more"
                                href="observation-lift.html">Learn more <span>→</span></a>
                        </div>
                    </article>
                </div>
                <div class="item" data-cat="lift">
                    <article class="p-card tilt">
                        <div class="p-img">
                            <div
                                style="background-image:url('https://images.unsplash.com/photo-1545259741-2ea3ebf61fa3?auto=format&fit=crop&w=800&q=60')">
                            </div><span class="tag">Lift</span><span class="p-icon">🌆</span>
                        </div>
                        <div class="p-body">
                            <h3>Panoramic Lift</h3>
                            <p>Fully glazed lifts for malls, hotels and high-rise facades.</p><a class="more"
                                href="panoramic-lift.html">Learn more <span>→</span></a>
                        </div>
                    </article>
                </div>
                <div class="item" data-cat="lift">
                    <article class="p-card tilt">
                        <div class="p-img">
                            <div
                                style="background-image:url('https://images.unsplash.com/photo-1486325212027-8081e485255e?auto=format&fit=crop&w=800&q=60')">
                            </div><span class="tag">Lift</span><span class="p-icon">💊</span>
                        </div>
                        <div class="p-body">
                            <h3>Capsule Lift</h3>
                            <p>Compact, curved-glass capsule lifts with a distinctive design.</p><a class="more"
                                href="capsule-lift.html">Learn more <span>→</span></a>
                        </div>
                    </article>
                </div>
                <div class="item" data-cat="lift">
                    <article class="p-card tilt">
                        <div class="p-img">
                            <div
                                style="background-image:url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=800&q=60')">
                            </div><span class="tag">Lift</span><span class="p-icon">🏡</span>
                        </div>
                        <div class="p-body">
                            <h3>Villa Lift</h3>
                            <p>Elegant home lifts for villas, duplexes and townhouses.</p><a class="more"
                                href="villa-lift.html">Learn
                                more <span>→</span></a>
                        </div>
                    </article>
                </div>
                <div class="item" data-cat="lift">
                    <article class="p-card tilt">
                        <div class="p-img">
                            <div
                                style="background-image:url('https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=800&q=60')">
                            </div><span class="tag">Lift</span><span class="p-icon">🍽</span>
                        </div>
                        <div class="p-body">
                            <h3>Dumbwaiter</h3>
                            <p>Small service lifts for restaurants, hotels and homes.</p><a class="more"
                                href="dumbwaiter.html">Learn
                                more <span>→</span></a>
                        </div>
                    </article>
                </div>
                <div class="item" data-cat="escalator">
                    <article class="p-card tilt">
                        <div class="p-img">
                            <div
                                style="background-image:url('https://images.unsplash.com/photo-1519501025264-65ba15a82390?auto=format&fit=crop&w=800&q=60')">
                            </div><span class="tag">Escalator</span><span class="p-icon">↗</span>
                        </div>
                        <div class="p-body">
                            <h3>Escalator</h3>
                            <p>Heavy-duty escalators for malls, airports and transit hubs.</p><a class="more"
                                href="escalator.html">Learn more <span>→</span></a>
                        </div>
                    </article>
                </div>
                <div class="item" data-cat="escalator">
                    <article class="p-card tilt">
                        <div class="p-img">
                            <div
                                style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/03/MOVING-WALKWAYS-ri95kmgvksyr3yl9bqwzk0a1d927pf7uxa1ewnhe2w-300x300.jpg')">
                            </div><span class="tag">Walkway</span><span class="p-icon">➡</span>
                        </div>
                        <div class="p-body">
                            <h3>Moving Walkways</h3>
                            <p>Flat and inclined walkways for long concourses and terminals.</p><a class="more"
                                href="moving-walkways.html">Learn more <span>→</span></a>
                        </div>
                    </article>
                </div>
                <div class="item" data-cat="power">
                    <article class="p-card tilt">
                        <div class="p-img">
                            <div
                                style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/03/p-04-01-01-scaled-rjhrwj4s590e8ibtyofonu4fr0o09102iug1zrgv48-300x300.webp')">
                            </div><span class="tag">Power</span><span class="p-icon">⚙</span>
                        </div>
                        <div class="p-body">
                            <h3>Generator</h3>
                            <p>Diesel and gas generator sets for continuous and standby power.</p><a class="more"
                                href="generator.html">Learn more <span>→</span></a>
                        </div>
                    </article>
                </div>
                <div class="item" data-cat="power">
                    <article class="p-card tilt">
                        <div class="p-img">
                            <div
                                style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/03/p-03-01-scaled-rjhrwbm2mkpj71aguii7ks6qm38v9k718bqc4l91gg-300x240.webp')">
                            </div><span class="tag">Power</span><span class="p-icon">⚡</span>
                        </div>
                        <div class="p-body">
                            <h3>Substation</h3>
                            <p>Reliable power distribution and substation solutions.</p><a class="more"
                                href="substation.html">Learn
                                more <span>→</span></a>
                        </div>
                    </article>
                </div>
                <div class="item" data-cat="power">
                    <article class="p-card tilt">
                        <div class="p-img">
                            <div
                                style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/03/p-05-01-01-scaled-rjhrwwaisxhuaggfhrg03myvokexywh4n630ooednk-300x240.webp')">
                            </div><span class="tag">Power</span><span class="p-icon">🔌</span>
                        </div>
                        <div class="p-body">
                            <h3>Busbar Trunking (BBT)</h3>
                            <p>Exclusive Bangladesh distribution of EPE (Malaysia) bus duct systems, 100 A to 6300 A.</p><a
                                class="more" href="busbar-trunking.html">Learn more <span>→</span></a>
                        </div>
                    </article>
                </div>
                <div class="item" data-cat="auto">
                    <article class="p-card tilt">
                        <div class="p-img">
                            <div
                                style="background-image:url('https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=800&q=60')">
                            </div><span class="tag">Smart</span><span class="p-icon">🤖</span>
                        </div>
                        <div class="p-body">
                            <h3>Automation System</h3>
                            <p>Smart building control and monitoring to cut costs and improve safety.</p><a class="more"
                                href="automation-system.html">Learn more <span>→</span></a>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection
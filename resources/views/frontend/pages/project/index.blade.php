@extends('frontend.layouts.app')
@section('title', 'Project')
@section('content')
    @include('frontend.layouts.partials.breadcrumb')
    {{-- @include('frontend.pages.project.sections.project') --}}
    <section>
        <div class="container">
            <div class="section-head center reveal"><span class="eyebrow">Our Projects</span>
                <h2 class="section-title">Work We're <span>Proud</span> Of</h2>
                <p class="section-sub">A selection of buildings where our lifts and escalators are in service.</p>
            </div>
            <div class="grid-3" id="projGrid">
                <div class="item">
                    <article class="p-card tilt">
                        <div class="p-img" style="aspect-ratio:3/4;height:auto">
                            <div
                                style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/03/project-06-2.jpg');height:100%">
                            </div>
                        </div>
                        <div class="p-body" style="padding-top:22px">
                            <h3>Amin Mohammad-Green Arcedia</h3>
                        </div>
                    </article>
                </div>
                <div class="item">
                    <article class="p-card tilt">
                        <div class="p-img" style="aspect-ratio:3/4;height:auto">
                            <div
                                style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/03/project-05.jpg');height:100%">
                            </div>
                        </div>
                        <div class="p-body" style="padding-top:22px">
                            <h3>Bays Bellavista</h3>
                        </div>
                    </article>
                </div>
                <div class="item">
                    <article class="p-card tilt">
                        <div class="p-img" style="aspect-ratio:3/4;height:auto">
                            <div
                                style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/03/project-04.jpg');height:100%">
                            </div>
                        </div>
                        <div class="p-body" style="padding-top:22px">
                            <h3>CARe Medical College Hospital</h3>
                        </div>
                    </article>
                </div>
                <div class="item">
                    <article class="p-card tilt">
                        <div class="p-img" style="aspect-ratio:3/4;height:auto">
                            <div
                                style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/03/project-03-1.jpg');height:100%">
                            </div>
                        </div>
                        <div class="p-body" style="padding-top:22px">
                            <h3>Nexus Hospitals Bangladesh</h3>
                        </div>
                    </article>
                </div>
                <div class="item">
                    <article class="p-card tilt">
                        <div class="p-img" style="aspect-ratio:3/4;height:auto">
                            <div
                                style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/03/project-02-683x1024.jpg');height:100%">
                            </div>
                        </div>
                        <div class="p-body" style="padding-top:22px">
                            <h3>Sel-Tareque Garden</h3>
                        </div>
                    </article>
                </div>
                <div class="item">
                    <article class="p-card tilt">
                        <div class="p-img" style="aspect-ratio:3/4;height:auto">
                            <div
                                style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/03/project-01-1-683x1024.webp');height:100%">
                            </div>
                        </div>
                        <div class="p-body" style="padding-top:22px">
                            <h3>SHR Tower</h3>
                        </div>
                    </article>
                </div>
                <div class="item">
                    <article class="p-card tilt">
                        <div class="p-img" style="aspect-ratio:3/4;height:auto">
                            <div
                                style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/03/SHR-Tower-Chattogram-5-768x1152.jpg');height:100%">
                            </div>
                        </div>
                        <div class="p-body" style="padding-top:22px">
                            <h3>SHR Tower-Chattogram</h3>
                        </div>
                    </article>
                </div>
                <div class="item">
                    <article class="p-card tilt">
                        <div class="p-img" style="aspect-ratio:3/4;height:auto">
                            <div
                                style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/03/Square-Hospital-Extension-Wing-1-768x1152.jpg');height:100%">
                            </div>
                        </div>
                        <div class="p-body" style="padding-top:22px">
                            <h3>Square Hospital-Extension Wing</h3>
                        </div>
                    </article>
                </div>
                <div class="item">
                    <article class="p-card tilt">
                        <div class="p-img" style="aspect-ratio:3/4;height:auto">
                            <div
                                style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/03/STARPAT-DREAM-ROSEATE-1-768x1152.jpg');height:100%">
                            </div>
                        </div>
                        <div class="p-body" style="padding-top:22px">
                            <h3>STARPAT-DREAM ROSEATE</h3>
                        </div>
                    </article>
                </div>
                <div class="item">
                    <article class="p-card tilt">
                        <div class="p-img" style="aspect-ratio:3/4;height:auto">
                            <div
                                style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/03/Union-CYPRESS-683x1024.jpg');height:100%">
                            </div>
                        </div>
                        <div class="p-body" style="padding-top:22px">
                            <h3>Union CYPRESS</h3>
                        </div>
                    </article>
                </div>
                <div class="item">
                    <article class="p-card tilt">
                        <div class="p-img" style="aspect-ratio:3/4;height:auto">
                            <div
                                style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/03/Vision-Eye-Hospital-1-768x1152.webp');height:100%">
                            </div>
                        </div>
                        <div class="p-body" style="padding-top:22px">
                            <h3>Vision Eye Hospital</h3>
                        </div>
                    </article>
                </div>
                <div class="item">
                    <article class="p-card tilt">
                        <div class="p-img" style="aspect-ratio:3/4;height:auto">
                            <div
                                style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/03/Union-MUNSHI-CRYSTAL-PALACE-1-768x1152.webp');height:100%">
                            </div>
                        </div>
                        <div class="p-body" style="padding-top:22px">
                            <h3>Union-MUNSHI CRYSTAL PALACE</h3>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection

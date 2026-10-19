@extends('frontend.layouts.app')
@section('title', 'Completed Projects')

@section('crumbs')
    <span class="sep">/</span><a href="{{ route('gallery') }}">Gallery</a>
@endsection

@section('content')
    @include('frontend.layouts.partials.breadcrumb')
    <section>
        <div class="container">
            <div class="section-head center reveal"><span class="eyebrow">Gallery</span>
                <h2 class="section-title">Completed Projects</h2>
                <p class="section-sub">Buildings where our lifts and escalators are in service. Click any photo to view it larger.</p>
            </div>
            <div class="gal-grid">
                <div class="gal reveal d0" data-full="https://unicorngroupbd.com/wp-content/uploads/2026/03/project-06-2.jpg"
                    style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/03/project-06-2.jpg')">
                    <div class="cap"><b>Amin Mohammad-Green Arcedia</b></div>
                </div>
                <div class="gal reveal d1" data-full="https://unicorngroupbd.com/wp-content/uploads/2026/03/project-05.jpg"
                    style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/03/project-05.jpg')">
                    <div class="cap"><b>Bays Bellavista</b></div>
                </div>
                <div class="gal reveal d2" data-full="https://unicorngroupbd.com/wp-content/uploads/2026/03/project-04.jpg"
                    style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/03/project-04.jpg')">
                    <div class="cap"><b>CARe Medical College Hospital</b></div>
                </div>
                <div class="gal reveal d0" data-full="https://unicorngroupbd.com/wp-content/uploads/2026/03/project-03-1.jpg"
                    style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/03/project-03-1.jpg')">
                    <div class="cap"><b>Nexus Hospitals Bangladesh</b></div>
                </div>
                <div class="gal reveal d1" data-full="https://unicorngroupbd.com/wp-content/uploads/2026/03/project-02-683x1024.jpg"
                    style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/03/project-02-683x1024.jpg')">
                    <div class="cap"><b>Sel-Tareque Garden</b></div>
                </div>
                <div class="gal reveal d2" data-full="https://unicorngroupbd.com/wp-content/uploads/2026/03/project-01-1-683x1024.webp"
                    style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/03/project-01-1-683x1024.webp')">
                    <div class="cap"><b>SHR Tower</b></div>
                </div>
                <div class="gal reveal d0" data-full="https://unicorngroupbd.com/wp-content/uploads/2026/03/SHR-Tower-Chattogram-5-768x1152.jpg"
                    style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/03/SHR-Tower-Chattogram-5-768x1152.jpg')">
                    <div class="cap"><b>SHR Tower-Chattogram</b></div>
                </div>
                <div class="gal reveal d1" data-full="https://unicorngroupbd.com/wp-content/uploads/2026/03/Square-Hospital-Extension-Wing-1-768x1152.jpg"
                    style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/03/Square-Hospital-Extension-Wing-1-768x1152.jpg')">
                    <div class="cap"><b>Square Hospital-Extension Wing</b></div>
                </div>
                <div class="gal reveal d2" data-full="https://unicorngroupbd.com/wp-content/uploads/2026/03/STARPAT-DREAM-ROSEATE-1-768x1152.jpg"
                    style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/03/STARPAT-DREAM-ROSEATE-1-768x1152.jpg')">
                    <div class="cap"><b>STARPAT-DREAM ROSEATE</b></div>
                </div>
                <div class="gal reveal d0" data-full="https://unicorngroupbd.com/wp-content/uploads/2026/03/Union-CYPRESS-683x1024.jpg"
                    style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/03/Union-CYPRESS-683x1024.jpg')">
                    <div class="cap"><b>Union CYPRESS</b></div>
                </div>
                <div class="gal reveal d1" data-full="https://unicorngroupbd.com/wp-content/uploads/2026/03/Vision-Eye-Hospital-1-768x1152.webp"
                    style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/03/Vision-Eye-Hospital-1-768x1152.webp')">
                    <div class="cap"><b>Vision Eye Hospital</b></div>
                </div>
                <div class="gal reveal d2" data-full="https://unicorngroupbd.com/wp-content/uploads/2026/03/Union-MUNSHI-CRYSTAL-PALACE-1-768x1152.webp"
                    style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/03/Union-MUNSHI-CRYSTAL-PALACE-1-768x1152.webp')">
                    <div class="cap"><b>Union-MUNSHI CRYSTAL PALACE</b></div>
                </div>
            </div>
            <div style="text-align:center;margin-top:40px">
                <a href="{{ route('gallery') }}" class="btn btn-ghost">← All folders</a>
            </div>
        </div>
    </section>

    {{-- Lightbox (layout e comment kora, tai ekhane) --}}
    <div class="lightbox" id="lightbox"><button class="close" id="lbClose" aria-label="Close">✕</button><img
            id="lbImg" alt="">
        <div class="lc" id="lbCap"></div>
    </div>
@endsection

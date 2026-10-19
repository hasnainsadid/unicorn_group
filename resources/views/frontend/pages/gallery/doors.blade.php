@extends('frontend.layouts.app')
@section('title', 'Doors &amp; Entrances')

@section('crumbs')
    <span class="sep">/</span><a href="{{ route('gallery') }}">Gallery</a>
@endsection

@section('content')
    @include('frontend.layouts.partials.breadcrumb')
    <section>
        <div class="container">
            <div class="section-head center reveal"><span class="eyebrow">Gallery</span>
                <h2 class="section-title">Doors &amp; Entrances</h2>
                <p class="section-sub">Door and entrance designs. Click any photo to view it larger.</p>
            </div>
            <div class="gal-grid">
                <div class="gal reveal d0" data-full="https://unicorngroupbd.com/wp-content/uploads/2026/04/baranda-door.png"
                    style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/04/baranda-door.png')">
                    <div class="cap"><b>Veranda Door</b></div>
                </div>
                <div class="gal reveal d1" data-full="https://unicorngroupbd.com/wp-content/uploads/2026/04/staff-room-door-1.webp"
                    style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/04/staff-room-door-1.webp')">
                    <div class="cap"><b>Staff Room Door</b></div>
                </div>
                <div class="gal reveal d2" data-full="https://unicorngroupbd.com/wp-content/uploads/2026/04/chairman-entry-room-wooden-door.webp"
                    style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/04/chairman-entry-room-wooden-door.webp')">
                    <div class="cap"><b>Chairman Entry Room Door</b></div>
                </div>
                <div class="gal reveal d0" data-full="https://unicorngroupbd.com/wp-content/uploads/2026/04/emaegency-exit-1.webp"
                    style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/04/emaegency-exit-1.webp')">
                    <div class="cap"><b>Emergency Exit</b></div>
                </div>
                <div class="gal reveal d1" data-full="https://unicorngroupbd.com/wp-content/uploads/2026/04/kitchern-door-design.webp"
                    style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/04/kitchern-door-design.webp')">
                    <div class="cap"><b>Kitchen Door</b></div>
                </div>
                <div class="gal reveal d2" data-full="https://unicorngroupbd.com/wp-content/uploads/2026/04/staff-room-door-1-1.webp"
                    style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/04/staff-room-door-1-1.webp')">
                    <div class="cap"><b>Staff Room Door (2)</b></div>
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

@extends('frontend.layouts.app')
@section('title', 'Gallery')
@section('content')
    @include('frontend.layouts.partials.breadcrumb')
    <section>
        <div class="container">
            <div class="section-head center reveal"><span class="eyebrow">Gallery</span>
                <h2 class="section-title">Our Work in <span>Pictures</span></h2>
                <p class="section-sub">Click any photo to view it larger.</p>
            </div>
            <div class="gal-grid">
                <div class="gal wide reveal d0"
                    data-full="https://unicorngroupbd.com/wp-content/uploads/2026/04/baranda-door.png"
                    style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/04/baranda-door.png')">
                </div>
                <div class="gal reveal d1"
                    data-full="https://unicorngroupbd.com/wp-content/uploads/2026/04/staff-room-door-1.webp"
                    style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/04/staff-room-door-1.webp')">
                </div>
                <div class="gal reveal d2"
                    data-full="https://unicorngroupbd.com/wp-content/uploads/2026/04/chairman-entry-room-wooden-door.webp"
                    style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/04/chairman-entry-room-wooden-door.webp')">
                </div>
                <div class="gal reveal d0"
                    data-full="https://unicorngroupbd.com/wp-content/uploads/2026/04/emaegency-exit-1.webp"
                    style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/04/emaegency-exit-1.webp')">
                </div>
                <div class="gal reveal d1"
                    data-full="https://unicorngroupbd.com/wp-content/uploads/2026/04/loby-waiting-.png"
                    style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/04/loby-waiting-.png')">
                </div>
                <div class="gal wide reveal d2"
                    data-full="https://unicorngroupbd.com/wp-content/uploads/2026/04/Director-room-ads.webp"
                    style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/04/Director-room-ads.webp')">
                </div>
                <div class="gal reveal d0"
                    data-full="https://unicorngroupbd.com/wp-content/uploads/2026/04/kitchern-door-design.webp"
                    style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/04/kitchern-door-design.webp')">
                </div>
                <div class="gal reveal d1"
                    data-full="https://unicorngroupbd.com/wp-content/uploads/2026/04/meeting-room-ads-L.webp"
                    style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/04/meeting-room-ads-L.webp')">
                </div>
                <div class="gal reveal d2"
                    data-full="https://unicorngroupbd.com/wp-content/uploads/2026/04/staff-room-door-1-1.webp"
                    style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/04/staff-room-door-1-1.webp')">
                </div>
                <div class="gal reveal d0"
                    data-full="https://unicorngroupbd.com/wp-content/uploads/2026/04/director-room-inside-.webp"
                    style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/04/director-room-inside-.webp')">
                </div>
            </div>
        </div>
    </section>
@endsection

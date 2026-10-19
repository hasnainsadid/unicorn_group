@extends('frontend.layouts.app')
@section('title', 'Office Interiors')

@section('crumbs')
    <span class="sep">/</span><a href="{{ route('gallery') }}">Gallery</a>
@endsection

@section('content')
    @include('frontend.layouts.partials.breadcrumb')
    <section>
        <div class="container">
            <div class="section-head center reveal"><span class="eyebrow">Gallery</span>
                <h2 class="section-title">Office Interiors</h2>
                <p class="section-sub">Lobby, meeting and director rooms. Click any photo to view it larger.</p>
            </div>
            <div class="gal-grid">
                <div class="gal reveal d0" data-full="https://unicorngroupbd.com/wp-content/uploads/2026/04/loby-waiting-.png"
                    style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/04/loby-waiting-.png')">
                    <div class="cap"><b>Lobby Waiting Area</b></div>
                </div>
                <div class="gal reveal d1" data-full="https://unicorngroupbd.com/wp-content/uploads/2026/04/Director-room-ads.webp"
                    style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/04/Director-room-ads.webp')">
                    <div class="cap"><b>Director Room</b></div>
                </div>
                <div class="gal reveal d2" data-full="https://unicorngroupbd.com/wp-content/uploads/2026/04/meeting-room-ads-L.webp"
                    style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/04/meeting-room-ads-L.webp')">
                    <div class="cap"><b>Meeting Room</b></div>
                </div>
                <div class="gal reveal d0" data-full="https://unicorngroupbd.com/wp-content/uploads/2026/04/director-room-inside-.webp"
                    style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/04/director-room-inside-.webp')">
                    <div class="cap"><b>Director Room Interior</b></div>
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

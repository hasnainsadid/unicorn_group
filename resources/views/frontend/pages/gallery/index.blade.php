@extends('frontend.layouts.app')
@section('title', 'Gallery')
@section('content')
    @include('frontend.layouts.partials.breadcrumb')
    <section>
        <div class="container">
            <div class="section-head center reveal"><span class="eyebrow">Gallery</span>
                <h2 class="section-title">Our Work in <span>Folders</span></h2>
                <p class="section-sub">Open a folder to see the pictures inside.</p>
            </div>
            <div class="folders">
                <a class="folder reveal d0" href="{{ route('gallery.projects') }}">
                    <span class="f-tab"></span>
                    <div class="f-back">
                        <div class="f-photos">
                            <i style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/03/project-06-2.jpg')"></i>
                            <i style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/03/project-05.jpg')"></i>
                            <i style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/03/project-04.jpg')"></i>
                        </div>
                        <div class="f-front">
                            <div>
                                <h3>Completed Projects</h3>
                                <span>12 photos</span>
                            </div>
                            <b>→</b>
                        </div>
                    </div>
                </a>
                <a class="folder reveal d1" href="{{ route('gallery.doors') }}">
                    <span class="f-tab"></span>
                    <div class="f-back">
                        <div class="f-photos">
                            <i style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/04/baranda-door.png')"></i>
                            <i style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/04/staff-room-door-1.webp')"></i>
                            <i style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/04/chairman-entry-room-wooden-door.webp')"></i>
                        </div>
                        <div class="f-front">
                            <div>
                                <h3>Doors &amp; Entrances</h3>
                                <span>6 photos</span>
                            </div>
                            <b>→</b>
                        </div>
                    </div>
                </a>
                <a class="folder reveal d2" href="{{ route('gallery.interiors') }}">
                    <span class="f-tab"></span>
                    <div class="f-back">
                        <div class="f-photos">
                            <i style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/04/loby-waiting-.png')"></i>
                            <i style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/04/Director-room-ads.webp')"></i>
                            <i style="background-image:url('https://unicorngroupbd.com/wp-content/uploads/2026/04/meeting-room-ads-L.webp')"></i>
                        </div>
                        <div class="f-front">
                            <div>
                                <h3>Office Interiors</h3>
                                <span>4 photos</span>
                            </div>
                            <b>→</b>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>
@endsection

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

            @if ($albums->count())
                <div class="folders">
                    @foreach ($albums as $album)
                        <a class="folder reveal d{{ $loop->index % 3 }}" href="{{ route('gallery.album', $album->slug) }}">
                            <span class="f-tab"></span>
                            <div class="f-back">
                                <div class="f-photos">
                                    @foreach ($album->images->take(3) as $p)
                                        <i style="background-image:url('{{ $p->url }}')"></i>
                                    @endforeach
                                </div>
                                <div class="f-front">
                                    <div>
                                        <h3>{{ $album->title }}</h3>
                                        <span>{{ $album->images->count() }} {{ Str::plural('photo', $album->images->count()) }}</span>
                                    </div>
                                    <b>→</b>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <p class="section-sub" style="text-align:center">Pictures are coming soon.</p>
            @endif
        </div>
    </section>
@endsection

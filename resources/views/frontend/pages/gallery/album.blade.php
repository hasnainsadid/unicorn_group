@extends('frontend.layouts.app')
@section('title', $album->title)

@section('crumbs')
    <span class="sep">/</span><a href="{{ route('gallery') }}">Gallery</a>
@endsection

@section('content')
    @include('frontend.layouts.partials.breadcrumb')
    <section>
        <div class="container">
            <div class="section-head center reveal"><span class="eyebrow">Gallery</span>
                <h2 class="section-title">{{ $album->title }}</h2>
                <p class="section-sub">{{ $album->description ? $album->description . ' ' : '' }}Click any photo to view it larger.</p>
            </div>
            <div class="gal-grid">
                @foreach ($album->images as $p)
                    <div class="gal reveal d{{ $loop->index % 3 }}" data-full="{{ $p->url }}"
                        style="background-image:url('{{ $p->url }}')">
                        @if ($p->caption)
                            <div class="cap"><b>{{ $p->caption }}</b></div>
                        @endif
                    </div>
                @endforeach
            </div>
            <div style="text-align:center;margin-top:40px">
                <a href="{{ route('gallery') }}" class="btn btn-ghost">← All folders</a>
            </div>
        </div>
    </section>

    {{-- Lightbox (the layout's copy is commented out, so it lives here) --}}
    <div class="lightbox" id="lightbox"><button class="close" id="lbClose" aria-label="Close">✕</button><img
            id="lbImg" alt="">
        <div class="lc" id="lbCap"></div>
    </div>
@endsection

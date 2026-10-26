@extends('frontend.layouts.app')
@section('title', $concern->meta_title ?: $concern->title)
@section('meta_description', $concern->meta_description ?: $concern->tagline)

@section('crumbs')
    <span class="sep">/</span><a href="{{ route('about') }}#concerns">Concerns</a>
    @foreach($ancestors as $parent)
        <span class="sep">/</span><a href="{{ $parent->url }}">{{ $parent->title }}</a>
    @endforeach
@endsection

@section('content')
    @include('frontend.layouts.partials.breadcrumb')

    @if($concern->layout === 'brand')
        {{-- ============ details + sidebar ============ --}}
        <section>
            <div class="container detail-grid">
                <div class="detail">
                    <div class="detail-img reveal" style="background-image:url('{{ $concern->image_url }}')"></div>
                    <span class="eyebrow">{{ $concern->eyebrow ?: ($ancestors->last()->title ?? 'Our Concern') }}</span>
                    <h2>{{ $concern->title }}</h2>
                    @if($concern->tagline)
                        <p style="font-weight:600;color:var(--text)">{{ $concern->tagline }}</p>
                    @endif
                    @foreach($concern->paragraphs as $p)
                        <p>{{ $p }}</p>
                    @endforeach

                    @if(!empty($concern->features))
                        <h3>What We Offer</h3>
                        <ul class="feat">
                            @foreach($concern->features as $point)
                                <li>{{ $point }}</li>
                            @endforeach
                        </ul>
                    @endif

                    @if($concern->image2)
                        <div class="detail-img reveal" style="height:300px;margin-top:30px;background-image:url('{{ $concern->image2_url }}')"></div>
                    @endif
                </div>

                <aside class="side">
                    @if($root->childrenRecursive->count())
                        <div class="side-card">
                            <h4>{{ $root->children_heading ?: 'Explore' }}</h4>
                            <div class="side-menu">
                                @include('frontend.pages.concerns.partials.side', ['nodes' => $root->childrenRecursive, 'depth' => 0, 'current' => $concern])
                            </div>
                        </div>
                    @endif
                    <div class="cta-box">
                        <h4>Need more details?</h4>
                        <p>Talk to our team about {{ $concern->title }}.</p>
                        <a class="btn btn-primary" href="{{ route('contact') }}">Contact Us →</a>
                    </div>
                </aside>
            </div>
        </section>
    @else
        {{-- ============ image + text ============ --}}
        <section>
            <div class="container about-grid">
                <div class="about-media reveal">
                    <div class="img-main" style="background-image:url('{{ $concern->image_url }}')"></div>
                    <div class="img-sub" style="background-image:url('{{ $concern->image2_url }}')"></div>
                </div>
                <div class="about-text reveal d2">
                    <span class="eyebrow">{{ $concern->eyebrow ?: 'Our Concern' }}</span>
                    <h2 class="section-title">{!! $concern->heading_html !!}</h2>
                    @foreach($concern->paragraphs as $p)
                        <p>{{ $p }}</p>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ============ sub-items (brands, series, services) ============ --}}
    @if($concern->children->count())
        <section class="alt">
            <div class="container">
                <div class="section-head center reveal"><span class="eyebrow">{{ $concern->title }}</span>
                    <h2 class="section-title">{{ $concern->children_heading ?: 'Explore' }}</h2>
                    @if($concern->children_text)
                        <p class="section-sub">{{ $concern->children_text }}</p>
                    @endif
                </div>
                <div class="grid-3">
                    @foreach($concern->children as $child)
                        <div class="item">
                            <article class="p-card tilt">
                                <div class="p-img">
                                    <div style="background-image:url('{{ $child->image_url }}')"></div>
                                    <span class="tag">{{ $concern->title }}</span>
                                </div>
                                <div class="p-body">
                                    <h3>{{ $child->title }}</h3>
                                    @if($child->tagline)<p>{{ $child->tagline }}</p>@endif
                                    <a class="more" href="{{ $child->url }}">Learn more <span>→</span></a>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ============ 3 cards ============ --}}
    @if(!empty($concern->cards))
        <section @class(['alt' => !$concern->children->count()])>
            <div class="container">
                <div class="mv-grid">
                    @foreach($concern->cards as $card)
                        <div class="mv reveal d{{ $loop->index % 3 }}">
                            @if(!empty($card['icon']))<div class="ic">{{ $card['icon'] }}</div>@endif
                            <h3>{{ $card['title'] }}</h3>
                            <p>{{ $card['text'] ?? '' }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ============ catalogue (flip book) ============ --}}
    @if($concern->catalogue)
        @include('frontend.pages.concerns.partials.catalogue', ['pdf' => $concern->catalogue, 'title' => $concern->title])
    @endif
@endsection

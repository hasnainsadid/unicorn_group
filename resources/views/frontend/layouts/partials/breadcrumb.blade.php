@php
    $bannerImg = html_entity_decode(trim($__env->yieldContent('banner_image')));
    $bannerLogo = html_entity_decode(trim($__env->yieldContent('banner_logo')));
@endphp
<section
    class="page-banner{{ $bannerImg ? ' has-img' : '' }}"@if ($bannerImg) style="--banner-img:url('{{ $bannerImg }}')" @endif>
    <div class="container">
        <div class="page-title">
            <h1>@yield('title')</h1> 
            @if ($bannerLogo)
                <span class="banner-logo"><img src="{{ $bannerLogo }}" alt="@yield('title') logo"></span>
            @endif
        </div>
        <nav class="crumbs" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a>@yield('crumbs')<span
                class="sep">/</span><span class="cur">@yield('title')</span></nav>
    </div>
</section>

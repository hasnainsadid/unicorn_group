<section class="page-banner">
    <div class="container">
        <h1>@yield('title')</h1>
        <nav class="crumbs" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span class="sep">/</span><span
                class="cur">@yield('title')</span></nav>
    </div>
</section>

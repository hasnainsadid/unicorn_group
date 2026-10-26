<header class="site-header" id="header">
    <div class="container nav-wrap">
        <a href="{{ route('home') }}" class="logo" aria-label="Home"><img class="logo-mark-img"
                src="{{ asset('frontend') }}/img/logo-mark.png" alt="" width="297" height="279"><img
                class="logo-word-img" src="{{ asset('frontend') }}/img/logo-word.png" alt="Unicorn Group logo"
                width="303" height="118"></a>
        <nav class="main-nav" id="nav" aria-label="Main">
            <ul class="menu">
                <li><a href="{{ route('home') }}" class="{{ Route::is('home') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('about') }}" class="{{ Route::is('about') ? 'active' : '' }}">About Us</a></li>
                <li><a href="{{ route('management') }}"
                        class="{{ Route::is('management') ? 'active' : '' }}">Management</a></li>

                @include('frontend.layouts.partials.concerns-menu')
                
                <li><a href="{{ route('gallery') }}" class="{{ Route::is('gallery*') ? 'active' : '' }}">Gallery</a>
                </li>
                <li><a href="{{ route('contact') }}" class="{{ Route::is('contact') ? 'active' : '' }}">Contact</a>
                </li>
            </ul>
        </nav>
        <div class="nav-actions">
            {{-- <button class="btn btn-primary" data-open-quote>Get a Quote</button> --}}
            <button class="burger" id="burger" aria-label="Menu"><span></span><span></span><span></span></button>
        </div>
    </div>
</header>

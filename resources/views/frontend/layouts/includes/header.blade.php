<header class="site-header" id="header">
    <div class="container nav-wrap">
        <a href="{{ route('home') }}" class="logo" aria-label="Home"><img class="logo-mark-img"
                src="{{ asset('frontend') }}/img/logo-mark.png" alt="" width="297" height="279"><img
                class="logo-word-img" src="{{ asset('frontend') }}/img/logo-word.png" alt="Unicorn Group logo"
                width="303" height="118"></a>
        <nav class="main-nav" id="nav" aria-label="Main">
            <ul class="menu">
                <li><a href="{{ route('home') }}" class="{{ Route::is('home') ? 'active' : '' }}">Home</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="management.html">Management</a></li>
                <li class="has-dd">
                    <a href="products.html">Products <i class="caret"></i></a>
                    <ul class="dropdown">
                        <li class="mobile-only"><a href="products.html">All Products</a></li>
                        <li class="has-sub">
                            <a href="lift.html">Lift</a>
                            <ul class="sub">
                                <li class="mobile-only"><a href="lift.html">All Lifts</a></li>
                                <li><a href="passenger-lift.html">Passenger Lift</a></li>
                                <li><a href="hospital-bed-lift.html">Hospital / Bed Lift</a></li>
                                <li><a href="car-lift.html">Car Lift</a></li>
                                <li><a href="freight-cargo-lift.html">Freight / Cargo Lift</a></li>
                                <li><a href="observation-lift.html">Observation Lift</a></li>
                                <li><a href="panoramic-lift.html">Panoramic Lift</a></li>
                                <li><a href="capsule-lift.html">Capsule Lift</a></li>
                                <li><a href="villa-lift.html">Villa Lift</a></li>
                                <li><a href="dumbwaiter.html">Dumbwaiter</a></li>
                            </ul>
                        </li>
                        <li><a href="escalator.html">Escalator</a></li>
                        <li><a href="moving-walkways.html">Moving Walkways</a></li>
                        <li><a href="generator.html">Generator</a></li>
                        <li><a href="substation.html">Substation</a></li>
                        <li><a href="busbar-trunking.html">Busbar Trunking (BBT)</a></li>
                    </ul>
                </li>
                <li><a href="spare-parts.html">Spare Parts</a></li>
                <li class="has-dd">
                    <a href="#">Service <i class="caret"></i></a>
                    <ul class="dropdown">
                        <li><a href="installation.html">Installation</a></li>
                        <li><a href="modernization.html">Modernization</a></li>
                        <li><a href="service-maintenance.html">Service &amp; Maintenance</a></li>
                    </ul>
                </li>
                <li><a href="project.html">Project</a></li>
                <li><a href="gallery.html">Gallery</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
        </nav>
        <div class="nav-actions">
            <button class="btn btn-primary" data-open-quote>Get a Quote</button>
            <button class="burger" id="burger" aria-label="Menu"><span></span><span></span><span></span></button>
        </div>
    </div>
</header>

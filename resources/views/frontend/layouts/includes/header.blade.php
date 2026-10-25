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
                <li class="has-dd">
                    <a href="#" class="{{ Route::is('concern.*') ? 'active' : '' }}">Concerns <i
                            class="caret"></i></a>
                    <ul class="dropdown">
                        <li><a href="{{ route('concern.venture') }}"
                                class="{{ Route::is('concern.venture') ? 'active' : '' }}">Unicorn Venture Ltd</a></li>

                        <li class="has-sub">
                            <a href="#" class="{{ Route::is('concern.elevator*') ? 'active' : '' }}">Unicorn
                                Elevator</a>
                            <ul class="sub">
                                <li class="mobile-only"><a href="{{ route('concern.elevator') }}">All Our Brands</a>
                                </li>
                                <li class="has-sub">
                                    <a href="#">Premium</a>
                                    <ul class="sub">
                                        <li><a href="{{ route('concern.elevator.hidoks') }}"
                                                class="{{ Route::is('concern.elevator.hidoks') ? 'active' : '' }}">Hidoks</a>
                                        </li>
                                        <li><a href="{{ route('concern.elevator.marsha') }}"
                                                class="{{ Route::is('concern.elevator.marsha') ? 'active' : '' }}">Marsha</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-sub">
                                    <a href="#">Signature</a>
                                    <ul class="sub">
                                        <li><a href="{{ route('concern.elevator.blt') }}"
                                                class="{{ Route::is('concern.elevator.blt') ? 'active' : '' }}">BLT</a>
                                        </li>
                                        <li><a href="{{ route('concern.elevator.ife') }}"
                                                class="{{ Route::is('concern.elevator.ife') ? 'active' : '' }}">IFE</a>
                                        </li>
                                        <li><a href="{{ route('concern.elevator.xizi') }}"
                                                class="{{ Route::is('concern.elevator.xizi') ? 'active' : '' }}">Xizi</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-sub">
                                    <a href="#">Essential</a>
                                    <ul class="sub">
                                        <li><a href="{{ route('concern.elevator.fuji-sj') }}"
                                                class="{{ Route::is('concern.elevator.fuji-sj') ? 'active' : '' }}">Fuji
                                                SJ</a></li>
                                        <li><a href="{{ route('concern.elevator.ningbo') }}"
                                                class="{{ Route::is('concern.elevator.ningbo') ? 'active' : '' }}">Ningbo</a>
                                        </li>
                                        <li><a href="{{ route('concern.elevator.sigma') }}"
                                                class="{{ Route::is('concern.elevator.sigma') ? 'active' : '' }}">Sigma</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-sub">
                                    <a href="#">Comfort</a>
                                    <ul class="sub">
                                        <li><a href="{{ route('concern.elevator.mrf') }}"
                                                class="{{ Route::is('concern.elevator.mrf') ? 'active' : '' }}">MRF</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        {{-- <li><a href="{{ route('concern.energy') }}" --}}
                        <li><a href="https://unicorn-energy-calculator-913114722513.asia-south1.run.app/"
                                target="_blank" class="{{ Route::is('concern.energy') ? 'active' : '' }}">Unicorn
                                Energy</a></li>
                        <li><a href="{{ route('concern.care') }}"
                                class="{{ Route::is('concern.care') ? 'active' : '' }}">Unicorn Care</a></li>

                        <li class="has-sub">
                            <a href="#" class="{{ Route::is('concern.engineering*') ? 'active' : '' }}">Unicorn
                                Engineering</a>
                            <ul class="sub">
                                <li class="mobile-only"><a href="{{ route('concern.engineering') }}">All What We Do</a>
                                </li>
                                <li class="has-sub">
                                    <a href="{{ route('concern.engineering.generator') }}"
                                        class="{{ Route::is('concern.engineering.generator*') ? 'active' : '' }}">Generator</a>
                                    <ul class="sub">
                                        <li class="mobile-only"><a
                                                href="{{ route('concern.engineering.generator') }}">All Generators</a>
                                        </li>
                                        <li><a href="{{ route('concern.engineering.generator.cummins') }}"
                                                class="{{ Route::is('concern.engineering.generator.cummins') ? 'active' : '' }}">Cummins</a>
                                        </li>
                                        <li><a href="{{ route('concern.engineering.generator.perkins') }}"
                                                class="{{ Route::is('concern.engineering.generator.perkins') ? 'active' : '' }}">Perkins</a>
                                        </li>
                                        <li><a href="{{ route('concern.engineering.generator.ricardo') }}"
                                                class="{{ Route::is('concern.engineering.generator.ricardo') ? 'active' : '' }}">Ricardo</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('concern.engineering.substation') }}">Sub-station</a></li>
                                <li><a href="{{ route('concern.engineering.design') }}">Design Drawing Consultancy
                                        (2D-3D)</a></li>
                            </ul>
                        </li>

                        <li><a href="{{ route('concern.landmark') }}"
                                class="{{ Route::is('concern.landmark') ? 'active' : '' }}">Unicorn Landmark</a></li>
                    </ul>
                </li>
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

<section class="hero" id="home" aria-roledescription="carousel">
    <canvas id="particles"></canvas>

    @forelse ($sliders as $slide)
        <div class="slide {{ $loop->first ? 'active' : '' }}">
            <div class="container hero-inner">
                <div class="slide-content">
                    @if ($slide->eyebrow)
                        <span class="eyebrow">{{ $slide->eyebrow }}</span>
                    @endif
                    <h1>{!! $slide->title_html !!}</h1>
                    @if ($slide->text)
                        <p>{{ $slide->text }}</p>
                    @endif
                    <div class="btns">
                        @if ($slide->btn1_text)
                            <a href="{{ url($slide->btn1_url) }}" class="btn btn-primary">{{ $slide->btn1_text }} →</a>
                        @endif
                        @if ($slide->btn2_text)
                            <a href="{{ url($slide->btn2_url) }}" class="btn btn-ghost">{{ $slide->btn2_text }}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        {{-- Admin e kono active slide na thakle default --}}
        <div class="slide active">
            <div class="container hero-inner">
                <div class="slide-content">
                    <span class="eyebrow">Smart Technology Solutions</span>
                    <h1>Building the future with <em>trust</em> &amp; engineering</h1>
                    <div class="btns">
                        <a href="{{ route('about') }}" class="btn btn-primary">About Us →</a>
                    </div>
                </div>
            </div>
        </div>
    @endforelse
    <!-- animated lift (stays above all slides) -->
    <div class="container hero-inner hero-lift">
        <div></div>
        <div class="hero-side">
            <div class="lift-widget" aria-hidden="true">
                <div class="floor-display" id="floorNum">G</div>
                <div class="shaft">
                    <div class="cab"></div>
                </div>
                <div class="float-card c1"><span style="font-size:1.6rem">🛡</span>
                    <div><b>100%</b>Safety Certified</div>
                </div>
                <div class="float-card c2"><span style="font-size:1.6rem">⏱</span>
                    <div><b>24/7</b>Expert Support</div>
                </div>
            </div>
        </div>
    </div>

    <div class="hero-arrows"><button id="prev" aria-label="Previous">←</button><button id="next"
            aria-label="Next">→</button></div>
    <div class="hero-dots" id="dots"></div>
    <div class="scroll-hint"></div>
    <div class="hero-progress" id="progress"></div>
</section>

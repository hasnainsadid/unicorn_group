<footer>
    <div class="container foot-grid">
        <div>
            <a href="{{ route('home') }}" class="logo" aria-label="Home" style="margin-bottom:18px"><img
                    class="logo-mark-img" src="{{ asset('frontend') }}/img/logo-mark.png" alt="logo" width="297"
                    height="279"><img class="logo-word-img" src="{{ asset('frontend') }}/img/logo-word.png"
                    alt="Unicorn Group logo" width="303" height="118"></a>
            <p>Smart technology solutions built on trust, faith and service. Your reliable partner for engineering
                excellence.</p>
            <h4 style="margin-top:26px">Stay Connected</h4>
            <div class="socials" style="margin-top:0">
                @if (setting('facebook'))
                    <a href="{{ setting('facebook') }}" target="_blank" rel="noopener" aria-label="Facebook">f</a>
                @endif
                @if (setting('twitter'))
                    <a href="{{ setting('twitter') }}" target="_blank" rel="noopener" aria-label="X (Twitter)">𝕏</a>
                @endif
                @if (setting('youtube'))
                    <a href="{{ setting('youtube') }}" target="_blank" rel="noopener" aria-label="YouTube">▶</a>
                @endif
                @if (setting('linkedin'))
                    <a href="{{ setting('linkedin') }}" target="_blank" rel="noopener" aria-label="LinkedIn">in</a>
                @endif
                @if (setting('instagram'))
                    <a href="{{ setting('instagram') }}" target="_blank" rel="noopener" aria-label="Instagram">ig</a>
                @endif
            </div>
        </div>
        <div>
            <h4>Useful Links</h4>
            <ul>
                <li><a href="{{ route('about') }}">About Us</a></li>
                <li><a href="{{ route('management') }}">Management</a></li>
                <li><a href="{{ route('about') }}#concerns">Our Concerns</a></li>
                <li><a href="{{ route('gallery') }}">Gallery</a></li>
                <li><a href="{{ route('contact') }}">Contact Us</a></li>
            </ul>
        </div>
        <div>
            <h4>Products</h4>
            <ul>
                <li><a href="lift.html">Lift</a></li>
                <li><a href="escalator.html">Escalator</a></li>
                <li><a href="moving-walkways.html">Moving Walkways</a></li>
                <li><a href="generator.html">Generator</a></li>
                <li><a href="substation.html">Substation</a></li>
                <li><a href="busbar-trunking.html">Busbar Trunking</a></li>
            </ul>
        </div>
        <div>
            <h4>Location</h4>
            <ul>
                @if (setting('phone'))
                    <li class="contact-li">📞 <a href="{{ tel_href(setting('phone')) }}">{{ setting('phone') }}</a>
                    </li>
                @endif
                @if (setting('email'))
                    <li class="contact-li">✉ <a href="mailto:{{ setting('email') }}">{{ setting('email') }}</a></li>
                @endif
                @if (setting('address'))
                    <li class="contact-li">📍 {{ setting('address') }}</li>
                @endif
            </ul>
            @if (map_embed_url())
                <iframe class="map" loading="lazy" title="Map" src="{{ map_embed_url() }}"></iframe>
            @endif
        </div>
    </div>
    <div class="copy">
        <div class="container"><span>© <span id="year"></span> {{ setting('site_name', 'Unicorn Group') }}. All rights reserved.</span>
            {{-- <span>Lifts · Escalators · Generators · Substations · Busbar Trunking</span> --}}
        </div>
    </div>
</footer>

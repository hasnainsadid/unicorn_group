<footer>
    <div class="container foot-grid">
        <div>
            <a href="index.html" class="logo" aria-label="Home" style="margin-bottom:18px"><img class="logo-mark-img"
                    src="{{ asset('frontend') }}/img/logo-mark.png" alt="logo" width="297" height="279"><img
                    class="logo-word-img" src="{{ asset('frontend') }}/img/logo-word.png" alt="Unicorn Group logo"
                    width="303" height="118"></a>
            <p>Smart technology solutions built on trust, faith and service. Your reliable partner for engineering
                excellence.</p>
            <h4 style="margin-top:26px">Stay Connected</h4>
            <div class="socials" style="margin-top:0"><a href="https://www.facebook.com/share/1CYrcJ9qZZ/"
                    target="_blank" rel="noopener" aria-label="Facebook">f</a><a href="#"
                    aria-label="Twitter">𝕏</a><a href="#" aria-label="YouTube">▶</a></div>
        </div>
        <div>
            <h4>Useful Links</h4>
            <ul>
                <li><a href="{{ route('about') }}">About Us</a></li>
                <li><a href="{{ route('management') }}">Management</a></li>
                <li><a href="{{ route('spare.part') }}">Spare Parts</a></li>
                <li><a href="{{ route('project') }}">Project</a></li>
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
                <li class="contact-li">📞 <a href="tel:+8801335106960">+880 1335-106960</a></li>
                <li class="contact-li">✉ <a href="mailto:unicornventureltd@gmail.com">unicornventureltd@gmail.com</a></li>
                <li class="contact-li">📍 Ujjal Tower, L-5, 362, DIT Road, East Rampura, Dhaka 1219</li>
            </ul>
            <iframe class="map" loading="lazy" title="Map"
                src="https://maps.google.com/maps?q=Ujjal%20Tower%2C%20L-5%2C%20362%2C%20DIT%20Road%2C%20East%20Rampura%20Dhaka%201219&t=m&z=14&output=embed&iwloc=near"></iframe>
            {{-- <button class="btn btn-primary" data-open-quote style="margin-top:18px">Get a Quote</button> --}}
        </div>
    </div>
    <div class="copy">
        <div class="container"><span>© <span id="year"></span> Unicorn Group. All rights
                reserved.</span>
                {{-- <span>Lifts · Escalators · Generators · Substations · Busbar Trunking</span></div> --}}
    </div>
</footer>

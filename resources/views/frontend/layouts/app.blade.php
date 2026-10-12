<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | {{ env('APP_NAME') }}</title>
    <meta name="description"
        content="Smart technology solutions: lifts, escalators, generators, substations, busbar trunking and automation.">
    @include('frontend.layouts.partials.style')
</head>

<body>
    @include('frontend.layouts.partials.preloader')
    @include('frontend.layouts.partials.topbar')
    
    @include('frontend.layouts.includes.header')

    @yield('content')

    @include('frontend.layouts.includes.footer')

    @include('frontend.layouts.partials.customizer')

    {{-- <div class="modal" id="modal" role="dialog" aria-modal="true" aria-labelledby="mt">
        <div class="modal-box">
            <button class="close" id="closeModal" aria-label="Close">✕</button>
            <div id="formWrap">
                <h3 id="mt">Get a Free Quote</h3>
                <p>Tell us what you need and our team will reply within 24 hours.</p>
                <form class="vform" id="quoteForm" novalidate>
                    <div class="field"><label>Full name</label><input name="name" data-v="name">
                        <div class="err">Please enter your name.</div>
                    </div>
                    <div class="field"><label>Email</label><input name="email" type="email" data-v="email">
                        <div class="err">Enter a valid email address.</div>
                    </div>
                    <div class="field"><label>Phone</label><input name="phone" type="tel" data-v="phone">
                        <div class="err">Enter a valid phone number.</div>
                    </div>
                    <div class="field"><label>Interested in</label><select name="interest">
                            <option>Lift</option>
                            <option>Escalator</option>
                            <option>Moving Walkways</option>
                            <option>Generator</option>
                            <option>Substation</option>
                            <option>Busbar Trunking</option>
                            <option>Service &amp; Maintenance</option>
                        </select></div>
                    <div class="field"><label>Message</label>
                        <textarea rows="3" name="message"></textarea>
                    </div>
                    <button class="btn btn-primary" style="width:100%;justify-content:center" type="submit">Send
                        Request</button>
                </form>
            </div>
            <div class="form-ok" id="formOk">
                <div class="tick">✓</div>
                <h3>Thank you!</h3>
                <p>We received your request and will contact you shortly.</p>
            </div>
        </div>
    </div> --}}

    {{-- <div class="lightbox" id="lightbox"><button class="close" id="lbClose" aria-label="Close">✕</button><img
            id="lbImg" alt="">
        <div class="lc" id="lbCap"></div>
    </div> --}}
    @include('frontend.layouts.partials.script')
</body>

</html>

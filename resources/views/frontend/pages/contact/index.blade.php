@extends('frontend.layouts.app')
@section('title', 'Contact Us')
@section('content')
    <section>
        <div class="container">
            <div class="section-head center reveal"><span class="eyebrow">Contact</span>
                <h2 class="section-title">Let's <span>Get in Touch</span></h2>
                <p class="section-sub">Questions, quotations or urgent breakdowns — we're here to help.</p>
            </div>
            <div class="contact-grid">
                <div class="info-cards">
                    <div class="info reveal"><i>📍</i>
                        <div><b>Address</b><span>Ujjal Tower, L-5, 362, DIT Road, East Rampura, Dhaka 1219</span></div>
                    </div>
                    <div class="info reveal d1"><i>📞</i>
                        <div><b>Phone</b><span>+880 1335-106960<br>+880 1743-389578 (24/7 support)</span></div>
                    </div>
                    <div class="info reveal d2"><i>✉</i>
                        <div><b>Email</b><span>
                                unicornventureltd@gmail.com<br>pialtp4@gmail.com</span></div>
                    </div>
                    <div class="info reveal d3"><i>🕘</i>
                        <div><b>Support</b><span>24/7 breakdown support</span></div>
                    </div>
                </div>
                <div class="form-card reveal d2">
                    <div id="cFormWrap">
                        <h3>Send us a message</h3>
                        <form class="vform" id="contactForm" action="{{ route('contact.store') }}" method="POST"
                            novalidate>
                            @csrf

                            {{-- Spam trap: manush dekhbe na --}}
                            <div aria-hidden="true"
                                style="position:absolute;left:-9999px;top:-9999px;height:0;overflow:hidden">
                                <label>Website</label>
                                <input type="text" name="website" tabindex="-1" autocomplete="off">
                            </div>
                            <input type="hidden" name="form_time" value="{{ encrypt(now()->timestamp) }}">

                            <div class="row2">
                                <div class="field"><label>Full name</label><input name="name" data-v="name">
                                    <div class="err">Please enter your name.</div>
                                </div>
                                <div class="field"><label>Email</label><input name="email" type="email" data-v="email">
                                    <div class="err">Enter a valid email.</div>
                                </div>
                            </div>
                            <div class="field"><label>Message</label>
                                <textarea rows="4" name="message" data-v="message"></textarea>
                                <div class="err">Please write at least 10 characters.</div>
                            </div>
                            <button class="btn btn-primary" type="submit">Send Message →</button>
                        </form>
                    </div>
                    <div class="form-ok" id="cOk">
                        <div class="tick">✓</div>
                        <h3>Thank you!</h3>
                        <p>We'll get back to you shortly.</p>
                    </div>
                </div>
            </div>
            <iframe class="map-big reveal" loading="lazy" title="Office location"
                src="https://maps.google.com/maps?q=Ujjal%20Tower%2C%20L-5%2C%20362%2C%20DIT%20Road%2C%20East%20Rampura%20Dhaka%201219&t=m&z=14&output=embed&iwloc=near"></iframe>
        </div>
    </section>
@endsection

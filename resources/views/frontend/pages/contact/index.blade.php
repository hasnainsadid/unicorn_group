@extends('frontend.layouts.app')
@section('title', 'Contact Us')
@section('meta_description', 'Contact Unicorn Group for quotations, technical support and 24/7 breakdown service. Find our address, phone, email and map.')
@section('content')
    <section>
        <div class="container">
            <div class="section-head center reveal"><span class="eyebrow">Contact</span>
                <h2 class="section-title">Let's <span>Get in Touch</span></h2>
                <p class="section-sub">Questions, quotations or urgent breakdowns — we're here to help.</p>
            </div>
            <div class="contact-grid">
                <div class="info-cards">
                    @if (setting('address'))
                        <div class="info reveal"><i>📍</i>
                            <div><b>Address</b><span>{{ setting('address') }}</span></div>
                        </div>
                    @endif
                    @if (setting('phone'))
                        <div class="info reveal d1"><i>📞</i>
                            <div><b>Phone</b><span>{{ setting('phone') }}@if (setting('phone2'))
                                        <br>{{ setting('phone2') }} (24/7 support)
                                    @endif
                                </span>
                            </div>
                        </div>
                    @endif
                    @if (setting('email'))
                        <div class="info reveal d2"><i>✉</i>
                            <div><b>Email</b><span>{{ setting('email') }}@if (setting('email2'))
                                        <br>{{ setting('email2') }}
                                    @endif
                                </span></div>
                        </div>
                    @endif
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
            @if (map_embed_url())
                <iframe class="map-big reveal" loading="lazy" title="Office location" src="{{ map_embed_url() }}"></iframe>
            @endif
        </div>
    </section>
@endsection

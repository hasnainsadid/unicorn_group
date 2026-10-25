{{--
    Catalogue (PDF as a book).
    Use:  @include('frontend.pages.concerns.partials.catalogue', ['pdf' => 'frontend/catalogs/hidoks.pdf', 'title' => 'Hidoks'])
    The section appears only when the PDF file exists in /public, so you can add this line to every page now.
--}}
@php $catFile = $pdf ?? null; @endphp
@if ($catFile && file_exists(public_path($catFile)))
    @once
        <link rel="stylesheet" href="{{ asset('frontend/css/catalogue.css') }}">
    @endonce

    <section class="alt cat-section" id="catalogue">
        <div class="container">
            <div class="section-head center reveal"><span class="eyebrow">Catalogue</span>
                <h2 class="section-title">{{ $title ?? 'Our' }} <span>Catalogue</span></h2>
                <p class="section-sub">Turn the pages with the arrows, your keyboard (&larr; &rarr;), or by swiping.</p>
            </div>

            <div class="flipbook reveal d1" data-pdf="{{ asset($catFile) }}">
                <div class="fb-stage">
                    <button type="button" class="fb-nav fb-prev" aria-label="Previous page" disabled>&#8249;</button>
                    <div class="fb-book">
                        <div class="fb-spread">
                            <div class="fb-pg fb-left empty"><img alt=""></div>
                            <div class="fb-pg fb-right empty"><img alt=""></div>
                        </div>
                    </div>
                    <button type="button" class="fb-nav fb-next" aria-label="Next page" disabled>&#8250;</button>
                </div>

                <div class="fb-bar">
                    <span class="fb-count">Loading&hellip;</span>
                    <input class="fb-go" type="number" min="1" inputmode="numeric" aria-label="Go to page" placeholder="Page">
                    <button type="button" class="fb-btn fb-full">&#9974; <span class="fb-fulltxt">Full screen</span></button>
                    <span class="fb-hint">Tip: use the &larr; and &rarr; keys on your keyboard. Type a page number and press Enter to jump.</span>
                </div>

                <div class="fb-loading">Loading the catalogue&hellip;</div>
            </div>
        </div>
    </section>

    @once
        <script src="{{ asset('frontend/js/catalogue.js') }}" defer></script>
    @endonce
@endif

@php
    $siteName  = setting('site_name', config('app.name'));
    $pageTitle = html_entity_decode(trim($__env->yieldContent('title')));
    $isHome    = request()->routeIs('home');
    $fullTitle = ($pageTitle && !$isHome)
        ? $pageTitle . ' | ' . $siteName
        : $siteName . (setting('tagline') ? ' | ' . setting('tagline') : '');

    $desc = html_entity_decode(trim($__env->yieldContent('meta_description'))) ?: (string) setting('meta_description', '');
    $desc = \Illuminate\Support\Str::limit(trim(preg_replace('/\s+/', ' ', $desc)), 160, '');

    $ogImage = html_entity_decode(trim($__env->yieldContent('og_image')))
        ?: (setting('og_image') ? asset(setting('og_image')) : asset('frontend/img/logo-mark.png'));
    $canonical = url()->current();
    $indexable = setting('allow_indexing', '1') === '1';

    $schema = array_filter([
        '@context'  => 'https://schema.org',
        '@type'     => 'Organization',
        'name'      => $siteName,
        'url'       => url('/'),
        'logo'      => asset('frontend/img/logo-mark.png'),
        'telephone' => setting('phone'),
        'email'     => setting('email'),
        'address'   => setting('address') ? [
            '@type'          => 'PostalAddress',
            'streetAddress'  => setting('address'),
            'addressCountry' => 'BD',
        ] : null,
        'sameAs'    => array_values(array_filter([
            setting('facebook'), setting('youtube'), setting('twitter'), setting('linkedin'), setting('instagram'),
        ])) ?: null,
    ]);
@endphp
<title>{{ $fullTitle }}</title>
@if ($desc)
    <meta name="description" content="{{ $desc }}">
@endif
@if (setting('meta_keywords'))
    <meta name="keywords" content="{{ setting('meta_keywords') }}">
@endif
<meta name="robots" content="{{ $indexable ? 'index,follow,max-image-preview:large' : 'noindex,nofollow' }}">
<link rel="canonical" href="{{ $canonical }}">
@if (setting('google_verification'))
    <meta name="google-site-verification" content="{{ setting('google_verification') }}">
@endif

<meta property="og:type" content="website">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:title" content="{{ $fullTitle }}">
<meta property="og:description" content="{{ $desc }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:image" content="{{ $ogImage }}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $fullTitle }}">
<meta name="twitter:description" content="{{ $desc }}">
<meta name="twitter:image" content="{{ $ogImage }}">

<script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>

@if (setting('ga_id') && $indexable)
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ setting('ga_id') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', @json(setting('ga_id')));
    </script>
@endif
@php $s = \App\Models\AboutSection::byKey('home_about'); @endphp
@if ($s)
<section id="about">
    <div class="container about-grid">
        <div class="about-media reveal">
            <div class="img-main" style="background-image:url('{{ $s->main_url }}')"></div>
            <div class="img-sub" style="background-image:url('{{ $s->sub_url }}')"></div>
        </div>
        <div class="about-text reveal d2">
            @if ($s->eyebrow)
                <span class="eyebrow">{{ $s->eyebrow }}</span>
            @endif
            <h2 class="section-title">{!! $s->title_html !!}</h2>
            @foreach ($s->paragraphs as $p)
                <p>{{ $p }}</p>
            @endforeach
            @if ($s->btn_text)
                <a href="{{ url($s->btn_url ?: '/') }}" class="btn btn-dark">{{ $s->btn_text }}</a>
            @endif
        </div>
    </div>
</section>
@endif
@php
    $homeConcerns = \App\Models\Concern::home()->get();
    $words = [1 => 'One', 2 => 'Two', 3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six', 7 => 'Seven', 8 => 'Eight', 9 => 'Nine', 10 => 'Ten'];
    $count = $homeConcerns->count();
@endphp
@if($count)
<section class="alt" id="concerns">
    <div class="container">
        <div class="section-head center reveal"><span class="eyebrow">Our Concerns</span>
            <h2 class="section-title">{{ $words[$count] ?? $count }} concerns, one standard of <span>quality</span></h2>
            <p class="section-sub">Each division is run as a specialist business, and all of them work to the same
                values.</p>
        </div>
        <div class="bento">
            @foreach($homeConcerns as $c)
                <a class="bt reveal d{{ $loop->index % 3 }}" href="{{ $c->url }}"
                    style="background-image:url('{{ $c->home_image_url }}')">
                    <span class="bt-ic">{{ $c->home_icon }}</span><span class="bt-go">→</span>
                    <div class="bt-tx">
                        <h3>{{ $c->title }}</h3>
                        <p>{{ $c->home_text_short }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

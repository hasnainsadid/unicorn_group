@php
    $aboutConcerns = \App\Models\Concern::tree();
    $words = [1 => 'One', 2 => 'Two', 3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six', 7 => 'Seven', 8 => 'Eight', 9 => 'Nine', 10 => 'Ten'];
    $count = $aboutConcerns->count();
@endphp
@if($count)
<section class="alt" id="concerns">
    <div class="container">
        <div class="section-head center reveal"><span class="eyebrow">Our Concerns</span>
            <h2 class="section-title">{{ $words[$count] ?? $count }} concerns, one standard of <span>quality</span></h2>
            <p class="section-sub">Each division is run as a specialist business, and all of them work to the same
                values.</p>
        </div>
        <div class="concerns">
            @foreach($aboutConcerns as $c)
                <a class="concern reveal d{{ $loop->index % 3 }}" href="{{ $c->url }}">
                    <span class="cn">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <div class="ic">{{ $c->home_icon }}</div>
                    <h3>{{ $c->title }}</h3>
                    <p>{{ $c->home_text_short }}</p>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

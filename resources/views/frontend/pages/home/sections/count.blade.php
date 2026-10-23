@php
    $stats = [];
    for ($i = 1; $i <= 5; $i++) {
        if (setting("stat{$i}_value") !== null && setting("stat{$i}_label")) {
            $stats[] = [
                'icon'   => setting("stat{$i}_icon"),
                'value'  => (int) setting("stat{$i}_value"),
                'suffix' => setting("stat{$i}_suffix", ''),
                'label'  => setting("stat{$i}_label"),
            ];
        }
    }
@endphp

@if (count($stats))
<section class="stats band" id="stats">
    <div class="container">
        <div class="band-head reveal">
            @if (setting('stats_eyebrow'))
                <span class="eyebrow">{{ setting('stats_eyebrow') }}</span>
            @endif
            @if (setting('stats_title'))
                <h2>{!! highlight_html(setting('stats_title'), setting('stats_highlight')) !!}</h2>
            @endif
        </div>
        <div class="stats-grid">
            @foreach ($stats as $s)
                <div class="stat reveal d{{ $loop->index }}">
                    <div class="si">{{ $s['icon'] }}</div>
                    <b data-count="{{ $s['value'] }}" data-suffix="{{ $s['suffix'] }}">0</b>
                    <span>{{ $s['label'] }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
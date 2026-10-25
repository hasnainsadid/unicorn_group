@php
    $series = [
        'Premium'   => [['Hidoks', 'concern.elevator.hidoks'], ['Marsha', 'concern.elevator.marsha']],
        'Signature' => [['BLT', 'concern.elevator.blt'], ['IFE', 'concern.elevator.ife'], ['Xizi', 'concern.elevator.xizi']],
        'Essential' => [['Fuji SJ', 'concern.elevator.fuji-sj'], ['Ningbo', 'concern.elevator.ningbo'], ['Sigma', 'concern.elevator.sigma']],
        'Comfort'   => [['MRF', 'concern.elevator.mrf']],
    ];
@endphp
<div class="side-card">
    <h4>Our Brands</h4>
    @foreach ($series as $name => $items)
        <div style="font-size:.72rem;letter-spacing:.12em;text-transform:uppercase;color:var(--accent);font-weight:700;margin:14px 0 4px">{{ $name }}</div>
        <div class="side-menu">
            @foreach ($items as [$label, $routeName])
                <a href="{{ route($routeName) }}" class="{{ Route::is($routeName) ? 'active' : '' }}">{{ $label }}</a>
            @endforeach
        </div>
    @endforeach
</div>

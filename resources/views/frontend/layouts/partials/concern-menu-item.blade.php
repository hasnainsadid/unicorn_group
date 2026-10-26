@php $has = $c->childrenRecursive->count() > 0; @endphp
<li @class(['has-sub' => $has])>
    <a href="{{ $c->url }}" class="{{ $c->isActive() ? 'active' : '' }}">{{ $c->title }}</a>
    @if($has)
        <ul class="sub">
            <li class="mobile-only"><a href="{{ $c->url }}">All {{ $c->title }}</a></li>
            @foreach($c->childrenRecursive as $child)
                @include('frontend.layouts.partials.concern-menu-item', ['c' => $child])
            @endforeach
        </ul>
    @endif
</li>

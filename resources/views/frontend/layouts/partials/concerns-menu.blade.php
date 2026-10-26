{{-- Header: the whole "Concerns" dropdown, built from the admin data --}}
<li class="has-dd">
    <a href="#" class="{{ request()->is('concerns*') ? 'active' : '' }}">Concerns <i class="caret"></i></a>
    <ul class="dropdown">
        @foreach(\App\Models\Concern::tree() as $c)
            @include('frontend.layouts.partials.concern-menu-item', ['c' => $c])
        @endforeach
    </ul>
</li>

@extends('frontend.layouts.app')
@section('title', 'Management')
@section('meta_description', 'Meet the leadership of Unicorn Group: our Chairman, Managing Director and Deputy Managing Director, and their vision for the group.')
@section('content')
    @include('frontend.layouts.partials.breadcrumb')

    @foreach ($managements as $m)
        <section class="{{ $loop->even ? 'alt' : '' }}">
            <div class="container msg">
                <div class="portrait reveal"
                    @if ($m->photo_url) style="background:#0d1522 url('{{ $m->photo_url }}') center top/cover;font-size:0" @endif>
                    {{ $m->initials }}</div>
                <div class="reveal d2">
                    <span class="eyebrow">{{ $m->role_title }}</span>
                    <h2 class="section-title">{{ $m->name }}</h2>
                    @if ($m->quote)
                        <blockquote>{{ $m->quote }}</blockquote>
                    @endif
                    @foreach ($m->paragraphs as $p)
                        <p style="color:var(--muted);margin-bottom:12px">{{ $p }}</p>
                    @endforeach
                </div>
            </div>
        </section>
    @endforeach
@endsection
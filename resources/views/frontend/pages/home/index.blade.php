@extends('frontend.layouts.app')
@section('title', 'Home')

@push('preloader')
    @include('frontend.layouts.partials.lift-intro')
@endpush

@section('content')
    @include('frontend.pages.home.sections.hero')
    @include('frontend.pages.home.sections.welcome')
    @include('frontend.pages.home.sections.concerns')
    {{-- @include('frontend.pages.home.sections.count') --}}
    @include('frontend.pages.home.sections.choose_us')
    @include('frontend.pages.home.sections.clients')
@endsection
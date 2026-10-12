@extends('frontend.layouts.app')
@section('title', 'About Us')
@section('content')
    @include('frontend.layouts.partials.breadcrumb')

    @include('frontend.pages.about.sections.about_us')
    @include('frontend.pages.about.sections.concerns')
    @include('frontend.pages.about.sections.overview')
    @include('frontend.pages.about.sections.strengths')
@endsection

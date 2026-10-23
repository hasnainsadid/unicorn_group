@extends('frontend.layouts.app')
@section('title', 'About Us')
@section('meta_description', 'Learn about Unicorn Group, a diversified business group built on trust, faith and service, with specialised concerns across engineering and infrastructure.')
@section('content')
    @include('frontend.layouts.partials.breadcrumb')

    @include('frontend.pages.about.sections.about_us')
    @include('frontend.pages.about.sections.concerns')
    @include('frontend.pages.about.sections.overview')
    @include('frontend.pages.about.sections.strengths')
@endsection

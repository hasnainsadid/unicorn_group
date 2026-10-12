@extends('frontend.layouts.app')
@section('title', 'Management')
@section('content')
    @include('frontend.layouts.partials.breadcrumb')
    @include('frontend.pages.management.sections.chairman')
    @include('frontend.pages.management.sections.md')
    @include('frontend.pages.management.sections.dmd')
@endsection

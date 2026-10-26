@extends('backend.layouts.app')
@section('title', 'New Concern')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <form action="{{ route('concerns.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('backend.pages.concerns._form')
    </form>
</div>
@endsection

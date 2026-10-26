@extends('backend.layouts.app')
@section('title', 'Edit Concern')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <form action="{{ route('concerns.update', $concern) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('backend.pages.concerns._form')
    </form>
</div>
@endsection

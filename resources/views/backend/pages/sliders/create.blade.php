@extends('backend.layouts.app')
@section('title', 'Add Slide')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <h5 class="card-header">Add Slide</h5>
            <div class="card-body">
                <form action="{{ route('sliders.store') }}" method="POST">
                    @csrf
                    @include('backend.pages.sliders._form')
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary me-2">Save</button>
                        <a href="{{ route('sliders.index') }}" class="btn btn-label-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
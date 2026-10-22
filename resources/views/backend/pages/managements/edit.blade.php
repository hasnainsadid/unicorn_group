@extends('backend.layouts.app')
@section('title', 'Edit Management Member')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header"><h5 class="mb-0">Edit Management Member</h5></div>
        <div class="card-body">
            <form action="{{ route('managements.update', $management) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('backend.pages.managements._form')
                <div class="mt-4">
                    <button class="btn btn-primary">Update</button>
                    <a href="{{ route('managements.index') }}" class="btn btn-label-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
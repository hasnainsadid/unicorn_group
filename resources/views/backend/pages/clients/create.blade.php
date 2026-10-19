@extends('backend.layouts.app')
@section('title', 'Add Client')

@section('content')
<div class="card">
    <div class="card-header"><h5 class="mb-0">Add Client</h5></div>
    <div class="card-body">
        <form action="{{ route('clients.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('backend.pages.clients._form')
            <div class="mt-4">
                <button class="btn btn-primary">Save</button>
                <a href="{{ route('clients.index') }}" class="btn btn-label-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
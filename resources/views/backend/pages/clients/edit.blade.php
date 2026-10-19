@extends('backend.layouts.app')
@section('title', 'Edit Client')

@section('content')
<div class="card">
    <div class="card-header"><h5 class="mb-0">Edit Client</h5></div>
    <div class="card-body">
        <form action="{{ route('clients.update', $client) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('backend.pages.clients._form')
            <div class="mt-4">
                <button class="btn btn-primary">Update</button>
                <a href="{{ route('clients.index') }}" class="btn btn-label-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
@extends('backend.layouts.app')
@section('title', 'New Gallery Folder')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header"><h5 class="mb-0">New Gallery Folder</h5></div>
        <div class="card-body">
            <form action="{{ route('albums.store') }}" method="POST">
                @csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label">Folder Name</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title') }}" placeholder="e.g. Completed Projects" required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Short Description (optional)</label>
                        <input type="text" name="description" class="form-control @error('description') is-invalid @enderror"
                               value="{{ old('description') }}">
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="mt-4">
                    <button class="btn btn-primary">Create &amp; Add Pictures</button>
                    <a href="{{ route('albums.index') }}" class="btn btn-label-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

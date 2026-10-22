@extends('backend.layouts.app')
@section('title', 'Edit Section')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ $section->label }}</h5>
            <a href="{{ route('about-sections.index') }}" class="btn btn-label-secondary btn-sm">← Back</a>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('about-sections.update', $section) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-4">

                    <div class="col-md-4">
                        <label class="form-label">Eyebrow (small text above the title)</label>
                        <input type="text" name="eyebrow" class="form-control @error('eyebrow') is-invalid @enderror"
                               value="{{ old('eyebrow', $section->eyebrow) }}">
                        @error('eyebrow') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-8">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title', $section->title) }}" required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Golden Highlight Word (a word that already appears in the title)</label>
                        <input type="text" name="highlight" class="form-control @error('highlight') is-invalid @enderror"
                               value="{{ old('highlight', $section->highlight) }}" placeholder="e.g. trust">
                        @error('highlight') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Text</label>
                        <textarea name="body" rows="9" class="form-control @error('body') is-invalid @enderror">{{ old('body', $section->body) }}</textarea>
                        <small class="text-muted">Leave an empty line between paragraphs.</small>
                        @error('body') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Main Image (big)</label>
                        <input type="file" name="image_main" accept="image/*" class="form-control @error('image_main') is-invalid @enderror">
                        @error('image_main') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <img src="{{ $section->main_url }}" alt="" class="mt-3" style="max-height:110px;border-radius:8px">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Small Image (overlapping)</label>
                        <input type="file" name="image_sub" accept="image/*" class="form-control @error('image_sub') is-invalid @enderror">
                        @error('image_sub') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <img src="{{ $section->sub_url }}" alt="" class="mt-3" style="max-height:110px;border-radius:8px">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Button Text (leave empty for no button)</label>
                        <input type="text" name="btn_text" class="form-control @error('btn_text') is-invalid @enderror"
                               value="{{ old('btn_text', $section->btn_text) }}" placeholder="e.g. Read More →">
                        @error('btn_text') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-8">
                        <label class="form-label">Button Link</label>
                        <input type="text" name="btn_url" class="form-control @error('btn_url') is-invalid @enderror"
                               value="{{ old('btn_url', $section->btn_url) }}" placeholder="/about">
                        @error('btn_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <button class="btn btn-primary">Update</button>
                    <a href="{{ route('about-sections.index') }}" class="btn btn-label-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
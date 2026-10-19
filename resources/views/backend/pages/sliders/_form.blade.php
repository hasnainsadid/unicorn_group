@php $s = $slider ?? null; @endphp

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Eyebrow (small text above the title)</label>
        <input type="text" name="eyebrow" class="form-control" value="{{ old('eyebrow', $s->eyebrow ?? '') }}">
        @error('eyebrow') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Order (smaller number shows first)</label>
        <input type="number" min="0" name="sort_order" class="form-control"
            value="{{ old('sort_order', $s->sort_order ?? 0) }}">
        @error('sort_order') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col-md-8">
        <label class="form-label">Title <span class="text-danger">*</span></label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $s->title ?? '') }}" required>
        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Golden Highlight Word (already appears in the title)</label>
        <input type="text" name="highlight" class="form-control" value="{{ old('highlight', $s->highlight ?? '') }}"
            placeholder="Example: trust">
        @error('highlight') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col-12">
        <label class="form-label">Text</label>
        <textarea name="text" rows="3" class="form-control">{{ old('text', $s->text ?? '') }}</textarea>
        @error('text') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col-md-3">
        <label class="form-label">Button 1 text</label>
        <input type="text" name="btn1_text" class="form-control" value="{{ old('btn1_text', $s->btn1_text ?? '') }}">
        @error('btn1_text') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-md-3">
        <label class="form-label">Button 1 link</label>
        <input type="text" name="btn1_url" class="form-control" value="{{ old('btn1_url', $s->btn1_url ?? '') }}"
            placeholder="/about">
        @error('btn1_url') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col-md-3">
        <label class="form-label">Button 2 text</label>
        <input type="text" name="btn2_text" class="form-control" value="{{ old('btn2_text', $s->btn2_text ?? '') }}">
        @error('btn2_text') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-md-3">
        <label class="form-label">Button 2 link</label>
        <input type="text" name="btn2_url" class="form-control" value="{{ old('btn2_url', $s->btn2_url ?? '') }}"
            placeholder="/contact">
        @error('btn2_url') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col-12">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="status" id="status" value="1"
                {{ old('status', $s->status ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="status">Active</label>
        </div>
    </div>
</div>
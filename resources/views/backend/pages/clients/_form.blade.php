<div class="row g-4">
    <div class="col-md-6">
        <label class="form-label">Client Name</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $client->name ?? '') }}" required>
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-3">
        <label class="form-label">Order (smaller number shows first)</label>
        <input type="number" min="0" name="sort_order" class="form-control"
               value="{{ old('sort_order', $client->sort_order ?? 0) }}">
    </div>

    <div class="col-md-6">
        <label class="form-label">Logo (PNG / JPG / WEBP / SVG, max 2MB)</label>
        <input type="file" name="logo" accept="image/*" class="form-control @error('logo') is-invalid @enderror">
        @error('logo') <div class="invalid-feedback">{{ $message }}</div> @enderror
        <small class="text-muted">If no logo is uploaded, the client name will be shown as text.</small>

        @if(!empty($client->logo))
            <div class="mt-3 d-flex align-items-center gap-3">
                <img src="{{ imageShow($client->logo) }}" alt="" style="max-height:50px;max-width:150px;object-fit:contain">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remove_logo" value="1" id="remove_logo">
                    <label class="form-check-label" for="remove_logo">Remove current logo</label>
                </div>
            </div>
        @endif
    </div>
</div>